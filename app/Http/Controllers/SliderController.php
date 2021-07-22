<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{

    public function index()
    {
        $data['sliders'] = Slider::all();
        return view('slider',compact('data'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|max:30',
                'image'=>'image'
            ],
            [
                'name.required'=>'الاسم باللغة العربية مطلوب',
                'name_ar.max'=>'الاسم باللغة العربية يتكون من 30 حرف فقط',
                'image.image'=>'تأكد من نوع الصورة المرفوع',
            ]

        )->validate();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->hashName('public/slider');

            $img = Image::make($image->path());
//            $img->resize(940, 530);
            $img->resize(940, 530, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($path, (string) $img->encode());
        }
        else
            $path = '';

        $insert = new Slider();
        $insert->name = $request->name ?? '';
        $insert->image = $path==''?'image/slider.png':'storage/slider/'.basename($path);
        $insert->save();

        return back()->with('success','تم اضافة صورة الى شريط العرض');
    }


    public function edit($id)
    {
        $value = Slider::findOrFail($id);
        return view('modal.edit-slider-modal',compact('value'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|max:30',
                'image'=>'image'
            ],
            [
                'name.required'=>'الاسم باللغة العربية مطلوب',
                'name_ar.max'=>'الاسم باللغة العربية يتكون من 30 حرف فقط',
                'image.image'=>'تأكد من نوع الصورة المرفوع',
            ]

        )->validate();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = $image->hashName('public/slider');

            $img = Image::make($image->path());
//            $img->resize(940, 530);
                $img->resize(940, 530, function ($const) {
                $const->aspectRatio();
            });
            Storage::put($path, (string) $img->encode());
        }

        $insert = Slider::findOrFail($id);
        $insert->name = $request->name;
        $insert->status = $request->status;
        if(isset($path)) $insert->image = 'storage/slider/'.basename($path);
        $insert->save();

        return back()->with('success','تم تعديل صورة الى شريط العرض');
    }

    public function destroy($id)
    {
        Slider::where('id',$id)->delete();
        return back()->with('success','تم الحذف  شريط العرض ينجاح');
    }
}
