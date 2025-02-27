<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'file_id',
        'name',
        'path',
        'url',
        'type',
        'size',
        'hosted_at',
    ];
}
