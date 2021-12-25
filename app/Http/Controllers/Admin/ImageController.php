<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ImageController extends Controller {

    protected $imagesPath = 'img';

    public function index() {

        $images = Image::all();
        return view('admin.images.index', [
            'images' => $images
        ]);

    }

    public function create(Request $request) {

        if($request->isMethod('post')) {

            $file = $request->file('image');
            $mimeType = $file->getMimeType();
            $extension = $this->normalizeExtensions($file->extension());
            $fileName = $request->input('slug').'.'.$extension;
    
            Validator::make(['slug' => $fileName], [
                'slug' => [Rule::unique('images', 'file')],
            ])->validate();
    
            $file->storeAs($this->imagesPath, $fileName, 'public');
    
            Image::create([
                'name' => $request->input('name'),
                'file' => $fileName,
                'type' => $mimeType,
            ]);

            return redirect()->route('admin.images.index')->with('success', "L'image a bien été ajoutée.");

        }

        return view('admin.images.create');

    }

    public function edit(Request $request, $id) {

        $image = Image::find($id);

        if($request->isMethod('post')) {

            $fileName = $request->input('slug').'.'.$image->getExtension();

            Validator::make(['slug' => $fileName], [
                'slug' => [Rule::unique('images', 'file')->ignore($image->file, 'file')],
            ])->validate();

            if ($image->file !== $fileName) {
                Storage::disk('public')->move($this->getImagesPath($image->file), $this->getImagesPath($fileName));
            }

            $image->update([
                'name' => $request->input('name'),
                'file' => $fileName,
            ]);
            return redirect()->route('admin.images.index')->with('success', "L'image a bien été modifiée.");

        }

        return view('admin.images.edit', [
            'image' => $image
        ]);

    }

    public function normalizeExtensions(string $name) {

        return str_replace('jpeg', 'jpg', strtolower($name));

    }

    public function delete(Request $request, $id) {

        $image = Image::find($id);
        $image->delete();
        return redirect()->route('admin.images.index')->with('success', "L'image a bien été supprimée.");

    }

}
