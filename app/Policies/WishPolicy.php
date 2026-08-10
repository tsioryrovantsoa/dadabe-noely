<?php

namespace App\Policies;

use App\Models\Child;
use App\Models\Wish;

class WishPolicy
{
    public function create(Child $child): bool
    {
        return ! $child->hasValidatedWishlist();
    }

    public function update(Child $child, Wish $wish): bool
    {
        return $wish->child_id === $child->id && ! $wish->is_validated;
    }

    public function delete(Child $child, Wish $wish): bool
    {
        return $this->update($child, $wish);
    }
}
