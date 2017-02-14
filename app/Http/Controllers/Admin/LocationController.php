<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Models\AreaSuburb;

class LocationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = AreaSuburb::paginate(10);

        if ($alert = Session::get('alert')) {
            $data['alert'] = $alert;
        }

        $data['locations'] = $locations;
        return view('admin.location.index', $data);
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
        $validator = Validator::make($request->all(), [
            'name.*' => 'required|string|min:2|max:25',
        ], $this->messages($request));

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            foreach($request->get('name') as $key => $location_name)
            {
                // Check if task exists and update task
                // Add new task
                $location = new AreaSuburb;
                $location->name = $location_name;
                $location->admin_id = Auth::user()->id;
                $location->save();
            };

            $alert['msg'] = 'Location(s) has been added successfully';
            $alert['type'] = 'success';

            return Redirect::route('admin.locations.index')->with('alert', $alert);
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
        AreaSuburb::find($id)->delete();

        $alert['msg'] = 'Location has been deleted successfully';
        $alert['type'] = 'success';

        return Response::json(
            [
                'result' => 'success',
            ], 200);
    }

    public function messages($request)
    {
        $messages = [];
        if (isset($request)) {
            foreach ($request->get('name') as $key => $val) {
                $messages['name.' . $key . '.required'] = 'This field is required.';
                $messages['name.' . $key . '.min'] = 'This field should be more than 2 characters.';
                $messages['name.' . $key . '.max'] = 'This field should be less than 25 characters.';
            }
        }
        return $messages;
    }
}
