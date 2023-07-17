<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'subject' => 'required',
          'content' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'content' => $request->content
        ];

        Mail::send('email.mail-temp', $data, function($message) use ($data) {
          $message->to($data['email'])->subject($data['subject']);
        });

        return back()->with(['message' => 'Email successfully sent!']);
    }
}
