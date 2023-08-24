<?php

namespace App\Models;

use App\Models\ProgressClaim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressDescription extends Model
{
    use HasFactory;
    protected $table = 'progress_descriptions';
    protected $guarded = [];


    public function progressClaim()
    {
        return $this->belongsTo(ProgressClaim::class);
    }

}
