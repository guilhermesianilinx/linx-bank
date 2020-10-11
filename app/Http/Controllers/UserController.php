<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() 
    {
        return $this->userRepository->getAllUsers();
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
