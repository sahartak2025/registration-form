<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ramsey\Collection\Collection;

/**
 * @property-read int $id
 * @property string $name
 * @property string $flag
 * @property string $idd
 *
 * @property-read string $autocompleteLabel
 *
 * @property User[]|Collection $users
 */
class Country extends Model
{
    public function autocompleteLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->flag . ' ' . $this->name
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_countries');
    }
}
