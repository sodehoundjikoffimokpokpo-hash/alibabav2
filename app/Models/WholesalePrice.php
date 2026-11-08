<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesalePrice extends Model
{
    use HasFactory;

    // Autoriser le stockage en masse pour nos paliers de prix
    protected $fillable = [
        'product_id',
        'min_quantity',
        'max_quantity',
        'price_per_unit'
    ];

    /**
     * Relation inverse : Un palier de prix appartient à un produit
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
