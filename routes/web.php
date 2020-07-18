<?php
use App\Events\StatusLiked;
use App\Events\chat;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/ntf', 'chatController@getNtf');
Route::post('/sender','chatController@sendmessage');
Route::get('/chat', 'chatController@get');
Route::get('/send/{id}', 'chatController@sender')->name('send');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('/fff/{id}', function(\App\User $id){
    event(new chat('hello',$id->id));
});

Route::middleware('auth')->get('/flas', function () {
    return view('flas');
});


Route::post('/comments', 'HomeController@comments');
Route::get('/getcomment', 'HomeController@getcomment');

Route::get('/getdata', 'HomeController@getData');