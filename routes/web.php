<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/reg', [App\Http\Controllers\UserRegistationController::class, 'Registation'])->name('reg');

Route::post('/reg1/store', [App\Http\Controllers\UserRegistationController::class, 'RegistationOne'])->name('reg1.store');

Route::post('/reg2/store', [App\Http\Controllers\UserRegistationController::class, 'RegistationTwo'])->name('reg2.store');

Route::post('/reg3/store', [App\Http\Controllers\UserRegistationController::class, 'RegistationThree'])->name('reg3.store');

Route::get('/registation/store', [App\Http\Controllers\UserRegistationController::class, 'ConfirmRegistation'])->name('registation.store');



Route::post('/getMunicipality', [App\Http\Controllers\SelectCategoryController::class,'getMunicipality']);
    
Route::post('/getWard', [App\Http\Controllers\SelectCategoryController::class,'getWard']);

Route::post('/getBlock', [App\Http\Controllers\SelectCategoryController::class,'getBlock']);

Route::post('/getSubBlock', [App\Http\Controllers\SelectCategoryController::class,'getSubBlock']);


// new 
Route::post('/fetch-municipality/{id}',[App\Http\Controllers\SelectCategoryController::class,'fetchMunicipality']);

Route::post('/fetch-ward/{id}',[App\Http\Controllers\SelectCategoryController::class,'fetchWard']);

Route::post('/fetch-block/{id}',[App\Http\Controllers\SelectCategoryController::class,'fetchBlock']);

Route::post('/fetch-subblock/{id}',[App\Http\Controllers\SelectCategoryController::class,'fetchSubBlock']);







Route::post('/save',[AccountController::class,'save']);
Route::get('/list',[AccountController::class,'list']);

Route::get('/edit/{id}',[AccountController::class,'edit']);
Route::post('/edit/{id}',[AccountController::class,'update']);



Route::resource('/porperty-tax', App\Http\Controllers\PopertyTexController::class);

Route::resource('/payment_tax', App\Http\Controllers\PaymentController::class);







Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[App\Http\Controllers\User\UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[App\Http\Controllers\User\UserController::class,'profile'])->name('profile');

    Route::get('tax/payment/list',[App\Http\Controllers\User\UserController::class,'TaxPayList'])->name('tax.pay_list');

    Route::get('/payment/history',[App\Http\Controllers\User\UserController::class,'TaxPaymentHistory'])->name('payment.history');

    

    

    Route::post('store_problem',[App\Http\Controllers\User\UserController::class,'Store'])->name('user.problem.store');

    Route::get('delete_problem/{id}',[App\Http\Controllers\User\UserController::class,'delete'])->name('user.problem.delete');

    

});

require __DIR__.'/superadmin.php';

require __DIR__.'/admin.php';

require __DIR__.'/tachnician.php';





//Auth::routes(['register'=>false]);





  
