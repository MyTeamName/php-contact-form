<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContactForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactForm $request)
    {
        $contact = Contact::create($request->validated());

        Mail::to('guy-smiley@example.com')->send(new NewContact($contact));

        return response()->view('success', [], 201);
    }
}
