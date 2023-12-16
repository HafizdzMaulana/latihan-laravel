<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($name = "Admin", $email = "admin@gmail.com"){
        return view('about', [
            "name" => $name,
            "email" => $email,
            "title" => "About"
        ]);
    }
}
