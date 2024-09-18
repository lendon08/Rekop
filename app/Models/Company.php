<?php

namespace App\Models;

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function phonenumber()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    // IMPORTANT TO DO LATER
    protected $fillable = [
        'user_id',
        'name',
        'location',
        'lead_value',
    ];

    public function validationRules()
    {
        return [
            'form.name' => ['required', 'string'],
            'form.location' => ['required', 'string'],
            'form.lead_value' => ['required', 'numeric'],
        ];
    }

    // public function owner()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
