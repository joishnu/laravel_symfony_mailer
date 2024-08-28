<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-mail', function(){
    Mail::to('joishnu1508@gmail.com')->send(new TestMail());
    return 'Email sent successfully!';
});
