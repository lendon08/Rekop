<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callhistory extends Model
{
    protected $guarded = [];
    use HasFactory, HasUuids;

    public function phonenumber()
    {
        return $this->belongsTo(Phonenumbers::class, 'phonenumber_id');
    }

    protected $casts = [
        'call_date' => 'datetime',
    ];
}
