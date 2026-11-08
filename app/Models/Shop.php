<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


  class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'company_register_number',
        'country',
        'logo',
        'is_verified'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

