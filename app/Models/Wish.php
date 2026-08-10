<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wish extends Model
{
    /** @var list<string> */
    protected $fillable = ['child_id', 'gift_id', 'quantity', 'wished_at', 'is_validated'];

    /** @var array<string, mixed> */
    protected $attributes = [
        'quantity' => 1,
        'is_validated' => false,
    ];

    /**
     * @return BelongsTo<Child, $this>
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * @return BelongsTo<Gift, $this>
     */
    public function gift(): BelongsTo
    {
        return $this->belongsTo(Gift::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'wished_at' => 'datetime',
            'is_validated' => 'boolean',
        ];
    }
}
