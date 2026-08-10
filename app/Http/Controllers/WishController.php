<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishRequest;
use App\Http\Requests\UpdateWishRequest;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class WishController extends Controller
{
    public function index(Request $request): Response
    {
        $child = $request->user('child');

        return Inertia::render('Wishes/Index', [
            'wishes' => $child->wishes()->with('gift.category')->orderBy('wished_at')->get(),
            'isValidated' => $child->hasValidatedWishlist(),
            'spentPoints' => $child->getSpentPoints(),
        ]);
    }

    public function store(StoreWishRequest $request): RedirectResponse
    {
        $request->user('child')->wishes()->create([
            'gift_id' => $request->integer('gift_id'),
            'wished_at' => now(),
        ]);

        return back()->with('success', 'Cadeau ajouté à ta liste de souhaits.');
    }

    public function update(UpdateWishRequest $request, Wish $wish): RedirectResponse
    {
        $wish->update(['quantity' => $request->integer('quantity')]);

        return back()->with('success', 'Quantité mise à jour.');
    }

    public function destroy(Wish $wish): RedirectResponse
    {
        Gate::authorize('delete', $wish);

        $wish->delete();

        return back()->with('success', 'Cadeau retiré de ta liste.');
    }
}
