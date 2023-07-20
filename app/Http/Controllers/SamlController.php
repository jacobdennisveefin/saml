<?php

namespace App\Http\Controllers;
use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Illuminate\Http\Request;
use Aacotroneo\Saml2\Saml2Auth;
use Aacotroneo\Saml2\Saml2User;
use DOMDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use XMLParser;

class SamlController extends Controller
{
    public function SPMetaData(){
        $fileUrl = asset('SAML/metadata/metaData.xml');
        // $file = File::get($file);
        // $response = Response::make($file, 200);
        // $response->header('Content-Type', 'application/xml');
        return redirect()->to($fileUrl);
    }
    public function SAMLAssertion()
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

    public function SamlLogoutService(){

    }
}
