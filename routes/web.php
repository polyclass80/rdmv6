<?php

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

//Route::get('/', function () {
//    return view('home/index');
//});
//
////Route::get('home', function () {
////    return view('home/index');
////});

Route::get('home/index',['uses' => 'HomeController@index' ]);
Route::get('home',['uses' => 'HomeController@index' ]);
Route::get('home/leaveApply',['uses' => 'HomeController@leaveApply' ]);
Route::get('home/getAttendance',['uses' => 'HomeController@getAttendance' ]);



Route::get('schedule/index',['uses' => 'ScheduleController@index' ]);
Route::get('schedule/getSchedule',['uses' => 'ScheduleController@getSchedule' ]);
Route::get('schedule/getRmBlock',['uses' => 'ScheduleController@getRmBlock' ]);
Route::post('schedule/update',['uses' => 'ScheduleController@update' ]);
Route::post('schedule/create',['uses' => 'ScheduleController@create' ]);
Route::post('schedule/scheduleUpdate',['uses' => 'ScheduleController@scheduleUpdate' ]);



Route::get('inventory/index',['uses' => 'InventoryController@index' ]);
Route::get('inventory/getInventory',['uses' => 'InventoryController@getInventory' ]);
Route::get('inventory/getGetRmCode',['uses' => 'InventoryController@getGetRmCode' ]);
Route::post('inventory/updateInventory',['uses' => 'InventoryController@updateInventory' ]);
Route::post('inventory/blockInventory',['uses' => 'InventoryController@blockInventory' ]);

Route::post('inventory/createPr',['uses' => 'InventoryController@createPr' ]);


Route::get('rmblock/index',['uses' => 'RmblockController@index' ]);

Route::get('nomenclature/getName',['uses' => 'NomenclatureController@getName' ]);
Route::get('nomenclature/getSerial',['uses' => 'NomenclatureController@getSerial' ]);
Route::post('nomenclature/create',['uses' => 'NomenclatureController@create' ]);

Route::get('rmpr/index',['uses' => 'RmprController@index' ]);
Route::get('pr/checkPrList',['uses' => 'RmprController@checkPrList' ]);
Route::post('pr/createPr',['uses' => 'RmprController@createPr' ]);

Route::get('admin/index',['uses' => 'AdminController@index' ]);

Auth::routes();

