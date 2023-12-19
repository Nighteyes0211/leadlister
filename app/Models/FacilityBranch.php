<?php

namespace App\Models;

use App\Enum\FacilityBranch\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FacilityBranch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

}
