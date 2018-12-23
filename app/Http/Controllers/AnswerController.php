<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Form;
use App\History;
use App\Question;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $form = Form::find($id);
        $questions = Question::where('form_id',$form->id)->get();
//        dd($questions);
//        $options = $questions->tags();
        return view('answer', compact('form','questions'));
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
    public function store(Request $request,$id)
    {
        $answers=$request->all();
        $count = count($answers['data']);
        for($i=0;$i<$count;$i++){
            $answer= new Answer;
            $answer->user_id = $answers['user'];
            $answer->form_id = $id;
            $answer->question_id = $answers['q_id'][$i];
            $answer->answer = $answers['data'][$i];
            $answer->save();
        }
        $form = Form::find($id);
        $form->quota = ($form->quota)-1;
        $form->save();
        $user=User::find($answers['user']);
        $wallet = Wallet::find($user->wallet_id);
        $wallet->points = $wallet->points + $form->points;
        $wallet->save();
        $history = new History;
        $history->user_id = $user->id;
        $history->form_id = $id;
        $history->save();
        return response()->json($count);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
