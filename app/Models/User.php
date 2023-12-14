<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\User\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


     /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->created_by = $model->created_by ?: Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = $model->updated_by ?: Auth::id();
        });
    }

    public function softDelete()
    {
        return $this->update([
            'is_deleted' => true,
            'deleted_at' => now(),
            'deleted_by' => Auth::id()
        ]);
    }

    /**
     * Scopes
     */
    public function scopeactive($query)
    {
        return $query->where('status', StatusEnum::ACTIVE);
    }

    public function scopeavailable($query)
    {
        return $query->where('is_deleted', false);
    }


    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}

