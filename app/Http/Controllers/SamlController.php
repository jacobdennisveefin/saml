<?php

namespace App\Http\Controllers;
use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Illuminate\Http\Request;
use Aacotroneo\Saml2\Saml2Auth;

class SamlController extends Controller
{
    public function login()
    {
        dd(request()->all());
    }
}
