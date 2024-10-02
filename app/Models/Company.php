<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    public function users()
    {
        return $this->hasMany(User::class);

        //uses for many to many
        // return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function phoneNumbers()
    {
        return $this->hasMany(Phonenumbers::class, 'company_id');
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
