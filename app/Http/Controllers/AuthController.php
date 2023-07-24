<?php

namespace App\Http\Controllers;

use App\Events\PartnerExist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function createRegister()
    {
        return view('register');
    }

    public function storeRegister(Request $request)
    {
        $genderCode = $request->gender == 'male' ? '01' : '02';
        $id = 'SKY' . $request->dating_code . $genderCode;
        $request->merge(['id' => $id]);

        $validated =  $request->validate([
            'id' => 'unique:users',
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|unique:users',
            'dating_code' => 'required|regex:/^[0-9]{3}$/',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required|regex:/^[0-9]{10,14}$/',
            'image' => 'required|image',
        ], [
            'id' => "ID DT sudah terpakai"
        ]);

        $uploaded_image = $request->file('image');
        // $image_path = $request->file('image')->storeAs(
        //     'public/profiles',
        //     $id . $uploaded_image->getClientOriginalExtension()
        // );
        $image_path = Storage::putFileAs('public/profiles', $uploaded_image, $id . $uploaded_image->getClientOriginalExtension());

        $user = User::create([
            'id' => $id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'birthday' => $validated['birthday'],
            'gender' => $validated['gender'],
            'dating_code' => 'DT' . $validated['dating_code'],
            'phone_number' => "+65" . $validated['phone_number'],
            'image_path' => $image_path,
            'password' => Hash::make($validated['password']),
            'status' => 'online'
        ]);

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
            $user = Auth::user();
            if (Auth::user()->role == 'admin') //1 = Admin Login
            {
                return redirect()->route('admin.home');
            }
            if ($user->status == 'banned') {
                return redirect()->route('banned');
            } else {
                event(new PartnerExist($user->dating_code));
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
