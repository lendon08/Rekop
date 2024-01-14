<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    // IMPORTANT TO DO LATER

    // protected $fillable = [
    //     'owner_id',
    //     'name',
    //     'location',
    //     'lead_value',
    // ];

    // public function validationRules()
    // {
    //     return [
    //         'form.name' => ['required', 'string'],
    //         'form.location' => ['required', 'string'],
    //         'form.lead_value' => ['required', 'numeric'],
    //     ];
    // }

    // public function owner()
    // {
    //     return $this->belongsTo(User::class, 'owner_id');
    // }
}
