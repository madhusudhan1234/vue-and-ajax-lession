<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('api/tasks', function (){
    return App\Task::latest()->get();
});
