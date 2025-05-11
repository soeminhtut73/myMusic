<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    // app/Http/Controllers/Auth/LoginController.php
    protected function authenticated(Request $request, $user)
    {
        // Example: Redirect admins to admin dashboard, others to posts
        if ($user->is_admin) {
            return redirect()->route('posts.index');
        }
        
        return redirect()->route('posts.index');
    }
}
