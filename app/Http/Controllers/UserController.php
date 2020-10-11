<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index() 
    {
        return 'all';
    }

    public function show(int $id)
    {
        return 'show ' . $id;
    }

    public function store(Request $request)
    {
        return 'store';
    }

}
