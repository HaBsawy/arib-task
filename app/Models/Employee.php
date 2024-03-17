<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'salary', 'email', 'phone', 'password', 'department_id',
        'manager_id', 'image'
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

    public function getFullNameAttribute(): string
    {
        return $this['first_name'] . ' ' . $this['last_name'];
    }

    public function manager(): HasOne
    {
        return $this->hasOne(self::class, 'id','manager_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(self::class, 'id', 'manager_id');
    }

    public function isAdmin(): bool
    {
        return $this['type'] == 'admin';
    }

    public function isManager(): bool
    {
        return $this['type'] == 'manager';
    }

    public function isEmployee(): bool
    {
        return $this['type'] == 'employee';
    }
}
