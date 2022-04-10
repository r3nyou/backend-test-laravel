<?php

namespace App\Http\Controllers;

use App\Events\User\Auth\Register;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        // register process...

        Register::dispatch($this->mockUser());
    }

    private function mockUser()
    {
       return User::factory()->make();
    }
}
