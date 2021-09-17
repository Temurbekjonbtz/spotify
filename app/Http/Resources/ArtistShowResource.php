<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\AlbumsResource;
class ArtistShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'albums'=> AlbumsResource::collection($this->albums),
            'isSubscribed'=>$this->isSubscribed()
        ];
    }
}
