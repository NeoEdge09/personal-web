<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'phone' => 'nullable',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            // Create and save the contact message
            $contact = new ContactMessage();
            $contact->name = $validated['name'];
            $contact->email = $validated['email'];
            $contact->subject = $validated['subject'];
            $contact->message = $validated['message'];
            $contact->phone = $request->input('phone'); // Optional field
            $contact->status = ContactMessage::STATUS_UNREAD;
            $contact->save();

            // Send email notification
            $this->sendEmailNotification($contact);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your message has been sent successfully. We will contact you soon!'
                ]);
            }

            return back()->with('success', 'Your message has been sent successfully. We will contact you soon!');
        } catch (\Exception $e) {
            dd($e->getMessage()); // For debugging purposes, remove in production
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error sending your message. Please try again later.'
                ], 500);
            }

            return back()->with('error', 'There was an error sending your message. Please try again later.');
        }
    }

    private function sendEmailNotification(ContactMessage $contact): void
    {
        // Try to get admin email from site settings
        $adminEmail = null;
        try {
            $about = About::first();
            if ($about && !empty($about->email)) {
                $adminEmail = $about->email;
            }
        } catch (\Exception $e) {
            // If there's an error, fallback to the env admin email
        }

        // Fallback to env if site settings email is not available
        if (!$adminEmail) {
            $adminEmail = config('mail.from.address');
        }

        // Get site settings
        $siteSettings = SiteSetting::first() ?? new \stdClass();
        $siteSettings->site_name = $siteSettings->site_name ?? config('app.name', 'My Website');

        // Send email notification to admin
        $data = [
            'name' => $contact->name,
            'email' => $contact->email,
            'subject' => $contact->subject,
            'messageContent' => $contact->message,
            'phone' => $contact->phone,
            'siteSettings' => $siteSettings, // Add site settings to the data
        ];

        Mail::send('emails.contact', $data, function ($message) use ($contact, $adminEmail) {
            $message->to($adminEmail)
                ->subject('New Contact Form Submission: ' . $contact->subject);
            $message->replyTo($contact->email, $contact->name);
        });
    }
}
