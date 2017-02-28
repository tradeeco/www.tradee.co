<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\TaggedUser;
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

    public function expressInterest(Request $request)
    {
        $currentUserId = $request->get('tag_user_id');
        $userId = $request->get('user_id');

        if (count(User::find($userId)) == 0)
            return Response::json(
                ['result' => 'failed']
                , 422);

        $taggedUser = TaggedUser::where('tagged_user_id', $userId)->where('user_id', $currentUserId)->where('tag', 0)->first();
        if (count($taggedUser))
            $taggedUser->update(array('tag' => 0));
        else {
            $taggedUser = new TaggedUser;
            $taggedUser->user_id = $currentUserId;
            $taggedUser->tagged_user_id = $userId;
            $taggedUser->tag = 0;
            $taggedUser->save();
        }

        return Response::json(
            ['result' => 'success']
            , 200);
    }

    public function expressShortlist(Request $request)
    {
        $taggedUserId = $request->get('id');
        $taggedUser = TaggedUser::find($taggedUserId);
        if (count($taggedUser))
            $taggedUser->update(array('tag' => 1));
        else {
            return Response::json(
                ['result' => 'failed']
                , 200);
        }

        return Response::json(
            ['result' => 'success']
            , 200);

    }

    public function expressSelect(Request $request)
    {
        $taggedUserId = $request->get('id');
        $taggedUser = TaggedUser::find($taggedUserId);
        if (count($taggedUser))
            $taggedUser->update(array('tag' => 2));
        else {
            return Response::json(
                ['result' => 'failed']
                , 200);
        }

        return Response::json(
            ['result' => 'success']
            , 200);

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