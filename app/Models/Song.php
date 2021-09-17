<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Albums;
use  App\Models\Artist;
use App\Models\Playlist;
class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title','path'];

    public function singer()
    {
        return $this->belongsTo(Artist::class, 'artist', 'id');
    }
    public function playlist()
    {
    return $this->belongsToMany(Playlist::class);
    }
}
