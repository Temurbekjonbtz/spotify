<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Http\Resources\ArtistResource;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use  App\Http\Resources\ArtistShowResource;
class ArtistController extends Controller
{
    public function __construct()
    {
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return  ArtistResource::collection(Artist::orderBy('created_at','desc')->get());
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
    public function store(ArtistRequest $request)
    {
        $path = $request->file('image')->store('singerimage','public');
        $artist = new  Artist;
        $artist->name=$request->name;
      $artist->image=$path;
     $artist->save();
      return  response(new ArtistResource($artist), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
      return  new  ArtistShowResource($artist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function updateArtist(Request $request, Artist $artist)
    {
         if($request->name && !$request->file('image')){
             $request->validate([
                 'name'=> 'unique:artists'
             ]);
             $artist->name=$request->name;
             $artist->save();
             return  response(new  ArtistResource($artist),Response::HTTP_ACCEPTED);
         }
         else  if(($request->file('image') && !$request->name) || ($request->file('image') && $request->name==$artist->name)){
             $request->validate([
                 'image'=>'mimes:jpeg,jpg,png'
             ]);
             Storage::disk('public')->delete($artist->image);
             $path=$request->file('image')->store('singerimage','public');
             $artist->image=$path;
             $artist->save();
             return  response(new  ArtistResource($artist),Response::HTTP_ACCEPTED);
         }
         else{
            $request->validate([
                'name'=>'unique:artists',
                'image'=>'mimes:jpeg,jpg,png'
            ]);
            Storage::disk('public')->delete($artist->image);
           $path=$request->file('image')->store('singerimage','public');
           $artist->name=$request->name;
           $artist->image=$path;
           $artist->save();
           return  response(new  ArtistResource($artist),Response::HTTP_ACCEPTED);
         }
       
         
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        Storage::disk('public')->delete($artist->image);
       
        foreach($artist->albums as $album){
            $album->songs()->delete();
            $album->delete();
        }
        $artist->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public  function subscribe(Artist $artist){
        auth()->user()->artists()->save($artist);
        return response(Response::HTTP_ACCEPTED);
    }
    public  function unSubscribe(Artist $artist){
        auth()->user()->artists()->detach($artist);
    }
}
