<?php


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
//no token nedded routes
    Route::get('/users', function () {
        return "test";
    });
Route::post('/login','\App\Http\Controllers\AuthController@login' );
Route::post('/register','\App\Http\Controllers\AuthController@register');
Route::get('/viva/{code}','\App\Http\Controllers\vivaController@getViva' );



    // token needed routes
Route::group(['middleware'=>['auth:sanctum']],
function (){
    Route::get('/user', function () {
        return "test";
});
    Route::post('/logout','\App\Http\Controllers\AuthController@logout' );
    Route::post('/newviva','\App\Http\Controllers\vivaController@add' );
    Route::post('/getuser','\App\Http\Controllers\vivaController@user' );
    Route::get('/userviva','\App\Http\Controllers\vivaController@userViva' );

}
);

