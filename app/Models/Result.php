<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'xample_id',
        'user_id',
        'teacher_id',
        'questions_count',
        'errors_count',
        'errors_list',
    ];

    protected $casts = [
        'errors_list' => 'array',
    ];

    public function xample(): BelongsTo
    {
        return $this->belongsTo(Xample::class, 'xample_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

}
