<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /*
     * search function
     */
    public function search(Request $request)
    {
        var_dump('asdfasdfas');
//        $username = $request->get('username');
//        $email = $request->get('email');
//        $data['users'] = DB::table('users')
//            ->select(DB::raw("*"))
//            ->where('username', 'LIKE', '%'.$username.'%')
//            ->where('email', 'LIKE', '%'.$email.'%')
//            ->get();
//        return view('admin.user.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['user1'] = Auth::guard('admin')->user();
        $username = '';
        $email = '';
        $query = User::query();

        if ($request->has('username')) {
            $username = $request->get('username');
            $query = $query->where('username', 'LIKE', '%' . $username . '%');
        }

        if ($request->has('email')) {
            $email = $request->get('email');
            $query = $query->where('email', 'LIKE', '%' . $email . '%');
        }

        $data['username'] = $username;
        $data['email'] = $email;
        $data["users"] = $query->get();

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
