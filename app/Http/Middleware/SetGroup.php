<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\GroupMember;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;

class SetGroup
{

    private Factory $viewFactory;

    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = Auth::user();
        $groupMember = GroupMember::whereUserId($user->id)->first();
        $groupName = session('group_name');
        if (is_null($groupName) && $groupMember->exists()) {
            $groupName = $groupMember->group->name;
            session(['group_name' => $groupName]);
        }
        $this->viewFactory->share('groupName', $groupName);
        return $next($request);
    }
}
