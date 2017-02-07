<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $categories = Category::all();

        if ($alert = Session::get('alert')) {
            $data['alert'] = $alert;
        }

        $data['categories'] = $categories;
        return view('admin.category.index', $data);
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
            'name.*' => 'required|string|min:2',
        ], $this->messages($request));

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            foreach($request->get('name') as $key => $category_name)
            {
                // Check if task exists and update task
                // Add new task
                $category = new Category;
                $category->name = $category_name;
                $category->admin_id = Auth::user()->id;
                $category->save();
            };

            $alert['msg'] = 'Category(s) has been added successfully';
            $alert['type'] = 'success';

            return Redirect::route('admin.categories.index')->with('alert', $alert);
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
        Category::find($id)->delete();

        $alert['msg'] = 'Category has been deleted successfully';
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
            }
        }
        return $messages;
    }
}
