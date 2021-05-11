<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Guest extends Model
{
    use SoftDeletes, Authenticatable, Authorizable;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        })->when($filters['detail'] ?? null, function ($query, $detail) {
            $query->whereDetailId($detail);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    public function getCurrencyAttribute()
    {
        return 'Rp ' . number_format($this->money, 0, ',', '.');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
