<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function Register(): string
    {
        return view('auth/FrontOffice/register');
    }

    
}
