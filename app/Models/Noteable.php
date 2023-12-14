<?php

namespace App\Models;

use App\Enum\Noteable\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Noteable extends Model
{
    use HasFactory;

    protected $guarded = [];
   
}
