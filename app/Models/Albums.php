<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Song;
use App\Models\Artist;
class Albums extends Model
{
    use HasFactory;
   
    protected $fillable = ['title','artworkPath'];

    public  function songs(){
        return $this->hasMany(Song::class);
    }
    public function singer()
    {
        return $this->belongsTo(Artist::class, 'artist', 'id');
    }
}
