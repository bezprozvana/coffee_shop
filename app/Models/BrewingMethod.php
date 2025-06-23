<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrewingMethod extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
