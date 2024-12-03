<?php

namespace App\Casts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class FormatNumberSwap implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $number =  preg_replace("/[^0-9]+/", "", $value);
        $number = substr($number, 1);
        return preg_replace('/(\d{3})(\d{3})(\d{3})/', '($1) $2-$3', $number);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return preg_replace("/[^0-9]+/", "", $value); // Reverse formatting
    }
}
