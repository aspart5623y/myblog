<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function render()
    {
        $contacts = Contact::all();
        return view('admin.admin-contact', compact('contacts'));
    }
}

