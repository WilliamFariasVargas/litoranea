<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function logged(){

        $user = session()->get('name');
        $level = User::$levels[session()->get('level')];

        return view('main.welcome', compact('user','level'));
    }
}
