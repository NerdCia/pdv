<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('components.configurations', compact('users'));
    }
}
