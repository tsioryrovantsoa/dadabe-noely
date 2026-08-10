<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterChildRequest;
use App\Models\Child;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredChildController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'birthYears' => range(now()->year, now()->year - 18),
        ]);
    }

    public function store(RegisterChildRequest $request): RedirectResponse
    {
        $child = Child::create([
            ...$request->validated(),
            'bonus_points' => Arr::random(Child::BONUS_POINT_LEVELS),
        ]);

        Auth::guard('child')->login($child);

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
