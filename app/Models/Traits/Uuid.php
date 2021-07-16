<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    public static function boot(){
        parent::boot();
        static::creating(function ($post) {

            if(!$post->id){
                $uuid = Str::uuid()->toString();
                $post->id = $uuid;
            }

        });
    }
}
