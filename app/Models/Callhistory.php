<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callhistory extends Model
{
    protected $guarded = [];
    use HasFactory, HasUuids;

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    public function phonenumber()
    {
        return $this->belongsTo(Phonenumbers::class, 'phonenumber_id');
    }

    protected $casts = [
        'call_date' => 'datetime',
    ];
}
