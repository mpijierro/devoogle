<?php

namespace Mulidev\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Mulidev\Src\Resource\Repository\ResourceRepositoryRead;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;

class IsNotReviewed
{

    private $uuid = '';

    private $resource = null;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            if ($this->isAdmin()) {
                return $next($request);
            }

            $this->obtainUuidFromUri($request);

            $this->obtainResource($request);

            if ( ! $this->isResource()) {
                $this->obtainVersion($request);
            }

            if ($this->isReviewed()) {

                abort(404);
            }

            return $next($request);

        } catch (ModelNotFoundException $e) {

            abort(404);

        }

    }

    private function isAdmin()
    {

        $user = user();

        return $user->isAdmin();

    }


    private function obtainUuidFromUri($request)
    {
        $this->uuid = $request->segment(3);
    }

    private function obtainResource($request)
    {

        try {
            $repository = app(ResourceRepositoryRead::class);

            $this->resource = $repository->findByUuid($this->uuid);
        } catch (ModelNotFoundException $exception) {
            return false;
        }


    }

    private function isResource()
    {
        return ! is_null($this->resource);
    }

    private function obtainVersion($request)
    {

        try {

            $repository = app(VersionRepositoryRead::class);

            $this->resource = $repository->findByUuid($this->uuid);
        } catch (ModelNotFoundException $exception) {
            return false;
        }


    }

    private function isReviewed()
    {
        return $this->resource->isReviewed();
    }


}
