<?php

namespace App\Application\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

interface AuthServiceInterface
{
    /**
     * Handle user login.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse;

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse;
}
