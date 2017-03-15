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
use App\Models\SocialLogin as Social;
use App\Models\Notification as NotificationModel;
use App\Models\UserDevice;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->middleware('cors');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password')])) {
            $deviceToken = $request->get('device_token');
            $this->storeDeviceToken($deviceToken, Auth::user()->id);

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

            $deviceToken = $request->get('device_token');
            $this->storeDeviceToken($deviceToken, $user->id);

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

    public function socialLogin(Request $request)
    {
        $email = $request->get('email');
        $socialId = $request->get('social_id');
        $provider = $request->get('provider');
        $name = $request->get('name');

        $userCheck = User::where('email', $email)->first();

        if (!empty($userCheck)) {
            $socialUser = $userCheck;
        } else {

            $sameSocialId = Social::where('social_id', '=', $socialId)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {

                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email              = $email;
                $name = explode(' ', $name);

                if (count($name) >= 1) {
                    $newSocialUser->first_name = $name[0];
                }

                if (count($name) >= 2) {
                    $newSocialUser->last_name = $name[1];
                }

                $usernameArray = explode('@', $email);

                $newSocialUser->username = $usernameArray[0];

                $newSocialUser->password = bcrypt(str_random(16));
                $newSocialUser->remember_token = str_random(64);
                $newSocialUser->save();

                $socialData = new Social;
                $socialData->social_id = $socialId;
                $socialData->provider= $provider;
                $newSocialUser->socialLogin()->save($socialData);

                $socialUser = $newSocialUser;

            }
            else {

                //Load this existing social user
                $socialUser = $sameSocialId->user;

            }

        }

        $deviceToken = $request->get('device_token');
        $this->storeDeviceToken($deviceToken, $socialUser->id);

        return Response::json(
            $socialUser,
            200);
    }

    public function notification($id)
    {
        $notifications = NotificationModel::with('job', 'user')->where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return Response::json(
            $notifications,
            200);
    }

    private function storeDeviceToken($deviceToken, $userId)
    {
        $userDevice = UserDevice::where('device_token', $deviceToken)->first();
        if (count($userDevice) == 0)
        {
            $userDevice = new UserDevice();
            $userDevice->device_token = $deviceToken;
            $userDevice->user_id = $userId;
            $userDevice->save();
        }
    }
}