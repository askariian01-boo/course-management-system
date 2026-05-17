<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Classes;
use App\Models\Contact;
use App\Models\Teacher;
use App\Models\Tistimonail;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // home page
    public function index()
    {
        $about = About::first();
        $categories = Classes::all();
        $teachers = Teacher::paginate(4);
        $testimonials = Tistimonail::latest()->get();

        return view('welcome', compact(
            'about',
            'categories',
            'teachers',
            'testimonials'
        ));
    }

    // abouts us page
    public function aboutPage()
    {
        $about = About::first();
        $teachers = Teacher::paginate(4);

        return view('website.about.abouts', compact('about', 'teachers'));
    }

    // Controller classes 

    public function Courses()
    {
        $categories = Classes::latest()->take(4)->get();
        $testimonials = Tistimonail::latest()->get();
        $teachers = Teacher::paginate(4);

        return view('website.courses.courses', compact(
            'categories',
            'testimonials',
            'teachers'
        ));
    }


    // Controller testimonials

    public function TestimonialPage()
    {
        $about = About::first();
        $testimonials = Tistimonail::latest()->get();

        return view('website.testimonial.testimonial', compact(
            'about',
            'testimonials'
        ));
    }


    public function ContactPage()
    {
        $contact = Contact::first(); // یا latest()->first()

        return view('website.contact.contact', compact('contact'));
    }
}
