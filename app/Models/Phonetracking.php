<?php

namespace App\Models;

use App\Enums\TrackingOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phonetracking extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function phonenumber()
    {
        return $this->belongsTo(Phonenumbers::class, 'phonenumber_id');
    }
    protected $casts = [
        'tracking_options' => TrackingOptions::class,
        'swaptarget' => \App\Casts\FormatNumber::class
    ];
}
