<?php

use App\Http\Controllers\SamlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    dd(request()->all());
    //return view('welcome');
});

//Custom SAML Routes
Route::prefix('saml/sp')->group(function(){
    //Metadata Endpoint
    Route::get('metadata',[SamlController::class,'SPMetaData'])->name('saml.sp.metadata');
    //Acsertion Endpoint
    Route::post('acs',[SamlController::class,'SamlAssertion'])->name('saml.sp.acs');
    //SSO Logout Service Endpoint
    Route::get('sls',[SamlController::class,'SamlLogoutService'])->name('saml.sp.sls');
});
