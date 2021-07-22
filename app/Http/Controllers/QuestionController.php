<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function index()
    {
        $data['questions'] = Question::withCount(['forms' => function (Builder $query) {
            $query->select(DB::raw('sum(rating)/count(rating) as total_rating'));
        }])->get();
        return view('question',compact('data'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title_ar'=>'required',
            ],
            [
                'title_ar.required'=>'الاسم باللغة العربية مطلوب',
            ]

        )->validate();

        $insert = new Question();
        $insert->title_ar = $request->title_ar ?? null;
        $insert->title_en = $request->title_en ?? null;
        $insert->save();

        return back()->with('success','تم اضافة الاستبيان بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }


    public function edit($id)
    {
        $value = Question::findOrFail($id);
        return view('modal.edit-question-modal',compact('value'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'title_ar'=>'required',
            ],
            [
                'title_ar.required'=>'الاسم باللغة العربية مطلوب',
            ]

        )->validate();

        $insert = Question::findOrFail($id);
        if($insert->is_delete)
            return back()->with('danger','لايمكن تعديل استبيان محذوف');

        $insert->title_ar = $request->title_ar;
        $insert->title_en = $request->title_en;
        $insert->status = $request->status;
        $insert->save();

        return back()->with('success','تم تعديل الاستبيان بنجاح');
    }


    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->is_delete = true;
        $question->save();
        return back()->with('success','تم حذف الاستبيان بنجاح');
    }
}
