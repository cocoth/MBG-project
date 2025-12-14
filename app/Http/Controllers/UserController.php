<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $user = User::all();
        return view('admin.dashboard', compact('user'));
    }
}
