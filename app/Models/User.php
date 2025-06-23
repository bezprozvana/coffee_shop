<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property bool $is_admin
 * @property Collection|Cart[] $cartItems
 * @property Collection|Order[] $orders
 * @property Collection|Address[] $addresses
 * @property Collection|Wishlist[] $wishlist
 */
/**
 * @property-read Collection|Cart[] $cartItems
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    /**
     * @return HasMany<Cart>
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function comparisons()
    {
        return $this->hasMany(Comparison::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'email_verified_at',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email_verified_at' => 'timestamp',
        'is_admin' => 'boolean',
        'deleted_at' => 'timestamp',
    ];
}
