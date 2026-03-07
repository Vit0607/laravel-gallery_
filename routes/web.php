<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $images = DB::table('images')
    ->select('*')
    ->get();
    $myImages = $images->all();

    return view('welcome', ['imagesInView' => $myImages]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/create', function () {
    return view('create');
});

Route::post('/store', function (Request $request) {
    $image = $request->file('image');
    $filename = $request->image->store('uploads');

    DB::table('images')->insert([
        'image' => $filename
    ]);

    return redirect('/');
});

Route::get('/show/{id}', function ($id) {
    $myImage = DB::table('images')
    ->select('*')
    ->where('id', $id)
    ->first()
    ->image;

    return view('show', ['imageInView'=> $myImage]);
});

Route::get('/edit/{id}', function ($id) {
    $myImage = DB::table('images')
    ->select('*')
    ->where('id', $id)
    ->first();

    return view('edit', ['imageInView' => $myImage]);
});

Route::post('/update/{id}', function (Request $request, $id) {
    $myImage = DB::table('images')
    ->select('*')
    ->where('id', $id)
    ->first();
    Storage::delete($myImage->image);

    $filename = $request->image->store('uploads');

    DB::table('images')
    ->where('id', $id)
    ->update(['image' => $filename]);

    return redirect('/');
});

Route::get('/delete/{id}', function (Request $request, $id) {
    $myImage = DB::table('images')
    ->select('*')
    ->where('id', $id)
    ->first();
    Storage::delete($myImage->image);

    DB::table('images')->where('id', $id)->delete();

    return redirect('/');
});