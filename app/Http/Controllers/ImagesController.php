<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImagesController extends Controller
{
    function index() {
        $images = DB::table('images')
        ->select('*')
        ->get();
        $myImages = $images->all();

        return view('welcome', ['imagesInView' => $myImages]);
    }

    function about() {
        return view('about');
    }

    function create() {
        return view('create');
    }

    function store(Request $request) {
        $image = $request->file('image');
        $filename = $request->image->store('uploads');

        DB::table('images')->insert([
            'image' => $filename
        ]);

        return redirect('/');
    }

    function show($id) {
        $myImage = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first()
        ->image;

        return view('show', ['imageInView'=> $myImage]);
    }

    function edit($id) {
        $myImage = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first();

        return view('edit', ['imageInView' => $myImage]);
    }

    function update(Request $request, $id) {
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
    }

    function delete(Request $request, $id) {
        $myImage = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first();
        Storage::delete($myImage->image);

        DB::table('images')->where('id', $id)->delete();

        return redirect('/');
    }
}