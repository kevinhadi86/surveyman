<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormTag;
use App\History;
use App\Wallet;
use Illuminate\Http\Request;
use App\User;
use App\Tag;
use App\UserTag;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showHome(){
        return view('home');
    }
    public function showSurveyList(){
        $user = User::find(Session::get('user_id'));
        if(!($user->wallet)) {
            $wallet = new Wallet;
            $wallet->user_id = $user->id;
            $wallet->points = 0;
            $wallet->rekening = "";
            $wallet->save();
            $wallet = Wallet::where('user_id',$user->id)->first();
            $user->wallet_id = $wallet->id;
            $user->save();
        }
        $user_tag = $user->tag->tag;
        $forms = Form::all();
//        $form_tag = [];
//        foreach($forms as $form){
//            $tag = Form::find($history->form_id);
//            array_push($forms,$form);
//        };
//        dd($form_tag);
        return view('surveylist',compact('forms','user_tag'));
    }
    public function showHistory(){
        $histories = History::where('user_id',Session::get('user_id'))->get();
        $forms = [];
        foreach($histories as $history){
            $form = Form::find($history->form_id);
            array_push($forms,$form);
        };
//        dd($forms);
        return view('history', compact('forms'));
    }
    public function edit(){
        $tags=Tag::all();
        $user = User::find(Session::get('user_id'));
//        $user_tag= $user->tag;
//        $user_tag = $user->tag;
//        dd($user);
        return view('changeprofile',compact('user','tags'));
    }
    public function update(Request $request, $id){
        $user = User::find($id)->first();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->occupation = $request->occupation;
        $user->save();
        if(!($user->tag)){
            $user_tag = new UserTag;
            $user_tag->user_id = $user->id;
            $user_tag->tag = $request->tag;
            $user_tag->save();
        }else{
            $user_tag = $user->tag;
            $user_tag->tag=$request->tag;
            $user_tag->save();
        }
        $wallet = $user->wallet;
        $wallet->rekening = $request->rekening;
        $wallet->save();

        return redirect('/surveylist');
    }
    public function showLogin(){
    	return view('login');
    }
    public function login(Request $request){
        $data = User::where('email',$request->email)->first();
    	if(!empty($data)){
    		if ($request->password == $data->password) {
    			Session::put('user_id', $data->id);
    			Session::put('name', $data->firstname);
    			Session::put('email', $data->email);
    			Session::put('isLogin',TRUE);

    			return redirect('/surveylist');
    		}else{
    			return redirect('/login')->with('alert','Password/Email Salah!');
    		}
    	}else{
    		return redirect('/login')->with('alert','Password/Email Salah!');
    	}
    }
    public function showRegister(){
    	return view('login');
    }
    public function store(Request $request){
    	$user = $request->all();
    	User::create($user);
    	return redirect('/login');
    }

    public function logout(){
    	Session::flush();
    	return redirect('/home');
    }
}
