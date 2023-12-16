<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
        $validatedata = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:8|max:50'
        ]);

        User::create($validatedata);

        // $request->session()->flash('success', 'Account Has Been Successfully Created!');

        return redirect('/login')->with('success', 'Account Has Been Successfully Created!');
    }
}
