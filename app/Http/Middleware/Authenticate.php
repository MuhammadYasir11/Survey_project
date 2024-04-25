<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin/*')) {
                return route('admin.login'); // Redirect to admin login for admin section
            } else {
                return route('account.login'); // Redirect to user login for user section
            }
        }
        
        return null;
        // return $request->expectsJson() ? null : route('admin.login');
    }
}
