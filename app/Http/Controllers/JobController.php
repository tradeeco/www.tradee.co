<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Job;
use App\Models\JobPhoto;
use App\Logic\JobPhotoRepository;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    protected $image;

    public function __construct(JobPhotoRepository $jobPhotoRepository)
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->image = $jobPhotoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['categories'] = DB::table('categories')->orderBy('name')->pluck('name', 'id');
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'id');

        $jobs = Job::paginate(1);

        if (isset($request)) {
          if ($request->has('category') && !$request->has('location')) {
              $jobs = Job::categories($request->get('category'))->paginate(1);
          }
          if ($request->has('location') && !$request->has('category')) {
              $jobs = Job::locations($request->get('location'))->paginate(1);
          }

          if ($request->has('location') && !$request->has('category')) {
              $jobs = Job::categories($request->get('category'))->locations($request->get('location'))->paginate(1);
          }
        }

//
//        if ($alert = Session::get('alert')) {
//            $data['alert'] = $alert;
//        }
//
        $data['jobs'] = $jobs;
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

            return Redirect::route('home.index')->with('alert', $alert);
        }
    }

    public function upload_photo(Request $request)
    {
        $photo = $request->all();
        $response = $this->image->upload($photo);
        return $response;
    }

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

}
