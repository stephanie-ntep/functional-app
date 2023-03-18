<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function showDashboard()
    {
        return view('sidemenu.dashboard');
    }

    public function checkLogin(Request $request)
    {

        $user = User::where('email', $request->email)
                    ->where('password', $request->password)
                    ->firstOrFail();
        
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return redirect()->intended(Route('dashboard'));
    }

    public function logout()
    {
        return view('login.index');
    }
}
