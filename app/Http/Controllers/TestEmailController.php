<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        $testEmail = 'test@example.com';
        try {
            Mail::raw('This is a test email, hello!.', function ($message) use ($testEmail) {
                $message->to($testEmail)
                        ->subject('Test Email for Chatcord');
            });
            return 'Test email sent successfully.';
        } catch (\Exception $e) {
            \Log::error('Error sending test email: ' . $e->getMessage());
            return 'Failed to send test email :(';
        }
    }
}

