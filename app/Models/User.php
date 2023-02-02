<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property-read int $id
 * @property string $name
 * @property string $email
 *
 * @property string $phone
 *
 * @property PhoneBook $phoneBook
 * @property Country[]|Collection $countries
 */
class User extends Authentication
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function phone(): Attribute
    {
        return Attribute::make(
            get: fn() => str_replace([' ', '-'], '', $this->phoneBook->phone)
        );
    }

    public function phoneBook(): HasOne
    {
        return $this->hasOne(PhoneBook::class);
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'user_countries');
    }
}
