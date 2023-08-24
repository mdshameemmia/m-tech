<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductQuotation extends Model
{
    use HasFactory;
    protected $table = 'product_quotations';
    protected $guarded = [];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
