<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'slug', 'price', 'is_active', 'image'];

    /**
     * The tags that belong to the product.
     */
    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
