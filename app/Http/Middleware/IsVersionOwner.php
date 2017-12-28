<?php

namespace Mulidev\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;

class IsVersionOwner
{

    private $user;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {

            if ( ! Auth::guard($guard)->check()) {
                return redirect('/home');
            }

            if ($this->isAdmin()) {
                return $next($request);
            }

            if ($this->isOwner($request)) {
                return $next($request);
            }

            abort(404);

        } catch (ModelNotFoundException $e) {

            abort(404);

        }

    }

    private function isAdmin()
    {

        $this->user = user();

        return $this->user->isAdmin();

    }

    private function isOwner($request)
    {

        $version = $this->obtainVersion($request);

        return ($version->userId() == $this->user->id);

    }


    private function obtainVersion($request)
    {

        $uuid = $this->obtainUuidFromUri($request);

        $repository = app(VersionRepositoryRead::class);

        return $repository->findByUuid($uuid);

    }

    private function obtainUuidFromUri($request)
    {
        return $request->segment(3);
    }
}
