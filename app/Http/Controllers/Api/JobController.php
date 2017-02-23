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
}
