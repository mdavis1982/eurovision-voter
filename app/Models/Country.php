<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = [];

    /** @var array */
    protected $casts = [
        'currently_voting' => 'bool',
    ];

    /** -- Relationships -- */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /** -- Scopes -- */
    public function scopeCurrentlyVoting(Builder $query)
    {
        return $query->where('currently_voting', '=', true);
    }

    /** -- Methods -- */
    public function isCurrentlyVoting(): bool
    {
        return $this->currently_voting;
    }

    public function isNotCurrentlyVoting(): bool
    {
        return ! $this->isCurrentlyVoting();
    }

    public function openVoting()
    {
        self::where('currently_voting', '=', true)->update(['currently_voting' => false]);

        $this->update(['currently_voting' => true]);
    }

    public function closeVoting()
    {
        $this->update(['currently_voting' => false]);
    }
}
