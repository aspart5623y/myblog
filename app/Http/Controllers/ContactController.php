<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Repositories\ContactRepository;

class ContactController extends Controller
{

    public function create()
    {
        return view('contact');
    }

    public function store(ContactRequest $request, ContactRepository $contactRepository)
    {
        $validatedData = $request->validated();
        $contactRepository->store($validatedData);
        return back()->with('contact', 'Thank you for contacting us. We will get back to you soon through the email you provided');
    }

    
}
