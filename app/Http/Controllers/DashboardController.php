<?php

namespace App\Http\Controllers;

use App\Domain\Enums\UserType;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type === UserType::Admin->value) {
            return view('home');
        }

        return view('home');
    }


}
