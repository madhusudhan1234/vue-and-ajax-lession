<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vue-table',['as'=>'vue-table.index','uses'=>'VueTableController@index']);

Route::get('api/tasks','TaskController@api');

Route::resource('tasks','TaskController');

Route::get('api/users', function (){
    return App\User::latest()->paginate(5);
});

Route::get('bootstarp',[
    'as'=>'vue-table.index',
    'uses'=>'VueTableController@bootstrap'
]);

