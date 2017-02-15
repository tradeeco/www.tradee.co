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

            if ($request->hasFile('file')) {
                $photo = $request->all();
                $response = $this->image->upload($photo);
            }

            if (count($user->userProfile))
                $sessionUserProfile = $user->userProfile;
            else
                $sessionUserProfile = new UserProfile(['user_id' => $user->id]);

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
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $data['user'] = Auth::user();
        $data['categories'] = DB::table('categories')->orderBy('name')->pluck('name', 'id')->all();
        $data['locations'] = DB::table('area_suburbs')->orderBy('name')->pluck('name', 'id')->all();
        $data['lengths'] = [
            '' => '',
            '1' => '1 year',
            '2' => '2 years',
        ];
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
