<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Models\JobAnswer;
use App\Models\JobQuestion;

class JobAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($answerId)
    {
        //
        $data['jobAnswer'] = JobAnswer::find($answerId);
        return Response::json(
            view('job.question_answer.answer_partial', $data)->render()
            , 200);

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
    public function store(Request $request, $questionId)
    {
        //
        $validator = Validator::make($request->all(), JobAnswer::$rules, JobAnswer::$messages);

        if ($validator->fails() || count(JobQuestion::find($questionId)) == 0) {
            return Response::json([
                'error' => true,
                'message' => $validator->errors(),
                'code' => 422
            ], 422);
//            return Redirect::back()
//                ->withErrors($validator)
//                ->withInput();
        } else {
            $JobAnswer = new JobAnswer;
            $JobAnswer->content = $request->get('content');
            $JobAnswer->user_id = Auth::user()->id;
            $JobAnswer->job_question_id = $questionId;
            $JobAnswer->save();

//            $alert['msg'] = 'Job has been created successfully';
//            $alert['type'] = 'success';

            return Response::json(
                $JobAnswer
                , 200);
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
    }
}
