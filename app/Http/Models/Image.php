<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class Image extends Model
{

    protected $fillable = [
        'user_id', 'path', 'filename', 'extension'
    ];


    public function user(){
        return $this->hasOne(User::class);
    }

    public function getFullPath(){
        if (!method_exists($this, 'base')){
            throw new \Exception('Child class needs to have "base" function.');
        }

        return  "storage/" . $this->base() . $this->path;
    }

    public function getExtension(){
        return explode('/', $this->extension)[1];
    }

}
