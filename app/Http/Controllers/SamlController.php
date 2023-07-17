<?php

namespace App\Http\Controllers;
use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Illuminate\Http\Request;
use Aacotroneo\Saml2\Saml2Auth;
use Aacotroneo\Saml2\Saml2User;
use DOMDocument;
use XMLParser;

class SamlController extends Controller
{
    public function acs()
    {
        $dom = new \DOMDocument();
        $dom->loadXML(base64_decode(request()->get('SAMLResponse')));
        $doc = $dom->documentElement;
        $xpath = new \DOMXpath($dom);
        $xpath->registerNamespace('samlp', 'urn:oasis:names:tc:SAML:2.0:protocol');
        $xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');
        $globalAttrArr = [];
        foreach ($xpath->query('/samlp:Response/saml:Assertion/saml:AttributeStatement/saml:Attribute', $doc) as $attr) {
            $attrArr = [];           
            foreach ($xpath->query('saml:AttributeValue', $attr) as $value) {
                $attrArr[$attr->getAttribute('Name')] = $value->textContent;
            }
            $globalAttrArr[$attr] = $attrArr;
            dd($attrArr);
        }
        dd($globalAttrArr);
        
    }
}
