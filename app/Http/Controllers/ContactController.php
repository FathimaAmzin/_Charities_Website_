<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10|max:3000',
        ]);

        $validated['status'] = 'unread';

        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Thank you for reaching out! Your message has been received by the Social Development Council team. We will respond promptly.');
    }
}
