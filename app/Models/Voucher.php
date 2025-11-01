<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /** @use HasFactory<\Database\Factories\VoucherFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['code', 'discount_percent', 'product_id'];

    /**
     * Get the product that owns the voucher.
     */
    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the payments for the voucher.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
