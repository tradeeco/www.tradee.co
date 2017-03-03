<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\Session;

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
        $data = [];
        if ($alert = Session::get('alert')) {
            $data['alert'] = $alert;
        }

		return view('pages.contact', $data);
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
            'email' => 'required|max:50|email',
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
            $contact = new ContactModel;
            $contact->subject = $request->get('subject');
            $contact->name = $request->get('name');
            $contact->email = $request->get('email');
            $contact->message = $request->get('message');

            Mail::send(new Contact($contact));

            $alert['msg'] = 'Contact request has been created successfully';
            $alert['type'] = 'success';

            return Redirect::route('pages.contact')->with('alert', $alert);

        }
    }
}
