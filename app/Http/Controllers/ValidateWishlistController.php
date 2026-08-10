<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ValidateWishlistController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        Gate::authorize('create', Wish::class);

        $child = $request->user('child');

        if ($child->wishes()->doesntExist()) {
            return back()->with('error', 'Ta liste est vide, ajoute au moins un cadeau.');
        }

        $child->wishes()->update(['is_validated' => true]);

        return back()->with('success', 'Ta liste est validée, elle part chez le Père Noël.');
    }
}
