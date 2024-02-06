<?php

namespace App\Models;

use App\Enum\Productable\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Productable extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationships
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
