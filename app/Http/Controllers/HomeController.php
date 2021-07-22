<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()) {
            $data['category'] = Category::orderBy('seq')->get();
            return view('home', compact('data'));
        }
        else
            return redirect()->route('menu');
    }

    public function print($id){
        $data['form'] = Form::findOrFail($id);
        $data['questions'] = FormQuestion::where('form_id',$id)->with('question')->get();
        return view('print',compact('data'));
    }

    public function printAll(Request $request){
        if(!$request->start)
            $data = Form::with('formQuestion.question')->get();
        else{
            $start = Carbon::parse($request->start)->format('Y-m-d');
            $end = Carbon::parse($request->end)->addDay()->format('Y-m-d');
            $data = Form::whereBetween('created_at',[$start,$end])->with('formQuestion.question')->get();
        }


        return view('print_all',compact('data'));
    }

    public function menu($id = 0){
        $data['categories'] = Category::all();

        if($id == 0) {
            $data['foods'] = Food::where('category_id',$data['categories'][0]->id)->where('status',1)->get();
            $data['category_name'] = $data['categories'][0]->name_ar;
        }
        else {
            $data['foods'] = Food::where('category_id', $id)->get();
            $data['category_name'] = Category::findOrFail($id)->name_ar;
        }


        return view('menu',compact('data'));
    }

    public function foodByCategory($id){
        $foods = Food::where('category_id', $id)->where('status',1)->get();
        $div = '';
        foreach ($foods as $food){
            $div .= '<div class="product-col col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <a href="#Input"  data-toggle="modal" class="mt-2 ml-3" id="description" data-target="#modal" data-attr="'.route('menu.description', $food->id).'">
                <div dir="rtl" class="sc-pNWxx cSBMRi">
                    <div class="product-image">
                        <div class="product-image-container">
                            <div class="lazyload-wrapper">
                                <img src="/'.$food->image.'" alt="'.$food->name_ar.'">
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-title d-flex align-items-start align-items-lg-center">'.$food->name_ar.'</div>
                        <div class="product-price ltr"><span class="current-price">'.number_format($food->price).'</span></div>
                    </div>
                </div>
                </a>
            </div>';
        }
        return $div;
    }

    public function description($id){
        $food = Food::findOrFail($id);
        return view('modal.description-menu',compact('food'));
    }

    public function qr(){
        return view('qr');
    }

}
