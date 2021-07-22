<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class FoodController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::all();
        $data['food'] = Food::with('category')->get();
        return view('food',compact('data'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'category'=>'required',
                'name_ar'=>'required|max:30',
                'description_ar'=>'max:100',
                'name_en'=>'max:30',
                'description_en'=>'max:100',
                'price'=>'required|numeric',
                'image'=>'image'
            ],
            [
                'category.required'=>'القسم مطلوب',
                'name_ar.required'=>'الاسم باللغة العربية مطلوب',
                'name_ar.max'=>'الاسم باللغة العربية يتكون من 30 حرف فقط',
                'name_en.max'=>'الاسم يتكون من 30 حرف فقط',
                'description_ar.max'=>'الوصف باللغة العربية يتكون من 100 حرف فقط',
                'description_en.max'=>'الوصف يتكون من 100 حرف فقط',
                'price.required'=>'تأكد من السعر',
                'image.image'=>'تأكد من نوع الصورة المرفوع',
            ]

        )->validate();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->hashName('public/food');

            $img = Image::make($image->path());
//            $img->resize(600, 550);
            $img->resize(600, 550, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($path, (string) $img->encode());
        }
        else
            $path = '';

        $insert = new Food();
        $insert->name_ar = $request->name_ar ?? null;
        $insert->name_en = $request->name_en ?? null;
        $insert->description_ar = $request->description_ar ?? null;
        $insert->description_en = $request->description_en ?? null;
        $insert->price = $request->price ?? null;
        $insert->price_discounted = $request->price_discounted ??null;
        $insert->category_id = $request->category;
        $insert->image = $path==''?'image/food.png':'storage/food/'.basename($path);
        $insert->save();

        return back()->with('success','تم اضافة الاكلة الى قائمة الطعام');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }


    public function edit($id)
    {
        $value = Food::findOrFail($id);
        $categories = Category::all();
        return view('modal.edit-food-modal',compact('value','categories'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'category'=>'required',
                'name_ar'=>'required|max:30',
                'description_ar'=>'max:100',
                'name_en'=>'max:30',
                'description_en'=>'max:100',
                'price'=>'required|numeric',
                'image'=>'image'
            ],
            [
                'category.required'=>'القسم مطلوب',
                'name_ar.required'=>'الاسم باللغة العربية مطلوب',
                'name_ar.max'=>'الاسم يتكون من 30 حرف فقط',
                'name_en.max'=>'الاسم يتكون من 30 حرف فقط',
                'description_ar.max'=>'الوصف يتكون من 100 حرف فقط',
                'description_en.max'=>'الوصف يتكون من 100 حرف فقط',
                'price.required'=>'تأكد من السعر',
                'image.image'=>'تأكد من نوع الصورة المرفوع',
            ]

        )->validate();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->hashName('public/food');

            $img = Image::make($image->path());
//            $img->resize(600, 550);
            $img->resize(600, 550, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($path, (string) $img->encode());
        }

        $insert = Food::findOrFail($id);
        $insert->name_ar = $request->name_ar;
        $insert->name_en = $request->name_en;
        $insert->description_ar = $request->description_ar;
        $insert->description_en = $request->description_en;
        $insert->price = $request->price;
        $insert->price_discounted = $request->price_discounted;
        $insert->category_id = $request->category;
        $insert->status = $request->status;
        if(isset($path)) $insert->image = 'storage/food/'.basename($path);
        $insert->save();

        return back()->with('success','تم تعديل الاكلة الطعام');
    }


    public function destroy($id)
    {
        Food::where('id',$id)->delete();
        return back()->with('success','تم الحذف الاكلة ينجاح');
    }
}
