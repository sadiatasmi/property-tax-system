<?php

Route::group(['prefix'=>'superadmin', 'middleware'=>['isSuperadmin','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[App\Http\Controllers\Superadmin\SuperAdminController::class,'index'])->name('superadmin.dashboard');
    

    // manage branch route here 
    Route::resource('/branch', App\Http\Controllers\Superadmin\BranchController::class);
    Route::post('/branch_status', [App\Http\Controllers\Superadmin\BranchController::class, 'BranchStatus'])->name('branch.status');

    // manage banner route here 
    Route::resource('/banner', App\Http\Controllers\Superadmin\BannerController::class);
    Route::post('/banner_status', [App\Http\Controllers\Superadmin\BannerController::class, 'BannerStatus'])->name('banner.status');

    // manage aboutus route here 
    Route::resource('/about_us', App\Http\Controllers\Superadmin\AboutContrioler::class);
    Route::post('/about_us_status', [App\Http\Controllers\Superadmin\AboutContrioler::class, 'AboutUsStatus'])->name('about_us.status');

     // manage service route here 
     Route::resource('/service', App\Http\Controllers\Superadmin\ServiceController::class);
     Route::post('/service_status', [App\Http\Controllers\Superadmin\ServiceController::class, 'ServiceStatus'])->name('service.status');

     // manage question route here 
     Route::resource('/question', App\Http\Controllers\Superadmin\QuestionController::class);
     Route::post('/question_status', [App\Http\Controllers\Superadmin\QuestionController::class, 'QuestionStatus'])->name('question.status');


     // manage question route here 
     Route::resource('/setting', App\Http\Controllers\Superadmin\SetingController::class);

     // manage question route here 
     Route::resource('/user_account', App\Http\Controllers\Superadmin\UserAcountController::class);
     Route::post('/user_account_status', [App\Http\Controllers\Superadmin\UserAcountController::class, 'TechnicianAcountStatus'])->name('user_account.status');

     Route::resource('/problem', App\Http\Controllers\Superadmin\ProblemController::class);

     //new route here 

    // manage district route here 
    Route::resource('/district', App\Http\Controllers\Superadmin\DistrictsController::class);

    // manage municipality route here 
    Route::resource('/municipality', App\Http\Controllers\Superadmin\MunicipalityController::class);

    // manage ward route here 
    Route::resource('/ward', App\Http\Controllers\Superadmin\WardController::class);

    // manage block route here 
    Route::resource('/block', App\Http\Controllers\Superadmin\BlockController::class);

    // manage subblock route here 
    Route::resource('/subblock', App\Http\Controllers\Superadmin\SubBlockController::class);

    // manage subblock route here 
    Route::resource('/nid', App\Http\Controllers\Superadmin\NidController::class);


    Route::resource('/user_property',App\Http\Controllers\UserPropartyController::class);

    Route::get('payment_list',[App\Http\Controllers\Superadmin\PaymantControllerList::class,'index'])->name('payment_list');

    Route::get('payment_list/delete/{id}',[App\Http\Controllers\Superadmin\PaymantControllerList::class,'DeletePayment'])->name('payment_list.delete');

});