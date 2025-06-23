<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    public $timestamps = false;
    protected $fillable = ['value'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
