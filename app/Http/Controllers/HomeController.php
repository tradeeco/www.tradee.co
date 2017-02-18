<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = DB::table('categories')->orderBy('name')->pluck('name', 'name');
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'name');

        $data['categories1'] = DB::table('categories')->orderBy('name')->pluck('name', 'id');
        $data['locations1'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'id');

        return view('home', $data);
    }
}
