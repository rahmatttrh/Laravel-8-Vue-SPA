<?php

use Illuminate\Support\Facades\Route;



Auth::routes();



Route::middleware('auth')->group(function(){
	// Route::get('/{any?}', function(){
	// 	return view('layouts.app');
	// })->where('any','.*');
	route::view('/{any}', 'layouts.app')->where('any', '.*');
});
