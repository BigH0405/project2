<?php

namespace App\Http\Controllers\clients\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerifyClientsController extends Controller
{
    use VerifiesEmails;
    protected $redirectTo;
    
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->redirectTo = route('clients.login');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('layouts.clients.auth.verify');
    }
}
