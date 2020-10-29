<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    public function index()
    {
        $question = Question::all();
        return view('admin.questions.question', ['question' => $question]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question'=>'required',
            'a'=>'required',
            'b'=>'required',
            'c'=>'required',
            'd'=>'required',
            'answer'=>'required',

        ]);
        $question = Question::updateOrCreate(['id' => $request->id], [
            'question' => $request->question,
            'a' => $request->a,
            'b'=>$request->b,
            'c'=>$request->c,
            'd'=>$request->d,
            'answer'=>$request->answer

        ]);

        return response()->json(
            [      'code'=>200,
                'message'=>'Question Created successfully',
                'data' => $question
            ],
            200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return response()->json($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id)->delete();
        return response()->json(
            ['success'=>'Question Deleted successfully']
        );
    }
}
