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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AccountController extends Controller
{
    //

    public function edit($id)
    {
        $data['user'] = $user = User::with('userProfile', 'userExperiences', 'userJobInterestedLocations')->find($id);
        $data['categories'] = DB::table('categories')->orderBy('name')->get();
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->get();
        $data['lengths'] = Config::get('frontend.lengths');
        $data['userExperiences'] = $user->userExperiences()->get();
        $data['userJobInterestedLocations'] = $user->userJobInterestedLocations()->get();

        return Response::json(
            $data,
            200);
    }

    public function update(Request $request)
    {
        $userId = $request->get('user_id');
        $user = User::find($userId);
        $validator = Validator::make($request->all(), User::$contactRules, User::$contactMessages);

        if ($validator->fails()) {
            return Response::json(
                $validator->errors()
                , 422);
        } else {
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->address = $request->get('address');
            $user->area_suburb_id = $request->get('area_suburb_id');
            $user->phone = $request->get('phone');
            $user->post_code = $request->get('post_code');
            $user->save();

            $alert['msg'] = 'Contact Details been updated successfully';
            $alert['type'] = 'success';


            return Response::json(
                $user,
                200);
        }
    }
}
