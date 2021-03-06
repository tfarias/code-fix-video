<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    public $incrementing = false;
    protected $keyType = "string";

    protected $table = 'genres';

    protected $fillable = ['id','name','is_active'];

    protected $dates = ['deleted_at'];

    protected $casts = ['id' => 'string', 'is_active' => 'boolean'];
}
