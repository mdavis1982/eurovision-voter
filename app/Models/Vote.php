<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = [];

    /** -- Relationships -- */
    public function voter(): BelongsTo
    {
        return $this->belongsTo(Voter::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /** -- Scopes -- */
    // ...

    /** -- Methods -- */
    // ...
}
