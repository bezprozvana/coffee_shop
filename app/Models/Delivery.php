<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'order_id', 'address_id', 'delivery_method_id'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function method()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id');
    }
}