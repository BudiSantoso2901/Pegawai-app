<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        return view("Auth/register");
    }

    public function processRegister(request $request)
    {
        $request->validate([
            "nama"             => "required",
            "posisi"           => "required",
            "nomer_hp"         => "required|min:10|max:12",
            "perusahaan"       => "required|nullable|string",
            "email"            => "required|unique:users",
            "password"         => "required|min:6",
            "reenter_password" => "required|same:password",
        ]);

        $data = $request->all();

        $data['password'] = bcrypt($data['password']);
        $data['level'] = 0;
        $user = User::create($data);
        event(new Registered($user));

        return redirect("/login")->with('success', 'User telah berhasil Registered');
    }

    public function login()
    {
        return view("Auth/login");
    }
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->type == 0) {
                return redirect('/');
            } else {
                return redirect('Admin/view');
            }
        } else {
            return redirect('/login')->withErrors("Login Gagal");
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }


}
