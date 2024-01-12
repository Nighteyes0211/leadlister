<?php

namespace App\Models;

use App\Enum\State\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class State extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    /**
     * Soft delete model
     */
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

}
