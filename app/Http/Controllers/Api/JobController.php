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

class JobController extends Controller
{
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
        $jobs = Job::with('jobPhotos')->paginate(1);

        if ($categoryId == 0 && $locationId !=0) {
            $jobs = Job::with('jobPhotos')->where('area_suburb_id', $locationId)->paginate(1);
        }
        if ($categoryId != 0 && $locationId ==0) {
            $jobs = Job::with('jobPhotos')->where('category_id', $categoryId)->paginate(1);
        }

        if ($categoryId != 0 && $locationId !=0) {
            $jobs = Job::with('jobPhotos')->where('category_id', $categoryId)->where('area_suburb_id', $locationId)->paginate(1);
        }
        return Response::json(
            $jobs
            , 200);
    }
}
