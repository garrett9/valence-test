<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory;

    public const PERSPECTIVE_TEST = 'Perspective Test';

    public function scopeByName(Builder $qry, string $name)
    {
        return $qry->where('name', $name);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->attributes['display_name'] ?: $this->name;
    }

    public function questions(): HasMany
    {
        return $this->hasMany(TestQuestion::class)->orderBy('order');
    }
}
