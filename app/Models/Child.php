<?php

namespace App\Models;

use Database\Factories\ChildFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Child extends Authenticatable
{
    /** @use HasFactory<ChildFactory> */
    use HasFactory, Notifiable;

    /** @var list<int> */
    public const BONUS_POINT_LEVELS = [100, 200, 350, 500];

    /** @var list<string> */
    protected $fillable = ['email', 'password', 'birth_year', 'contact', 'bonus_points'];

    /** @var list<string> */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return HasMany<Wish, $this>
     */
    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class);
    }

    public function hasValidatedWishlist(): bool
    {
        return $this->wishes()->where('is_validated', true)->exists();
    }

    public function getSpentPoints(): int
    {
        return $this->wishes()
            ->with('gift')
            ->get()
            ->sum(fn (Wish $wish) => $wish->quantity * $wish->gift->points);
    }

    public function getAvailablePoints(): int
    {
        return $this->bonus_points - $this->getSpentPoints();
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'birth_year' => 'integer',
            'bonus_points' => 'integer',
        ];
    }
}
