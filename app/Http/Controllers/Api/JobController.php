<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Job;
use App\Models\JobPhoto;
use App\Logic\JobPhotoRepository;
use Illuminate\Support\Facades\Config;

class JobController extends Controller
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
        $jobs = Job::with('jobPhotos')->orderBy('created_at', 'DESC')->paginate(Config::get('frontend.job_per_page'));

        if ($categoryId == 0 && $locationId !=0) {
            $jobs = Job::with('jobPhotos')->where('area_suburb_id', $locationId)->orderBy('created_at', 'DESC')->paginate(1);
        }
        if ($categoryId != 0 && $locationId ==0) {
            $jobs = Job::with('jobPhotos')->where('category_id', $categoryId)->orderBy('created_at', 'DESC')->paginate(1);
        }

        if ($categoryId != 0 && $locationId !=0) {
            $jobs = Job::with('jobPhotos')->where('category_id', $categoryId)->where('area_suburb_id', $locationId)->orderBy('created_at', 'DESC')->paginate(1);
        }
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

            return Response::json(
                $job
                , 200);
        }
    }

    public function show($id) {

        $data['job'] = $job = Job::with('jobPhotos')->with('user')->with('user.userProfile')->find($id);

        return Response::json(
            $job
            , 200);
    }

    public function uploadJobPhoto(Request $request) {
        $encodedImage = $request->get('image');

        $response = $this->image->uploadFromBase64Encoded($encodedImage);
        return $response;
    }
}
