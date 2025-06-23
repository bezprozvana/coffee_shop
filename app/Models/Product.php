<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'full_description',
        'image',
        'stock_quantity',
        'views',
        'brand_id',
        'weight_id',
        'country_id',
        'category_id',
        'acidity_level_id',
        'sweetness_level_id',
        'bitterness_level_id',
        'processing_method_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function weight(): BelongsTo
    {
        return $this->belongsTo(Weight::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function acidityLevel(): BelongsTo
    {
        return $this->belongsTo(AcidityLevel::class);
    }

    public function sweetnessLevel(): BelongsTo
    {
        return $this->belongsTo(SweetnessLevel::class);
    }

    public function bitternessLevel(): BelongsTo
    {
        return $this->belongsTo(BitternessLevel::class);
    }

    public function processingMethod(): BelongsTo
    {
        return $this->belongsTo(ProcessingMethod::class);
    }

    public function flavorProfiles(): BelongsToMany
    {
        return $this->belongsToMany(FlavorProfile::class);
    }

    public function brewingMethods(): BelongsToMany
    {
        return $this->belongsToMany(BrewingMethod::class);
    }


    

    public function scopeAvailable($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function isAvailable($quantity = 1)
    {
        return $this->stock_quantity >= $quantity;
    }




    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function comparisons()
    {
        return $this->hasMany(Comparison::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot(['quantity', 'price_at_order_time'])
                    ->withTimestamps();
    }

    public function scopeFilter($query, array $filters)
        {
            $query->when($filters['category'] ?? false, fn($query, $category) => 
                $query->whereHas('category', fn($query) => 
                    $query->where('slug', $category)
                )
            );
            
            $query->when($filters['brand'] ?? false, fn($query, $brand) => 
                $query->whereHas('brand', fn($query) => 
                    $query->where('slug', $brand)
                )
            );
            
            $query->when($filters['price_min'] ?? false, fn($query, $price) => 
                $query->where('price', '>=', $price)
            );
            
            $query->when($filters['price_max'] ?? false, fn($query, $price) => 
                $query->where('price', '<=', $price)
            );
            
            $query->when($filters['search'] ?? false, fn($query, $search) => 
                $query->where(fn($query) => 
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%')
                )
            );
        }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/'.$this->image) : asset('assets/albums/product-placeholder.jpg');
    }

    public function getInStockAttribute(): bool
    {
        return $this->stock_quantity > 0;
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, '.', ' ').' грн';
    }

    
}