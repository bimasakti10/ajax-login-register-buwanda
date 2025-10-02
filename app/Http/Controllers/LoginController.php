<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Laravel 8+ pakai facade ini

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Proses login via AJAX
     */
    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil!'
            ], 200);
        }

        // Login gagal
        return response()->json([
            'success' => false,
            'message' => 'Login Gagal! Email atau password salah.'
        ], 401);
    }
}