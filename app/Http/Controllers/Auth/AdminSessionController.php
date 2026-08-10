<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AdminSessionController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/AdminLogin');
    }

    public function store(AdminLoginRequest $request): RedirectResponse
    {
        if (! Auth::guard('admin')->attempt($request->validated(), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'Ces identifiants ne correspondent à aucun administrateur.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
