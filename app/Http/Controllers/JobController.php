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

        $jobs = Job::paginate(Config::get('frontend.job_per_page'));
        $getParams = [];

        if (isset($request)) {
          if ($request->has('category') && !$request->has('location')) {
              $jobs = Job::categories($request->get('category'))->paginate(Config::get('frontend.job_per_page'));
              $getParams['category'] = $request->get('category');
          }
          if ($request->has('location') && !$request->has('category')) {
              $jobs = Job::locations($request->get('location'))->paginate(Config::get('frontend.job_per_page'));
              $getParams['location'] = $request->get('location');
          }

          if ($request->has('location') && $request->has('category')) {
              $jobs = Job::categories($request->get('category'))->locations($request->get('location'))->paginate(Config::get('frontend.job_per_page'));
              $getParams['location'] = $request->get('location'); $getParams['category'] = $request->get('category');
          }
        }

//
//        if ($alert = Session::get('alert')) {
//            $data['alert'] = $alert;
//        }
//
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
        if (Auth::check()) {
            $user = Auth::user();
            $data['taggedUsers'] = $taggedUsers = $user->taggedUsers;
            $data['inUsers'] = $taggedUsers->where('tag', 0);
            $data['shUsersCount'] = $taggedUsers->where('tag', 1)->count();
            $data['seUsersCount'] = $taggedUsers->where('tag', 2)->count();
        }

        $data['job'] = Job::where('slug', $slug)->first();
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
     * move watching job to interest tagged job
     */
    public function moveInterest($taggedJobId)
    {
        $user = Auth::user();
        $taggedJob = TaggedJob::find($taggedJobId);
        if (count($taggedJob))
            $taggedJob->update(array('tag' => 1));
        else {
//            $taggedJob = new TaggedJob;
//            $taggedJob->user_id = $user->id;
//            $taggedJob->job_id = $jobId;
//            $taggedJob->tag = 1;
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
    * delete interested tag
    */
    public function deleteInterest($taggedJobId)
    {
        $job = TaggedJob::find($taggedJobId);
        $job->update(array('tag' => 0));
        return Response::json(
            ['result' => 'success']
            , 200);
    }

    /*
    * move watching job to shortlisted tagged job
    */
    public function moveShortlist($taggedJobId)
    {
        $user = Auth::user();
        $taggedJob = TaggedJob::find($taggedJobId);
        if (count($taggedJob))
            $taggedJob->update(array('tag' => 2));
        else {
//            $taggedJob = new TaggedJob;
//            $taggedJob->user_id = $user->id;
//            $taggedJob->job_id = $jobId;
//            $taggedJob->tag = 1;
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
