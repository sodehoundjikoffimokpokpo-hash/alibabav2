<?php

namespace App\Models;
use App\Models\WholesalePrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Champs autorisés à recevoir des données (Mass Assignment)
    protected $fillable = [
        'shop_id',
        'name',
        'slug',
        'description',
        'moq',
        'stock'
    ];

    /**
     * Relation : Un produit appartient à une boutique (Shop)
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Relation : Un produit possède plusieurs paliers de prix (WholesalePrice)
     */
    public function wholesalePrices()
    {
        return $this->hasMany(WholesalePrice::class);
    }
}
