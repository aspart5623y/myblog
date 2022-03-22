<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Spatie\Newsletter\Newsletter;
use Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if (!Newsletter::isSubscribed($request['email']) ) {
            Newsletter::subscribe($request['email']);
            return redirect()->back()->with("message", "You have successfully subscribed to our newsletter!");
        } else {
            return redirect()->back()->with("error", "You have already subscribed to our newsletter!");
        }

    }
}
