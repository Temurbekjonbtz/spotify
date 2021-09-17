<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Albums;
use  App\Models\User;
class Artist extends Model
{
    use HasFactory;


    
    public  function albums(){
        return $this->hasMany(Albums::class,'artist','id');
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function isSubscribed(){
        if($this->users()->find(auth()->user()->id)){
            return true;
        }
        else{
            return false;
        }
    }
}
