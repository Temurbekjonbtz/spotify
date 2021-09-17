<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\SongsResource;
use  App\Http\Resources\ArtistResource;
class AlbumsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id'=>$this->id,
            'title'=>$this->title,
            'artist'=>new  ArtistResource($this->singer),
            'genre'=>$this->genre,
            'artworkPath'=>$this->artworkPath,
            'songcount'=>$this->songs->count(),
             'songs'=> SongsResource::collection($this->songs)
        ];
    }
}
