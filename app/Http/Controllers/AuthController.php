<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $targetRoute = $user->isAdmin() ? route('admin.dashboard') : route('user.dashboard');

            return redirect()->intended($targetRoute)
                ->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our registered records.',
            ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
            'phone' => 'nullable|string|max:40',
            'country' => 'nullable|string|max:100',
        ]);

        // STRICT SECURITY RULE: Public registration can NEVER assign administrator role.
        // Always assign safe default role 'donor'
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'country' => $validated['country'] ?? 'Sri Lanka',
            'role' => 'donor', // Safe default role
            'is_active' => true,
        ]);

        // Send real-time notification to Administrator
        try {
            AdminNotification::notify(
                type: 'user_registered',
                title: 'New Member Registered',
                message: "{$user->name} ({$user->email}) created a new account.",
                link: route('admin.users.index'),
                icon: 'fa-solid fa-user-plus',
                badgeClass: 'bg-info text-white',
                data: ['user_id' => $user->id, 'email' => $user->email, 'name' => $user->name, 'country' => $user->country]
            );
        } catch (\Throwable $e) {
            Log::error('AdminNotification error on user register: ' . $e->getMessage());
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard')
            ->with('success', 'Your account has been registered successfully! Welcome to your personal SDC Portal.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'You have been logged out safely.');
    }
}
