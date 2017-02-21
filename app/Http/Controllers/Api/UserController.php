<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->middleware('cors');
    }

    public function login(Request $request)
    {
        Log::debug($request);
        if (Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password')])) {
            return Response::json(
                    Auth::user()
                , 200);
        }
        return Response::json(
            [
                'username' => Lang::get('auth.failed'),
            ]
            , 422);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return Response::json(
                    $validator->errors()
                , 422);
        } else {
            $user = User::create([
                'email' => $request->get('email'),
                'username' => $request->get('username'),
                'password' => bcrypt($request->get('password')),
                'area_suburb_id' => 0
            ]);
            $user->userProfile()->create([]);
            return Response::json(
                    $user,
                200);
        }
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'username' => 'required|alpha_dash|max:25|unique:users',
            'email' => 'required|email|max:25|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

}