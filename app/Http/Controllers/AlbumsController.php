<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use Illuminate\Http\Request;
use App\Http\Resources\AlbumsResource;
use  App\Http\Requests\AlbumRequest;
use  App\Models\Artist;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use  App\Notifications\NewAlbumNotification;
class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
        $this->middleware('isAdmin',['only'=>['create','store','edit','update','destroy']]);
        
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AlbumsResource::collection(Albums::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return "this  is create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $artist=Artist::find($request->artist);
        $path=$request->file('artworkPath')->store('albumimage','public');
       $album= $artist->albums()->create([
           'title'=> $request->title,
           'artworkPath'=> $path
       ]);
       foreach($artist->users  as  $user){
        $user->notify(new NewAlbumNotification($album));
       }
    
        return response(new  AlbumsResource($album),Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function show(Albums $album)
    {
       return new AlbumsResource($album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function edit(Albums $albums)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function updateAlbum(Request $request, Albums $album)
    {
     if($request->title){
         if($request->title!=$album->title){
             $request->validate([
                 'title'=>'unique:albums'
             ]);
             $album->title=$request->title;
         }
     }
     if($request->artist!=$album->artist){
        $album->artist=$request->artist;
     }
     if($request->file('artworkPath')){
         
         $request->validate([
             'artworkPath'=>'mimes:jpeg,jpg,png'
         ]);
         Storage::disk('public')->delete($album->artworkPath);
        $path= $request->file('artworkPath')->store('albumimage','public');
        $album->artworkPath=$path;

     }

     $album->save();
    
    return response(new  AlbumsResource($album),Response::HTTP_ACCEPTED);
    
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function destroy(Albums $album)
    {
      Storage::disk('public')->delete($album->artworkPath);
      $album->songs()->delete();
      $album->delete();
      return response(null,Response::HTTP_NO_CONTENT);
    }

  
}
