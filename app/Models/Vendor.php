<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'address',
        'user_id',
    ];

/**
 * Get the user that owns the vendor.
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get all of the products for the Vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }

}
