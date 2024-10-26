<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callhistory extends Model
{
    protected $guarded = [];
    use HasFactory, HasUuids;

    // protected $casts = [
    //     'published_at' => 'datetime',
    // ];
}
