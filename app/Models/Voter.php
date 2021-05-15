<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voter extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = [];

    /** @var array */
    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /** -- Relationships -- */
    // ...

    /** -- Scopes -- */
    public function scopeConfirmed(Builder $query)
    {
        return $query->whereNotNull('confirmed_at');
    }

    /** -- Methods -- */
    public function isConfirmed(): bool
    {
        return null !== $this->confirmed_at;
    }

    public function isNotConfirmed(): bool
    {
        return ! $this->isConfirmed();
    }
}
