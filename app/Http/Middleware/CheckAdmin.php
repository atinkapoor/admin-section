<?php

namespace App\Http\Middleware;

use App\Repositories\MiddlewareRepository;
use Closure;


class CheckAdmin
{
    private $tokenValidate;

    public function __construct(MiddlewareRepository $middlewareRepository)
    {
        $this->middlewareRepository = $middlewareRepository;
    }

    public function handle($request, Closure $next)
    {
        if ( $this->middlewareRepository->validateAdmin() ) {
            return $next($request);
        }
        return redirect()->intended(route("login"))->with('status', 'Please sign in to access admin area');
    }
}