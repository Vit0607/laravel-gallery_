<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

Class ImageService {

    public function all() {
        $images = DB::table('images')
        ->select('*')
        ->get();
        $myImages = $images->all();

        return $myImages;
    }

    public function add($image) {
        DB::table('images')->insert([
            'image' => $image->store('uploads')
        ]);
    }

    public function one($id) {
        $myImage = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first();

        return $myImage;
    }

    public function update($id, $image) {
        $myImage = DB::table('images')
        ->select('*')
        ->where('id', $id)
        ->first();
        Storage::delete($myImage->image);

        $filename = $image->store('uploads');

        DB::table('images')
        ->where('id', $id)
        ->update(['image' => $filename]);
    }

    public function delete($id) {
        $myImage = $this->one($id);
        Storage::delete($myImage->image);

        DB::table('images')->where('id', $id)->delete();
    }
}