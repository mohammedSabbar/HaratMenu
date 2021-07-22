<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        $data['form'] = Form::all();
        return view('form',compact('data'));
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
    }


    public function show($id)
    {
        $value = FormQuestion::where('form_id',$id)->with('question')->get();
        $form = Form::findOrFail($id);
        return view('modal.show-review-modal',compact('value','form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
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
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }

    public function searchByDate(Request $request){
        if(!$request->start)
            return back();
        $start = Carbon::parse($request->start)->format('Y-m-d');
        $end = Carbon::parse($request->end)->addDay()->format('Y-m-d');

        $data['form'] = Form::whereBetween('created_at',[$start,$end])->get();
        return view('form',compact('data'));

    }
}
