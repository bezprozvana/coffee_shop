<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SweetnessLevel extends Model
{
    public $timestamps = false;
    protected $fillable = ['level'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
