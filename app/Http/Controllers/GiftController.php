<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchGiftsRequest;
use App\Models\Category;
use App\Models\Gift;
use Inertia\Inertia;
use Inertia\Response;

class GiftController extends Controller
{
    public function index(SearchGiftsRequest $request): Response
    {
        $filters = $request->validated();

        $gifts = Gift::query()
            ->with('category')
            ->when($filters['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($filters['category_id'] ?? null, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->when($filters['min_points'] ?? null, fn ($query, $minPoints) => $query->where('points', '>=', $minPoints))
            ->when($filters['max_points'] ?? null, fn ($query, $maxPoints) => $query->where('points', '<=', $maxPoints))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('Gifts/Index', [
            'gifts' => $gifts,
            'categories' => Category::orderBy('name')->get(['id', 'name']),
            'filters' => $filters,
        ]);
    }

    public function show(Gift $gift): Response
    {
        return Inertia::render('Gifts/Show', [
            'gift' => $gift->load('category'),
        ]);
    }
}
