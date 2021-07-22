<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::withCount(['foods' => function (Builder $query) {
            $query->where('status', 1);
        }])->orderBy('seq')->get();
        return view('category',compact('data'));
    }

    public function show($id)
    {
        $data['categories'] = Category::all();
        $data['food'] = Food::where('category_id',$id)->with('category')->get();
        $data['id'] = $id;
        return view('food',compact('data'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar'=>'required|max:30',
                'name_en'=>'max:30',
                'image'=>'image',
                'seq'=> 'required|numeric'
            ],
            [
                'name_ar.required'=>'الاسم باللغة العربية مطلوب',
                'name_ar.max'=>'الاسم باللغة العربية يتكون من 30 حرف فقط',
                'name_en.max'=>'الاسم يتكون من 30 حرف فقط',
                'image.image'=>'تأكد من نوع الصورة المرفوع',
                'seq.required'=>'التسلسل مطلوب',
                'seq.numeric'=>'التسلسل يجب ان يكون رقم',
            ]

        )->validate();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->hashName('public/category');

            $img = Image::make($image->path());
//            $img->resize(600, 550);
            $img->resize(600, 550, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($path, (string) $img->encode());
        }
        else
            $path = '';

        $insert = new Category();
        $insert->name_ar = $request->name_ar ?? null;
        $insert->name_en = $request->name_en ?? null;
        $insert->seq = $request->seq ?? 999;
        $insert->image = $path==''?'image/category.png':'storage/category/'.basename($path);
        $insert->save();

        return back()->with('success','تم اضافة القسم بنجاح');
    }


    public function edit($id)
    {
        $value = Category::findOrFail($id);
        return view('modal.edit-category-modal',compact('value'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar'=>'required',
                'image'=>'image',
                'seq'=> 'required|numeric'
            ],
            [
                'name_ar.required'=>'الاسم باللغة العربية مطلوب',
                'name_ar.max'=>'الاسم باللغة العربية يتكون من 30 حرف فقط',
                'name_en.max'=>'الاسم يتكون من 30 حرف فقط',
                'image.image'=>'تأكد من نوع الصورة المرفوع',
                'seq.required'=>'التسلسل مطلوب',
                'seq.numeric'=>'التسلسل يجب ان يكون رقم',
            ]

        )->validate();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->hashName('public/category');

            $img = Image::make($image->path());
//            $img->resize(600, 550);
            $img->resize(600, 550, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($path, (string) $img->encode());
        }

        $insert = Category::findOrFail($id);
        $insert->name_ar = $request->name_ar;
        $insert->name_en = $request->name_en;
        $insert->seq = $request->seq;
        if(isset($path)) $insert->image = 'storage/category/'.basename($path);
        $insert->save();

        return back()->with('success','تم تعديل القسم بنجاح');
    }


    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return back()->with('success','تم الحذف القسم ينجاح');
    }
}
