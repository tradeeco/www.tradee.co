<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\User;
use App\Models\UserExperience;
use App\Models\UserJobInterestedLocation;
use App\Logic\UserAvatarRepository;
use App\Models\UserProfile;

class AccountController extends Controller
{
    protected $image;

    public function __construct(UserAvatarRepository $userAvatarRepository)
    {
        $this->middleware('auth');
        $this->image = $userAvatarRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('account.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('remove_experience_ids'))
            UserExperience::whereIn('id', explode(',', $request->get('remove_experience_ids')))->delete();

        if ($request->has('remove_interested_ids'))
            UserJobInterestedLocation::whereIn('id', explode(',', $request->get('remove_interested_ids')))->delete();

        $user = Auth::user();
        User::initAccountValidation($request);
        $validator = Validator::make($request->all(), User::$accountRules, User::$accountMessages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
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
                if ($request->has('user_interested_location_id') && isset($request->get('user_interested_location_id')[$key])) {
                    $inlocation = UserJobInterestedLocation::find($request->get('user_interested_location_id')[$key]);
                    $inlocation->update(array('area_suburb_id' => $area_suburb_id));
                } else {
                    $inLocation = new UserJobInterestedLocation;
                    $inLocation->area_suburb_id = $area_suburb_id;
                    $inLocation->user_id = $user->id;
                    $inLocation->save();
                }
            }

            // profile image file upload
            if ($request->hasFile('file')) {
                $photo = $request->all();
                $response = $this->image->upload($photo);
            }

            // this part may not be needed
            if (count($user->userProfile))
                $sessionUserProfile = $user->userProfile;
            else
                $sessionUserProfile = new UserProfile(['user_id' => $user->id]);

            // user profile short bio save
            $sessionUserProfile->short_bio = $request->get('short_bio');
            $sessionUserProfile->save();

            $alert['msg'] = 'Profile been updated successfully';
            $alert['type'] = 'success';


            return Redirect::route('account.edit')->with('alert', $alert);
        }
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
     * edit account page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $data['user'] = Auth::user();
        $data['categories'] = DB::table('categories')->orderBy('name')->pluck('name', 'id')->all();
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'id')->all();
        $data['lengths'] = Config::get('frontend.lengths');
        $user = Auth::user();
        $data['userProfile'] = $user->userProfile()->get();
        $data['userExperiences'] = $user->userExperiences()->get();
        $data['userJobInterestedLocations'] = $user->userJobInterestedLocations()->get();

        if ($alert = Session::get('alert')) {
            $data['alert'] = $alert;
        }

        return view('account.edit', $data);
    }

    /**
     * Update the account contact details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), User::$contactRules, User::$contactMessages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
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


            return Redirect::route('account.edit')->with('alert', $alert);
        }
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

    /**
     * edit contact detail page
     */
    public function edit_contact()
    {
        $user = Auth::user();
        $data['user'] = $user;
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'id')->all();

        return view('account.edit_contact', $data);
    }

    /*
     * add funds
     */
    public  function addFunds1()
    {

    }
}
