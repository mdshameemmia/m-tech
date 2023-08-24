<?php

namespace App\Models;

use App\Models\ProductQuotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];

    public function productQuotation()
    {
        return $this->hasOne(ProductQuotation::class);
    }

}
