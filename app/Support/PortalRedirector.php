<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\Request;

class PortalRedirector
{
    public function customerDestination(Request $request): string
    {
        $intended = $request->session()->pull('url.intended');

        if (! is_string($intended) || $intended === '') {
            return route('customer.dashboard');
        }

        $parts = parse_url($intended);
        $path = $parts['path'] ?? '';

        if (
            ! is_string($path)
            || ! str_starts_with($path, '/customer/')
            || (isset($parts['host']) && strcasecmp($parts['host'], $request->getHost()) !== 0)
        ) {
            return route('customer.dashboard');
        }

        return $path . (isset($parts['query']) ? '?' . $parts['query'] : '');
    }

    public function loginRouteFor(User $user): ?string
    {
        if ($user->isAdmin()) {
            return 'filament.admin.auth.login';
        }

        if ($user->isSeller()) {
            return 'seller.login';
        }

        if ($user->isBuyer()) {
            return 'login';
        }

        return null;
    }
}
