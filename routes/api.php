<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//login
Route::post('login','Api\PassportAuthController@login');




//auth
Route::group(['middleware' => ['json.response','auth:api','role']], function () { 

Route::get('/daftar-unit/getData','unitController@getAll');
Route::post('/daftar-unit/addData','unitController@addData');
Route::post('/daftar-unit/update/{id}','unitController@updateData');
Route::delete('/daftar-unit/delete/{id}','unitController@delData');

Route::get('/daftar-gol/getData','daftarGolonganController@getAll');
Route::post('/daftar-gol/addData','daftarGolonganController@addData');
Route::post('/daftar-gol/update/{id}','daftarGolonganController@updateData');
Route::delete('/daftar-gol/delete/{id}','daftarGolonganController@delData');

Route::get('/daftar-js/getData','daftarJabatanStrukturalController@getAll');
Route::post('/daftar-js/addData','daftarJabatanStrukturalController@addData');
Route::post('/daftar-js/update/{id}','daftarJabatanStrukturalController@updateData');
Route::delete('/daftar-js/delete/{id}','daftarJabatanStrukturalController@delData');

Route::get('/daftar-ikatan-kerja/getData','daftarIkatanKerjaController@getAll');
Route::post('/daftar-ikatan-kerja/addData','daftarIkatanKerjaController@addData');
Route::post('/daftar-ikatan-kerja/update/{id}','daftarIkatanKerjaController@updateData');
Route::delete('/daftar-ikatan-kerja/delete/{id}','daftarIkatanKerjaController@delData');

	
Route::group(['middleware' => ['scope:admin,admin-hrd,kepala-unit,user']],function(){ 
Route::get('/user/getData','userController@getAll');
Route::get('/ikatan-kerja/getData', 'ikatanKerjaController@getAll');
Route::get('/pendidikan-staff/getData','pendidikanStaffController@getAll');
Route::get('/jabatan-struktural/getData', 'jabatanStrukturController@getAll');
Route::get('/gol-ruang/getData', 'golRuangController@getAll');
Route::get('/nama-jafa/getData', 'namaJafaController@getAll');
Route::get('/cuti-staff/getData', 'cutiStaffController@getAll');
Route::get('/history-gaji/getData', 'historyGajiController@getAll');
Route::get('/item-gaji/getData', 'itemGajiController@getAll');
Route::get('/data-staff/getData', 'dataStaffController@getAll');
Route::get('/jafa-dosen/getData', 'jafaDosenController@getAll');
Route::get('/unit-kerja/getData','unitKerjaController@getAll');
});

Route::group(['middleware' => ['scope:admin,admin-hrd,kepala-unit']],function(){
});

Route::group(['middleware' => ['scope:admin,admin-hrd']],function(){
Route::get('/kepala-unit/getData','kepalaUnitController@getAll');
Route::post('/kepala-unit/addData','kepalaUnitController@addData');
Route::post('/kepala-unit/update/{id}','kepalaUnitController@updateData');
Route::delete('/kepala-unit/delete/{id}','kepalaUnitController@delData');

Route::post('/data-staff/addData', 'dataStaffController@addData');
Route::post('/data-staff/update/{id}', 'dataStaffController@updateData');
Route::delete('/data-staff/delete/{id}', 'dataStaffController@delData');

Route::post('/ikatan-kerja/addData', 'ikatanKerjaController@addData');
Route::post('/ikatan-kerja/update/{id}', 'ikatanKerjaController@updateData');
Route::delete('/ikatan-kerja/delete/{id}', 'ikatanKerjaController@delData');

Route::post('/unit-kerja/addData','unitKerjaController@addData');
Route::post('/unit-kerja/update/{id}','unitKerjaController@updateData');
Route::delete('/unit-kerja/delete/{id}','unitKerjaController@delData');

Route::post('/pendidikan-staff/addData','pendidikanStaffController@addData');
Route::post('/pendidikan-staff/update/{id}','pendidikanStaffController@updateData');
Route::delete('/pendidikan-staff/delete/{id}','pendidikanStaffController@delData');

Route::post('/jabatan-struktural/addData', 'jabatanStrukturController@addData');
Route::post('/jabatan-struktural/update/{id}', 'jabatanStrukturController@updateData');
Route::delete('/jabatan-struktural/delete/{id}', 'jabatanStrukturController@delData');

Route::post('/jafa-dosen/addData', 'jafaDosenController@addData');
Route::post('/jafa-dosen/update/{id}', 'jafaDosenController@updateData');
Route::delete('/jafa-dosen/delete/{id}', 'jafaDosenController@delData');	

Route::post('/cuti-staff/addData', 'cutiStaffController@addData');
Route::post('/cuti-staff/update/{id}', 'cutiStaffController@updateData');
Route::delete('/cuti-staff/delete/{id}', 'cutiStaffController@delData');

Route::post('/history-gaji/addData', 'historyGajiController@addData');
Route::post('/history-gaji/update/{id}', 'historyGajiController@updateData');
Route::delete('/history-gaji/delete/{id}', 'historyGajiController@delData');

Route::post('/item-gaji/addData', 'itemGajiController@addData');
Route::post('/item-gaji/update/{id}', 'itemGajiController@updateData');
Route::delete('/item-gaji/delete/{id}', 'itemGajiController@delData');

Route::post('/nama-jafa/addData', 'namaJafaController@addData');
Route::post('/nama-jafa/update/{id}', 'namaJafaController@updateData');
Route::delete('/nama-jafa/delete/{id}', 'namaJafaController@delData');


Route::post('/user/addData','userController@addData');
Route::post('/user/update/{id}','userController@updateData');
Route::delete('/user/delete/{id}','userController@delData');
Route::get('/user/filter','userController@filter');	
});

//check scope admin (hanya admin yang bisa url ini). Login lewat /Admin
Route::group(['middleware' => ['scope:admin']],function(){

Route::get('/jabatan-unit-kerja/getData', 'jabatanUnitKerjaController@getAll');
Route::post('/jabatan-unit-kerja/addData', 'jabatanUnitKerjaController@addData');
Route::post('/jabatan-unit-kerja/update/{id}', 'jabatanUnitKerjaController@updateData');
Route::delete('/jabatan-unit-kerja/delete/{id}', 'jabatanUnitKerjaController@delData');

Route::post('/gol-ruang/addData', 'golRuangController@addData');
Route::post('/gol-ruang/update/{id}', 'golRuangController@updateData');
Route::delete('/gol-ruang/delete/{id}', 'golRuangController@delData');

Route::get('/dashboard/tenaga-pendidik','dashboardController@tenaga_pendidik');
Route::get('/dashboard/tenaga-kependidikan','dashboardController@tenaga_kependidikan');

});

Route::group(['middleware' => ['scope:user']],function(){

});

Route::fallback(function () {
    return "404 NOT FOUND";
});

});


