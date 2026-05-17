<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Tistimonail;
use Illuminate\Http\Request;

class TestimonalController extends Controller
{
    public function Testimonial_list()
    {
        $testimonials = Tistimonail::all();
        return view('dashboard.website.testimonial.testimonials', compact('testimonials'));
    }

    public function TestimonialAdd()
    {
        return view('dashboard.website.testimonial.testimonial_add');
    }

    public function TestimonialSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'position' => 'required',
            'reting' => 'required|numeric|min:1|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $testimonial = new Tistimonail();
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->message = $request->message;
        $testimonial->rating = $request->reting;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/testimonials'), $imageName);
            $testimonial->image = 'images/testimonials/' . $imageName;
        }
        $testimonial->save();

        $notification = array(
            'message' => 'testimonial added successfully!',
            'alert-type' => 'success'
        );


        return redirect()->route('testimonials')->with($notification);
    }



    public function TestimonialEdit($id)
    {
        $testimonial = Tistimonail::findOrFail($id);
        return view('dashboard.website.testimonial.testimonial_edit', compact('testimonial'));
    }

    public function TestimonialUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'position' => 'required',
            'reting' => 'required|numeric|min:1|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $testimonial = Tistimonail::findOrFail($id);
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->message = $request->message;
        $testimonial->rating = $request->reting;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/testimonials'), $imageName);
            $testimonial->image = 'images/testimonials/' . $imageName;
        }

        $testimonial->save();

        $notification = array(
            'message' => 'testimonial updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('testimonials')->with($notification);
    }


    public function TestimonialDelete($id)
    {
        $testimonial = Tistimonail::findOrFail($id);
        $testimonial->delete();

        $notification = array(
            'message' => 'testimonial deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('testimonials')->with($notification);
    }
}
