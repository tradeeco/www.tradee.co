<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Job;
use App\Models\JobPhoto;
use App\Models\TaggedJob;
use App\Logic\JobPhotoRepository;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    protected $image;

    public function __construct(JobPhotoRepository $jobPhotoRepository)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->image = $jobPhotoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['categories'] = DB::table('categories')->orderBy('name')->pluck('name', 'name')->all();
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'name')->all();

        $query = Job::join('categories', 'jobs.category_id', '=', 'categories.id')
            ->join('area_suburbs', 'jobs.area_suburb_id', '=', 'area_suburbs.id')
            ->select('jobs.*');
//        $jobs = Job::paginate(Config::get('frontend.job_per_page'));
        $getParams = [];

        if (isset($request)) {
            if ($request->has('category') && $request->get('category') != '') {
                $query = $query->where('categories.name', $request->get('category'));
                $getParams['category'] = $request->get('category');
            }
            if ($request->has('location') && $request->get('location') != '') {
                $query = $query->where('area_suburbs.name', $request->get('location'));
                $getParams['location'] = $request->get('location');
            }

            if ($request->has('sort') && $request->get('sort') != '') {
                if ($request->get('sort') == 'created_DESC')
                    $query = $query->orderBy('jobs.created_at', 'DESC');
                elseif ($request->get('sort') == 'created_ASC')
                    $query = $query->orderBy('jobs.created_at', 'ASC');
                $getParams['sort'] = $request->get('sort');
            }

        }

//
//        if ($alert = Session::get('alert')) {
//            $data['alert'] = $alert;
//        }
//
        $jobs = $query->paginate(Config::get('frontend.job_per_page'));
        $data['jobs'] = $jobs;
        $data['getParams'] = $getParams;
        return view('job.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Job::$rules, Job::$messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $job = new Job;
            $job->title = $request->get('title');
            $job->description = $request->get('description');
            $job->category_id = $request->get('category_id');
            $job->area_suburb_id = $request->get('area_suburb_id');
            $job->user_id = Auth::user()->id;
            $job->save();

            JobPhoto::whereIn('id', explode(',', $request->get('photo_ids')))->update(array('job_id' => $job->id));

            $alert['msg'] = 'Job has been created successfully';
            $alert['type'] = 'success';

            $tempPhotos = JobPhoto::where('job_id', 0)->get();
            foreach ($tempPhotos as $photo) {
                $this->image->delete( $photo->id );
            }

            return Redirect::route('jobs.show', $job->slug)->with('alert', $alert);
        }
    }
    /*
     * Job Detail page by slug
     */
    public function show($slug) {
        $data['job'] = $job = Job::where('slug', $slug)->first();
        $expressInterested = false;
        $expressWatching = false;
        if (Auth::check()) {
            $user = Auth::user();
//            $data['taggedUsers'] = $taggedUsers = $user->taggedUsers;
//            $data['inUsers'] = $taggedUsers->where('tag', 0);
            if ($job->user_id == $user->id) {
                $data['interestedJobUsers'] = $interestedJobUsers = TaggedJob::where('job_id', $job->id)->where('tag', 1)->get();
                $data['shJobUsersCount'] = TaggedJob::where('job_id', $job->id)->where('tag', 2)->count();
                $data['seJobUsersCount'] = TaggedJob::where('job_id', $job->id)->where('tag', 3)->count();
            } else {
                if (TaggedJob::where('job_id', $job->id)->where('user_id', $user->id)->where('tag', '>', '0')->count() > 0)
                    $expressInterested = true;
                if (TaggedJob::where('job_id', $job->id)->where('user_id', $user->id)->where('tag', '>', '-1')->count() > 0)
                    $expressWatching = true;

            }
        }

        $data['expressInterested'] = $expressInterested;
        $data['expressWatching'] = $expressWatching;
        if ($alert = Session::get('alert')) {
            $data['alert'] = $alert;
        }

        return view('job.show', $data);
    }

    /*
     * upload photo when post job(before process)
     */
    public function upload_photo(Request $request)
    {
        $photo = $request->all();
        $response = $this->image->upload($photo);
        return $response;
    }
    /*
     * delete job photo by id
     */
    public function delete_photo(Request $request)
    {
        $fileId = $request->get('id');

        if(!$fileId)
        {
            return 0;
        }

        $response = $this->image->delete( $fileId );

        return $response;
    }
    /*
     * job watching page
     */
    public function watching()
    {
        $data['user'] = $user = Auth::user();
        $data['taggedJobs'] = $user->taggedJobs->where('tag', 0);
        return view('job.watching', $data);
    }

    /*
    * job interest page
    */
    public function interest()
    {
        $data['user'] = $user = Auth::user();
        $data['taggedJobs'] = $user->taggedJobs->where('tag', 1);
        return view('job.watching', $data);
    }

    /*
    * job shortlist page
    */
    public function shortlist()
    {
        $data['user'] = $user = Auth::user();
        $data['taggedJobs'] = $user->taggedJobs->where('tag', 2);
        return view('job.watching', $data);
    }
    /*
     * my job pages
     */
    public function mine()
    {
        $data['user'] = $user = Auth::user();
        $data['jobs'] = $user->jobs;
        return view('job.mine', $data);
    }
    /*
     * move general job to watching tagged job
     */
    public function moveWatching($jobId)
    {
        if (count(Job::find($jobId)) == 0)
            return Response::json(
                ['result' => 'failed']
                , 422);

        $user = Auth::user();
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

    public function expressInterest($id)
    {
        if (count(Job::find($id)) == 0)
            return Response::json(
                ['result' => 'failed']
                , 422);

        $user = Auth::user();
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
     * move job to previous job
     */
    public function closeListing($id)
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
     * load tagged user by tag id under tagged tabs on job detail page
     */
    public function taggedUsers($jobId, $tag)
    {
        $data['taggedJobUsers'] = TaggedJob::jobs($jobId)->where('tag', $tag)->get();
        $data['tag'] = $tag;
        return view('job.load_tagged_users_partial', $data);
    }

    /*
     * delete from tagged job
     */
    public function deleteTagged($taggedJobId, $tag)
    {
        $taggedJob = TaggedJob::find($taggedJobId);
        if ($tag == 1) {
            $taggedJob->delete();
        } else {
            if (count($taggedJob))
                $taggedJob->update(array('tag' => ($tag-1)));
            else {
                return Response::json(
                    ['result' => 'failed']
                    , 200);
            }

            return Response::json(
                ['result' => 'success']
                , 200);
        }

    }
    /*
     * delete watching tag
     */
    public function deleteWatching($taggedJobId)
    {
        $job = TaggedJob::find($taggedJobId);
        $job->update(array('tag' => 3));
        return Response::json(
            ['result' => 'success']
            , 200);
    }

    /*
    * delete interested tag
    */
    public function deleteInterest($taggedJobId)
    {
        $job = TaggedJob::find($taggedJobId);
        // $job->update(array('tag' => 0));
        $job->delete();
        return Response::json(
            ['result' => 'success']
            , 200);
    }

    /*
    * delete shortlisted tag
    */
    public function deleteShortlist($taggedJobId)
    {
        $job = TaggedJob::find($taggedJobId);
        $job->update(array('tag' => 1));
        return Response::json(
            ['result' => 'success']
            , 200);
    }

}
