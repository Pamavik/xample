<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Group extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'title'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the xamples for the group.
     */
    public function xamples(): MorphToMany
    {
        return $this->morphToMany(Xample::class, 'xamplable');
    }
}
