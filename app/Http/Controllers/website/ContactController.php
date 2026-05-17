<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactUs()
    {
        $contacts = Contact::all();
        return view('dashboard.website.contact.contact_us', compact('contacts'));
    }


    public function ContactAdd()
    {
        $contact = Contact::first();
        return view('dashboard.website.contact.contact_us_add' , compact('contact'));
    }


    public function ContactSave(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'office_address' => 'required',
            'phone'          => 'required',
            'email'          => 'required|email',
            // 'map'            => 'required',
            'facebook'       => 'nullable',
            'telgram'        => 'nullable',
            'watsapp'        => 'nullable',
        ]);

        Contact::updateOrCreate(
            ['id' => 1],
            [
                'office_address' => $request->office_address,
                'mobile'          => $request->phone,
                'email'          => $request->email,
                // 'map'            => $request->map,
                'facebook'       => $request->facebook,
                'telegram'        => $request->telgram,
                'watsapp'        => $request->watsapp,
            ]
        );

        $notification = array(
            'message' => 'contact_us successfuly created !',
            'alert-type' => 'success'
        );

        return redirect()->route('contact_us')->with($notification);
    }
}
