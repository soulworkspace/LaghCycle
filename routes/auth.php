<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Support\PortalRedirector;

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->middleware(['guest'])->name('login');

Route::post('/login', function (Request $request, PortalRedirector $redirector) {
    $credentials = $request->validate([
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required'],
    ]);

    $guard = Auth::guard('web');

    if (! $guard->attempt([
        'email' => $credentials['email'],
        'password' => $credentials['password'],
    ], $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ]);
    }

    /** @var User $user */
    $user = $guard->user();

    if (! $user->is_active) {
        $guard->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'email' => 'الحساب غير نشط أو ما زال قيد المراجعة.',
        ]);
    }

    $request->session()->regenerate();

    if (! $user->isBuyer()) {
        $destination = $redirector->loginRouteFor($user);
        $guard->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($destination !== null) {
            return redirect()->route($destination)->with('status', 'استخدم بوابة الدخول الخاصة بحسابك.');
        }

        return back()->withErrors([
            'email' => 'هذا الحساب لا يملك صلاحية دخول بوابة العملاء.',
        ]);
    }

    return redirect()->to($redirector->customerDestination($request));
})->middleware(['guest', 'throttle:6,1']);

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware(['auth'])->name('logout');

// Register Routes
Route::get('/register', function () {
    return view('auth.register');
})->middleware(['guest'])->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'phone' => ['required', 'string', 'max:20', 'unique:users,phone'],
    ]);

    $user = DB::transaction(function () use ($validated) {
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => true,
        ]);

        $buyerRole = Role::firstOrCreate([
            'name' => 'buyer',
            'guard_name' => 'web',
        ]);

        $user->syncRoles($buyerRole);

        return $user;
    });

    Auth::guard('web')->login($user);
    $request->session()->regenerate();

    return redirect()->to(app(PortalRedirector::class)->customerDestination($request));
})->middleware(['guest', 'throttle:6,1']);
