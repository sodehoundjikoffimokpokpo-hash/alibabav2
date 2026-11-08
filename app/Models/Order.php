<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'status'];

    public function items()
    {
        return $table->hasMany(OrderItem::class); // Créez un modèle OrderItem si nécessaire, ou utilisez la table directement
    }

    protected $fillable = ['user_id', 'total_amount', 'status'];

    /**
     * Relation : Une commande contient plusieurs articles
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relation : Une commande appartient à un acheteur (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
