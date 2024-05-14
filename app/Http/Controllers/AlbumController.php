<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\album;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(){
        $albums = album::all();
        return view('albums.index', compact('albums'));
    }

    public function create(){
        return view('albums.create');
    }
    
    public function store(Request $request){
        album::create([
            'name' => $request->name
        ]);
        return redirect()->route('albums.index');
    }

    public function edit(album $album){
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, album $album){
        $album->update([
            'name' => $request->name
        ]);
        return redirect()->route('albums.index');
    }

    public function show(album $album){
        $photos = $album->getMedia();
        return view('albums.show', compact('album', 'photos'));
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        album::where('id', $id)->delete();
        DB::table('media')->where('model_id', $id)->delete();
    }

    public function upload(Request $request, album $album){
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $album->addMedia($image)->toMediaCollection();
            }
        }
        return redirect()->back();
    }

    public function album(Request $request){
        $id = $request->input('id');
        $media = DB::table('media')->where('model_id', $id)->get();
        return response()->json(['data' => $media]);
    }

    public function move($id){
        $albums = album::where('id', '!=', $id)->get();
        return view('albums.move', compact(['albums','id']));
    }

    public function transfer(Request $request, $id){
        $media = DB::table('media')->where('model_id', $id)->get();

        $selectedAlbumId = $request->input('transfer_to');
        foreach ($media as $image) {
            DB::table('media')->where('id', $image->id)->update(['model_id' => $selectedAlbumId]);
        }
        album::where('id', $id)->delete();
        return redirect()->route('albums.index');
    }
}
