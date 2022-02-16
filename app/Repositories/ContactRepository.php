<?php 
namespace App\Repositories;

use App\Models\Contact;

class ContactRepository {
    public function store($data)
    {
        $contact = new Contact();
        $contact->name = $data['name'];
        $contact->email = $data['email'];
        $contact->message = $data['message'];
        $contact->save();

        if ($contact) {
            return response()->json('success', 200);
        } else {
            return response()->json('Error sending your message', 500);
        }
    }
}