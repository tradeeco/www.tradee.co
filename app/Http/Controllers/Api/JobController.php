<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseJobController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\User;
use App\Models\Job;
use App\Models\JobPhoto;
use App\Models\TaggedJob;
use App\Logic\JobPhotoRepository;
use Illuminate\Support\Facades\Config;

class JobController extends BaseJobController
{
    protected $image;

    public function __construct(JobPhotoRepository $jobPhotoRepository)
    {
        $this->image = $jobPhotoRepository;
    }

    //
    public function getCategories()
    {
        return Response::json(
            DB::table('categories')->orderBy('name')->get()
            , 200);
    }

    public function getLocations()
    {
        return Response::json(
            DB::table('area_suburbs')->orderBy('name')->get()
            , 200);
    }

    public function jobs($currentPage, $categoryId, $locationId)
    {
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
//        $jobs = Job::with('jobPhotos')->orderBy('created_at', 'DESC')->paginate(Config::get('frontend.job_per_page'));
        $jobs = Job::with('jobPhotos');

        if ($locationId !=0) {
            $jobs = $jobs->where('area_suburb_id', $locationId);
        }
        if ($categoryId != 0) {
            $jobs = $jobs->where('category_id', $categoryId);
        }

        $jobs = $jobs->orderBy('created_at', 'DESC')->paginate(Config::get('frontend.job_per_page'));

        return Response::json(
            $jobs
            , 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Job::$rules, Job::$messages);

        if ($validator->fails()) {
            return Response::json(
                $validator->errors()
                , 422);
        } else {
            $job = new Job;
            $job->title = $request->get('title');
            $job->description = $request->get('description');
            $job->category_id = $request->get('category_id');
            $job->area_suburb_id = $request->get('area_suburb_id');
            $job->user_id = $request->get('user_id');
            $job->save();

            JobPhoto::whereIn('id', explode(',', $request->get('photo_ids')))->update(array('job_id' => $job->id));

            $tempPhotos = JobPhoto::where('job_id', 0)->get();
            foreach ($tempPhotos as $photo) {
                $this->image->delete( $photo->id );
            }

            $this->storeJobToNotification($job, 0);


            return Response::json(
                $job
                , 200);
        }
    }

    public function show($job_id, $user_id) {

        $data['job'] = $job = Job::with('jobPhotos', 'taggedJobs')->with('user')->with('user.userProfile')->find($job_id);
        $taggedJob = [];
        if ($user_id != 0)
            $taggedJob = TaggedJob::where('job_id', $job_id)->where('user_id', $user_id)->first();

        return Response::json(
            ['job'=>$job, 'taggedJob'=> $taggedJob]
            , 200);
    }

    public function uploadJobPhoto(Request $request) {
        $encodedImage = $request->get('image');

        $response = $this->image->uploadFromBase64Encoded($encodedImage);
        return $response;
    }

    /*
     * move general job to watching tagged job
     */
    public function moveWatching(Request $request)
    {
        $jobId = $request->get('job_id');
        if (count(Job::find($jobId)) == 0)
            return Response::json(
                ['result' => 'failed']
                , 422);

        $user = User::find($request->get('user_id'));
        $taggedJob = TaggedJob::where('job_id', $jobId)->where('user_id', $user->id)->where('tag', 0)->first();
        if (count($taggedJob))
            $taggedJob->update(array('tag' => 0));
        else {
            $taggedJob = new TaggedJob;
            $taggedJob->user_id = $user->id;
            $taggedJob->job_id = $jobId;
            $taggedJob->tag = 0;
            $taggedJob->save();
        }

        return Response::json(
            ['result' => 'success']
            , 200);
    }

    /*
   * Tradee express interest to one job
   */

    public function expressInterest(Request $request)
    {
        $id = $request->get('job_id');
        if (count(Job::find($id)) == 0)
            return Response::json(
                ['result' => 'failed']
                , 422);

        $user = User::find($request->get('user_id'));
        $taggedJob = TaggedJob::where('job_id', $id)->where('user_id', $user->id)->first();
        if (count($taggedJob))
            $taggedJob->update(array('tag' => 1));
        else {
            $taggedJob = new TaggedJob;
            $taggedJob->user_id = $user->id;
            $taggedJob->job_id = $id;
            $taggedJob->tag = 1;
            $taggedJob->save();
        }
        $this->storeInterestToNotification($user, $taggedJob->job);

        return Response::json(
            ['result' => 'success']
            , 200);
    }
    /*
    * move user from interest to shortlist for one job by job owner
    */
    public function expressShortlist($id) {
        $taggedJob = TaggedJob::find($id);
        if (count($taggedJob))
            $taggedJob->update(array('tag' => 2));
        else {
//            $taggedJob = new TaggedJob;
//            $taggedJob->user_id = $user->id;
//            $taggedJob->job_id = $jobId;
//            $taggedJob->tag = 2;
//            $taggedJob->save();
            return Response::json(
                ['result' => 'failed']
                , 422);
        }

        return Response::json(
            ['result' => 'success']
            , 200);
    }

    /*
    * move user from shortlist to selected for one job by job owner
    */
    public function expressSelect($id)
    {
        $taggedJob = TaggedJob::find($id);
        if (count($taggedJob))
            $taggedJob->update(array('tag' => 3));
        else {
//            $taggedJob = new TaggedJob;
//            $taggedJob->user_id = $user->id;
//            $taggedJob->job_id = $jobId;
//            $taggedJob->tag = 2;
//            $taggedJob->save();
            return Response::json(
                ['result' => 'failed']
                , 422);
        }

        return Response::json(
            ['result' => 'success']
            , 200);
    }

    /*
     * my jobs
     */
    public function mine($id)
    {
        $data['user'] = $user = User::find($id);
        $jobs = Job::with('user', 'jobPhotos', 'taggedJobs')->where('status', 'active')->where('user_id', $id)->get();
        return Response::json(
            $jobs
            , 200);
    }

    /*
     * previous jobs
     */
    public function previous($id)
    {
        $jobs = Job::with('user', 'jobPhotos', 'taggedJobs')->where('status', 'closed')->where('user_id', $id)->get();
        return Response::json(
            $jobs
            , 200);
    }

    /*
     * move job to previous job
     */
    public function closeListing($id)
    {
        $job = Job::find($id);
        if (count($job)) {
            $job->update(array('status' => 'closed'));
            $job->taggedJobs()->update(array('tag' => 4));
        } else {
//            $taggedJob = new TaggedJob;
//            $taggedJob->user_id = $user->id;
//            $taggedJob->job_id = $jobId;
//            $taggedJob->tag = 2;
//            $taggedJob->save();
            return Response::json(
                ['result' => 'failed']
                , 422);
        }

        return Response::json(
            ['result' => 'success']
            , 200);
    }

    public function watching($id)
    {
        $jobs = TaggedJob::with('job', 'job.jobPhotos')->where('tag', 0)->where('user_id', $id)->get();
        return Response::json(
            $jobs
            , 200);
    }

    public function interest($id)
    {
        $jobs = TaggedJob::with('job', 'job.jobPhotos')->where('tag', 1)->where('user_id', $id)->get();
        return Response::json(
            $jobs
            , 200);
    }

    public function shortlist($id)
    {
        $jobs = TaggedJob::with('job', 'job.jobPhotos')->where('tag', 2)->where('user_id', $id)->get();
        return Response::json(
            $jobs
            , 200);
    }

}
