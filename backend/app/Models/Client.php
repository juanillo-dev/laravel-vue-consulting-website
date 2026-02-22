<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice; // <- Esto es lo importante

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'address',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
