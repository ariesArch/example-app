<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'category_products');
    }
    /**
     * @return BelongsToMany
     */
    public function product_group(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class);
    }
    /**
     * @return BelongsToMany
     */
    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute');
    }
    /**
     * @return HasMany
     */
    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class, 'product_id');
    }
}
