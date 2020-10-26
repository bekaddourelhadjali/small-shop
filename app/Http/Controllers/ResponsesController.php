<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Response;
use auth;

class ResponsesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $response=new  Response();
        $response->user_id=Auth::user()->id;
        $response->text=$request->text;
        $response->question_id=$request->question_id;
        $response->save();
        return  redirect(route('question.show',['id'=> $response->question->id]));
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
        $response_e=Response::findOrFail($id);

        return view('question',["question"=>$response_e->question,"responses"=>$response_e->question->responses,'response_e'=>$response_e]);
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
        $response =Response::findOrFail($id);
        $response->text=$request->text;
        $response->save();
        return  redirect(route('question.show',['id'=> $response->question->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { $response =Response::findOrFail($id);
    $response->delete();
      return   redirect(route('question.show',['id'=> $response->question->id]));
    }
}
