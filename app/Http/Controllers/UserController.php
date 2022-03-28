<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function showAddUserPage()
    {
        return Inertia::render('Master/AddUser');
    }
}
