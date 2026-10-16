<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mype extends Model
{
    protected $table = 'mypes';

    protected $fillable = [
        'name',
        'slug',
        'ruc',
        'phone',
        'address',
        'logo',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
