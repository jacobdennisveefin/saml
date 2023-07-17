<?php

namespace App\Http\Controllers;
use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Illuminate\Http\Request;
use Aacotroneo\Saml2\Saml2Auth;
use Aacotroneo\Saml2\Saml2User;

class SamlController extends Controller
{
    public function acs()
    {
     //   dd(Saml2User);
        dd(request()->all());
    }
}
