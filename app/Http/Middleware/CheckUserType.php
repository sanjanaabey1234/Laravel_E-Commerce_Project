<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // check logged user type and redirect to the specific page
        if ($request->user()->role === 'Admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($request->user()->role === 'Driver') {
            return redirect()->route('driver.dashboard');
        }
        if ($request->user()->role === 'Seller') {
            return redirect()->route('seller.dashboard');
        }
        if ($request->user()->role === 'Customer') {
            return redirect()->route('buyer.dashboard');
        }

    }
}
