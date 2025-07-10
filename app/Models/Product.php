<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'vendor_id',
    ];


    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
