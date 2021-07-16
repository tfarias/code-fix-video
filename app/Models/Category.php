<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    public $incrementing = false;
    protected $keyType = "string";

    protected $table = 'categories';

    protected $fillable = ['id','name','description','is_active'];

    protected $dates = ['deleted_at'];
}
