<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\UserExperience;
use App\Models\UserJobInterestedLocation;
use App\Logic\UserAvatarRepository;
use App\Models\UserProfile;

class AccountController extends Controller
{
    protected $image;

    public function __construct(UserAvatarRepository $userAvatarRepository)
    {
        $this->image = $userAvatarRepository;
    }
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


    public function store(Request $request)
    {
        if ($request->has('remove_experience_ids'))
            UserExperience::whereIn('id', explode(',', $request->get('remove_experience_ids')))->delete();

        if ($request->has('remove_interested_ids'))
            UserJobInterestedLocation::whereIn('id', explode(',', $request->get('remove_interested_ids')))->delete();

        $user = User::find($request->get('user_id'));
        User::initAccountValidation($request);
        $validator = Validator::make($request->all(), User::$accountRules, User::$accountMessages);

        if ($validator->fails()) {
            return Response::json(
                $validator->errors()
                , 422);
        } else {
            // User Experience save process
            foreach ($request->get('category_id') as $key => $category_id) {
                $lengthId = $request->get('length_id')[$key];
                if ($request->has('experience_id') && isset($request->get('experience_id')[$key])) {
                    $experience = UserExperience::find($request->get('experience_id')[$key]);
                    $experience->update(array('category_id' => $category_id, 'length_id' => $lengthId));
                } else {
                    $userExperience = new UserExperience;
                    $userExperience->category_id = $category_id;
                    $userExperience->length_id = $lengthId;
                    $userExperience->user_id = $user->id;
                    $userExperience->save();
                }
            }
            // user job interested area save process
            foreach ($request->get('area_suburb_id') as $key => $area_suburb_id) {
                Log::debug($request->get('sec_category_id')[$key]);
                if ($request->has('user_interested_location_id') && isset($request->get('user_interested_location_id')[$key])) {
                    $inlocation = UserJobInterestedLocation::find($request->get('user_interested_location_id')[$key]);
                    $inlocation->update(array('area_suburb_id' => $area_suburb_id, 'category_id' => $request->get('sec_category_id')[$key]));
                } else {
                    $inLocation = new UserJobInterestedLocation;
                    $inLocation->area_suburb_id = $area_suburb_id;
                    $inLocation->category_id = $request->get('sec_category_id')[$key];
                    $inLocation->user_id = $user->id;
                    $inLocation->save();
                }
            }

            // profile image file upload
            if ($request->has('user_avatar')) {
                $userAvatar = $request->get('user_avatar');
                $response = $this->image->uploadFromBase64Encoded($userAvatar, $user);
            }

            // this part may not be needed
            if (count($user->userProfile))
                $sessionUserProfile = $user->userProfile;
            else
                $sessionUserProfile = new UserProfile(['user_id' => $user->id]);

            // user profile short bio save
            $sessionUserProfile->short_bio = $request->get('short_bio');
            $sessionUserProfile->save();

            return Response::json(
                $user,
                200);
        }
    }
}
