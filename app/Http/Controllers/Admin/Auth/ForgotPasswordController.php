<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }
}
