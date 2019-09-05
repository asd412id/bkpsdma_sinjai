<?php

Route::group(['middleware'=>'guest'], function()
{
  Route::get('/','MainController@index')->name('main');
  Route::get('/login','MainController@login')->name('main.login');
  Route::post('/login-process','MainController@loginProcess')->name('main.login.process');
  Route::get('/search','MainController@search')->name('search.index');
  Route::get('/detail/{nip}','MainController@detail')->name('search.detail');

});

Route::group(['middleware'=>'auth'], function()
{
  Route::get('/profile','MainController@profile')->name('main.profile');
  Route::post('/profile','MainController@profileUpdate')->name('main.profile.update');
  Route::get('/logout','MainController@logout')->name('main.logout');

  Route::resource('pegawai','PegawaiController',[
    'except'=>['destroy']
  ]);

  Route::get('/download/template', function()
  {
    return response()->download(base_path('assets/files/rptPnsExportData.xls'));
  })->name('download.template');

  Route::group(['prefix'=>'/pegawai-form'], function()
  {
    Route::get('/{uuid}/destroy', 'PegawaiController@destroy')->name('pegawai.destroy');
    Route::get('/delete-foto', 'PegawaiController@deleteFoto')->name('pegawai.foto.delete');
    Route::get('/{uuid}/cetak', 'PegawaiController@printSingle')->name('pegawai.print.single');
    Route::get('/cetak', 'PegawaiController@printAll')->name('pegawai.print.all');
    Route::post('/import', 'PegawaiController@import')->name('pegawai.import');
  });

});
