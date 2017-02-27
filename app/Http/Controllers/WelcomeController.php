<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
//		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function contact()
	{
        Mail::to('sokomheng89@gmail.com')->send(new Contact());
		return view('pages.contact');
	}

	public function story()
    {
        return view('pages.story');
    }
    public function aboutUs()
    {
        return view('pages.about_us');
    }

    public function postContact(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:25',
            'email' => 'required|max:25',
            'subject' => 'required|max:25',
            'message' => 'required|max:1000',
        ];

        $messages = [
            'photo_ids.required' => 'The photo field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Mail::to('sokomheng89@gmail.com')->send(new Contact($request->all()));
        }
    }
}
