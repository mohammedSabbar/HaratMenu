<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\Question;
use App\Models\Slider;
use Cron\FieldFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobileController extends Controller
{

    public function category($id=0){
        $data['storage_url'] = url('/').'/';
        $data['sliders'] = Slider::select('image')->get();
        $data['categories'] = Category::select('id','name_ar','name_en','image')->orderBy('seq')->get();
        if($id == 0)
            $data['food'] = Food::select(['id','name_ar','name_en','description_ar','description_en','price','price_discounted','status','image'])->where('status',1)->get();
        else
            $data['food'] = Food::select(['id','name_ar','name_en','description_ar','description_en','price','price_discounted','status','image'])->where('status',1)->where('category_id',$id)->get();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return $response;
    }

    public function form(){
        $data['questions'] = Question::select('id','title_ar','title_en')->where('is_delete',false)->get();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return $response;
    }

    public function submitForm(Request $request){

        $validation = Validator::make($request->all(),
            [
                'table_number'=>'required',
            ],

        );

        if($validation->fails()){

            $response = [
                'success' => false,
                'message' => 'تأكد من رقم الطاولة',
                'data' => null,
            ];
            return $response;
        }

        $form = new Form();
        $form->customer_name = $request->customer_name?? null;
        $form->customer_phone = $request->customer_phone?? null;
        $form->suggestion = $request->suggestion??null;
        $form->visit = $request->visit??null;
        $form->table_number = $request->table_number;
        $form->save();

        foreach ($request->questions as $question)
        {
            $form_question = new FormQuestion();
            $form_question->question_id = $question['question_id'];
            $form_question->form_id = $form->id;
            $form_question->rating = $question['rating'];
            $form_question->save();
        }

        $response = [
            'success' => true,
            'message' => null,
            'data' => "تم اضافة الاستبيان بنجاح",
        ];
        return $response;
    }

    public function slider($id=0){
        if($id==0)
            $data = Slider::where('status',true)->get();
        else
            $data = Slider::where('status',true)->where('id',$id)->get();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return $response;
    }

    public function categoryOnly($id=0){
        if($id==0)
            $data = Category::all();
        else
            $data = Category::findOrFail($id);
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return $response;
    }

    public function food($id=0){
        if($id==0)
            $data = Food::all();
        else
            $data = Food::findOrFail($id);
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return $response;
    }

    public function foodByCategory($id=0){
        if($id==0)
            $data = Food::all();
        else
            $data = Food::where('category_id',$id)->get();
        $response = [
            'success' => true,
            'message' => null,
            'data' => $data,
        ];
        return $response;
    }
}
