<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Product;

class Invoice extends Model
{
    protected $fillable = [
        'client_id',
        'total',
        'status',
    ];

    // Relación con cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con productos (muchos a muchos)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
