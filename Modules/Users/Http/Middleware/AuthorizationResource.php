<?php

namespace Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Users\Facade\PermissionReader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class AuthorizationResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentAction = Route::currentRouteAction();

        list($controller, $action) = \explode('@', $currentAction);
        $permission = PermissionReader::getPermission($controller, $action);

        if (\count($permission)) {
            $permission = $permission[0];

            if (!Gate::allows("{$permission['name']}/{$permission['resource_name']}")) {
                throw new \Illuminate\Auth\Access\AuthorizationException('Usuário não autorizado');
            }
        }
        return $next($request);
    }
}
