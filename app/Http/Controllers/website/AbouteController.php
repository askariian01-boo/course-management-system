<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AbouteController extends Controller
{
    public function Abouts()
    {
        $abouts = About::all();
        return view('dashboard.website.about.abouts', compact('abouts'));
    }


    public function AboutAdd()
    {
        return view('dashboard.website.about.about_add');
    }

    public function AboutSave(Request $request)
    {
        // ذخیره تصویر و دریافت نام فایل
        $image = $request->file('image');
        $imagename = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/abouts'), $imagename);

        $about = new About();
        $about->title = $request->title;
        $about->description = $request->description;
        $about->image = $imagename;
        $about->save();

        $notification = array(
            'message' => 'abouts course successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('abouts')->with($notification);
    }


    public function AboutEdit($id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.website.about.about_edit', compact('about'));
    }


    public function AboutUpdate(Request $request, $id)
    {
        $about = About::findOrFail($id);
        $image = $request->file('image');
        if ($image) {
            $imagename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/abouts'), $imagename);
            $about->image = $imagename;
        }
        $about->title = $request->title;
        $about->description = $request->description;
        $about->save();

        $notification = array(
            'message' => 'abouts course successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('abouts')->with($notification);
    }       


    public function AboutDelete($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        $notification = array(
            'message' => 'abouts course successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('abouts')->with($notification);
    }
}
