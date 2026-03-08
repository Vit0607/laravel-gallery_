<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImagesController extends Controller
{
    private $images;

    public function __construct(ImageService $imageService) {
        $this->images = $imageService;
    }
    
    function index() {
        $myImages = $this->images->all();

        return view('welcome', ['imagesInView' => $myImages]);
    }

    function create() {
        return view('create');
    }

    function store(Request $request) {
        $image = $request->file('image');
        
        $this->images->add($image);

        return redirect('/');
    }

    function show($id) {
        $myImage = $this->images->one($id);

        return view('show', ['imageInView'=> $myImage->image]);
    }

    function edit($id) {
        $myImage = $this->images->one($id);

        return view('edit', ['imageInView' => $myImage]);
    }

    function update(Request $request, $id) {
        $this->images->update($id, $request->image);

        return redirect('/');
    }

    function delete($id) {
        $this->images->delete($id);

        return redirect('/');
    }
}