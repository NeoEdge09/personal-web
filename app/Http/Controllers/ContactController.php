<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = new ContactMessage();
        $contact->name = $validated['name'];
        $contact->email = $validated['email'];
        $contact->subject = $validated['subject'];
        $contact->message = $validated['message'];
        $contact->status = ContactMessage::STATUS_UNREAD;
        $contact->save();

        return back()->with('success', 'Your message has been sent successfully. I will contact you soon!');
    }
}
