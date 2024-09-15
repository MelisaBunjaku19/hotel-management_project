<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
// Ensure this model is correctly defined

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::to('your-email@example.com')->send(new ContactMail($validatedData));

        // Return a response (you might want to redirect to a thank you page)
        return response()->json(['message' => 'Your message has been sent successfully!']);

        // Save contact form data to the database
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
