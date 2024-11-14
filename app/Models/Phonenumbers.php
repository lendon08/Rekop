<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phonenumbers extends Model
{
    use HasFactory, SoftDeletes;

    protected  $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function callhistory()
    {
        return $this->hasMany(Callhistory::class);
    }
    public function tracking()
    {
        return $this->hasOne(Phonetracking::class, 'phonenumber_id');
    }
    public static function getName()
    {
        return Phonenumbers::where('company_id', auth()->user()->company_id)
            ->pluck('name');
    }
}
