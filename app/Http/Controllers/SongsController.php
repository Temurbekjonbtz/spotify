<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use App\Http\Resources\SongsResource;
use  App\Models\Song;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AlbumsResource;
use App\Http\Requests\SongRequest;
use Illuminate\Support\Facades\Storage;
use  App\Notifications\NewSongNotification;
class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Albums $album)
    {
    return SongsResource::collection($album->songs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongRequest $request)
    {
        $album=Albums::find($request->album);
        $path=$request->file('audio')->store('music','public');
        $song=$album->songs()->create([
            'title'=>$request->title,
            'path' =>$path
        ]);
        $artist=$album->singer;
        foreach($artist->users as  $user){
            $user->notify(new NewSongNotification($song));
        }
        return  response( new  SongsResource($song),Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
     return  $song;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSong (Request $request, Song  $song)
    {
       if($request->title){
           if($request->title!=$song->title){
               $request->validate([
                   'title'=>'unique:songs'
               ]);
               $song->title=$request->title;
           }
       }
       if($request->albums_id!=$song->albums_id){
           $song->albums_id=$request->albums_id;
       }
       if($request->file('path')){
              $request->validate([
                  'path'=>'mimes:mp3'
              ]);
              Storage::disk('public')->delete($song->path);
              $path=$request->file('path')->store('music','public');
              $song->path=$path;
       }
       $song->save();
       return  response(new  SongsResource($song),Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song  $song)
    {
        Storage::disk('public')->delete($song->path);
        $song->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
    public function getAllSongs(){
        return SongsResource::collection(Song::orderBy('created_at','desc')->get());
    }
}
