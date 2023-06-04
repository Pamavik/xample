<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'rating',
        'role',
        'subscription_date',
        'teacher_id',
        'group_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['full_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the users for the teacher.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class,'teacher_id','id');
    }

    /**
     * Get the teacher that owns the user.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "teacher", "admin"][$value],
        );
    }

    public function xample(): HasMany
    {
        return $this->hasMany(Xample::class, 'teacher_id');
    }

    public function result(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function group(): HasMany
    {
        return $this->hasMany(Group::class, 'teacher_id');
    }

    /**
     * Get all of the xamples for the group.
     */
    public function xamples(): MorphToMany
    {
        return $this->morphToMany(Xample::class, 'xamplable');
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }
}
