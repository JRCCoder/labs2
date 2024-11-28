<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'image',
        'catalog_id',
        'discount_percentage',
    ];

    /**
     * Define a relationship with the Category model.
     * Assuming a product belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define a relationship with the Supplier model.
     * Assuming a product belongs to one supplier.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Calculate the discounted price of the product.
     *
     * @param float $discountPercentage
     * @return float
     */
    public function calculateDiscountedPrice(float $discountPercentage): float
    {
        return $this->price - ($this->price * ($discountPercentage / 100));
    }

    /**
     * Check if the product is in stock.
     *
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }
}
