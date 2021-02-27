<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthenticatedController extends Controller
{
    /** @var User */
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();
            return $next($request);
        });
    }
}
