<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Admin\Product;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'profile',
        'password',
        'is_admin',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'customer_product', 'customer_id', 'product_id')->withTimestamps();
    }
}
