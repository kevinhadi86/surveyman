<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FormController extends Controller
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
        $form = new Form;
        $form->user_id = Session::get('user_id');
        $form->title = "Untitled Form";
        $form->description = "No Description";
        $form->totalpoints = 0;
        $form->points = 0;
        $form->quota = 0;
        $form->save();
        return redirect('/form/'.$form->id.'/question');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function updateTitle(Request $request, Form $form, $id)
    {
        $form = Form::find($id);
        $form->title = $request->value;
        $form->save();
        return response()->json($form);
    }
    public function updatePoints(Request $request, Form $form, $id)
    {
        $form = Form::find($id);
        $form->totalpoints = $request->value;
        if($form->quota !=0){
            $form->points = $form->totalpoints / $form->quota;
        }
        $form->save();
        return response()->json($form);
    }
    public function updateQuota(Request $request, Form $form, $id)
    {
        $form = Form::find($id);
        $form->quota = $request->value;
        $form->points = $form->totalpoints / $form->quota;
        $form->save();
        return response()->json($form);
    }
    public function updateTag(Request $request, $id)
    {
        $form = Form::find($id);
        if(!($form->tag)){
            $form_tag = new FormTag;
            $form_tag->form_id = $id;
            $form_tag->tag = $request->value;
            $form_tag->save();
        }else{
            $form_tag = $form->tag;
            $form_tag->tag=$request->value;
            $form_tag->save();
        }
        return response()->json($form);
    }
    public function updateDescription(Request $request, Form $form, $id)
    {
        $form = Form::find($id);
        $form->description = $request->value;
        $form->save();
        return response()->json($form);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form, $id)
    {
        $form = Form::findOrFail($id)->delete();
        return redirect('/home');
    }
}
