<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function sendMessage(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);


        $contact = new Contact();
        $contact->name = $name;
        $contact->email = $email;
        $contact->message = $message;
        $contact->save();


        return back()->with('contact', 'Thank you for contacting us. We will get back to you soon through the email you provided');
    }

    public function render()
    {
        return view('contact');
    }
}
