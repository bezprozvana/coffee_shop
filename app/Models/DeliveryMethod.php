<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
