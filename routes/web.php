<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/uploads/{id}', function(Request $request, $id) {
    $upload = App\Upload::findOrFail($id);

    $client = Storage::getDriver()
        ->getAdapter()
        ->getClient();

    $expiry = "+10 minutes";

    $command = $client->getCommand('GetObject', [
        'Bucket' => config('filesystems.disks.s3.bucket'),
        'Key' => $upload->key
    ]);

    $request = $client->createPresignedRequest($command, $expiry);

    return redirect((string) $request->getUri());
});