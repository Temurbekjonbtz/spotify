<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Resources\PlaylistResource;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Song;
use App\Http\Resources\SongsResource;
class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return   PlaylistResource::collection(auth()->user()->playlists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $newPlaylist= auth()->user()->playlists()->create($request->all());
       return new  PlaylistResource($newPlaylist);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist);
    }

    public function songs(Playlist $playlist)
    {
        return SongsResource::collection( $playlist->songs);
    }
    public function storesong(Request $request)
    {
       
        
        $playlist=Playlist::find($request->playlist);
        if($playlist->songs()->find($request->song)){
           return ['response'=>"This  is  already  in  playlist"];
        }
        else{
            $song=Song::find($request->song);
            $playlist->songs()->attach($song->id);
            return  $request;
        }
       
       
    }
    public  function deletesongfromplaylist(Request $request){
        
      
        $playlist=Playlist::find($request->playlist);
        $playlist->songs()->detach($request->song);
  return ['response'=>"This  song  is  deleted  from  playlist"];
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $playlist=Playlist::find($id);
      $playlist->songs()->detach();
      $playlist->delete();
      return $id;
    }
}
