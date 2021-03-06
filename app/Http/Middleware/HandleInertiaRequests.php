<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @return mixed[]
     */
    public function share(Request $request): array
    {
        /** @var User $user */
        $user = $request->user();
        $userName = $user->getName();

        return array_merge(parent::share($request), [
            'username' => $userName,
        ]);
    }
}
