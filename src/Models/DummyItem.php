<?php

namespace Bithoven\Dummy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DummyItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'description',
        'status',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
