<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerForm;
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
    public function create($id)
    {
        $form = Form::find($id);
        $questions = Question::where('form_id',$form->id)->get();
//        dd($questions);
//        $options = $questions->tags();
        return view('answer', compact('form','questions'));
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
        $answerform = new AnswerForm;
        $answerform->user_id = $answers['user'];
        $answerform->form_id = $id;
        $answerform->save();
        for($i=0;$i<$count;$i++){
            $answer= new Answer;
            $answer->answer_form_id = $answerform->id;
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
    public function index(Answer $answer)
    {
        $forms = Form::where('user_id',Session::get('user_id'))->get();
        return view('viewanswer',compact('forms'));
    }
    public function show($id){
        $form = Form::find($id);
        $questions = $form->questions;
        $answerforms = $form->answerforms;
        return view('viewdetailanswer',compact('form','questions','answerforms'));
    }
    public function statistic($id){
        $form = Form::find($id);
        $array =[];
        foreach ($form->questions as $question){
            count($question->answers);
            $count_answer= [];
            for($i=0; $i<count($question->answers);$i++){
                array_push($count_answer,$question->answers[$i]->answer);
            }
            $name = array_unique($count_answer);
            $count= array_count_values($count_answer);
            array_push($array,[$name,$count]);
        }
//            dd($array);
        return view('viewstatistic',compact('form','array'));
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
