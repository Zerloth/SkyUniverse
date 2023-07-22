<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createRegister()
    {
        return view('register');
    }

    public function storeRegister(Request $request)
    {
        $genderCode = $request->gender == 'male' ? '01' : '02';
        $id = 'SKY' . substr($request->dating_code, 2) . $genderCode;
        $request->merge(['id' => $id]);

        $validated =  $request->validate([
            'id' => 'unique:users',
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|unique:users',
            'dating_code' => 'required|regex:/^DT[0-9]{3}$/',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required|regex:/^[0-9]{10,14}$/',
            'image' => 'required|image',
            'password' => 'required|string|confirmed|min_digits:8',
            'password_confirmation' => 'required|string',
        ], [
            'id' => "ID DT sudah terpakai"
        ]);

        $image_path = $request->file('image')->storeAs(
            'public/profiles',
            $id
        );

        $user = User::create([
            'id' => $id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'dating_code' => $validated['dating_code'],
            'birthday' => $validated['birthday'],
            'gender' => $validated['gender'],
            'phone_number' => "+65" . $validated['phone_number'],
            'image_path' => $image_path,
            'password' => Hash::make($validated['password']),
            'status' => 'online'
        ]);

        Auth::login($user);

        return redirect()->back()->with('status', 'Selamat akun anda berhasil dibuat, anda dapat login menggunakan ' . $validated['email'] . ' atau ' . $id);
    }

    public function createLogin()
    {
        return view('login');
    }

    public function storeLogin(Request $request)
    {
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'id';
        $request->merge([$loginType => $request->login]);

        $credentials = $request->validate([
            'email' => 'required_without:id|email|exists:users',
            'id' => 'required_without:email|string|exists:users',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->status == 'banned') {
                return redirect()->route('banned');
            } else {
                return redirect()->route('home');
            }
        } else {
            return back()->withErrors([
                'password' => 'The provided credentials do not match our records.',
            ])->onlyInput('login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
