<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\TaggedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['profile']]);
    }
//    public function login(Request $request)
//    {
//        $credentials = $request->only('username', 'password');
//        $authenticatedUser = User::authenticate($credentials['username'], $credentials['password']);
//
//        if (!$authenticatedUser) {
//            return response()->json(['error' => 'invalid_credentials'], 401);
//        }
//
//        $authenticatedUser['token'] = JWTAuth::fromUser($authenticatedUser);
//        return response()->json($authenticatedUser);
//    }
//
//    public function store(Request $request)
//    {
//        Log::debug('storing');
//
//        $user = new User($request->all());
//
//        if (!$user->save()) {
//            abort(500, 'Could not save user.');
//        }
//
//        $user['token'] = JWTAuth::fromUser($user);
//        return $user;
//    }
//
//    public function show($id)
//    {
//        return User::find($id);
//    }
//
//    public function getByToken()
//    {
//        return JWTAuth::parseToken()->authenticate();
//    }
    /**
     * user profile
     */
    public function profile($slug)
    {
        $user = User::where('slug', $slug)->first();
        $data['user'] = $user;

        return view('users.profile', $data);
    }

    public function expressInterest($userId)
    {
        if (count(User::find($userId)) == 0)
            return Response::json(
                ['result' => 'failed']
                , 422);

        $currentUser = Auth::user();
        $taggedUser = TaggedUser::where('user_id', $userId)->where('user_id', $currentUser->id)->where('tag', 0)->first();
        if (count($taggedUser))
            $taggedUser->update(array('tag' => 0));
        else {
            $taggedUser = new TaggedUser;
            $taggedUser->user_id = $currentUser->id;
            $taggedUser->tagged_user_id = $userId;
            $taggedUser->tag = 0;
            $taggedUser->save();
        }

        return Response::json(
            ['result' => 'success']
            , 200);

    }

    public function expressShortlist($taggedUserId)
    {
        $currentUser = Auth::user();
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

    public function expressSelect($taggedUserId)
    {
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

    public function taggedUsers($tag)
    {
        $user = Auth::user();
        $data['taggedUsers'] = $taggedUsers = $user->taggedUsers->where('tag', $tag);
        $data['tag'] = $tag;
        return view('job.load_tagged_users_partial', $data);
    }

    public function deleteTagged($taggedUserId, $tag)
    {
        $taggedUser = TaggedUser::find($taggedUserId);
        if (count($taggedUser))
            $taggedUser->update(array('tag' => ($tag-1)));
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