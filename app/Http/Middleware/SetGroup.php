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
        $groupName = null;
        $groupId = session('group_id');
        if (is_null($groupId)) {
            $groupMember = GroupMember::whereUserId($user->id)->first();
            if (!is_null($groupMember)) {
                session(['group_id' => $groupMember->group->id]);
                $groupName = $groupMember->group->name;
            }
        } else {
            $groupMember = GroupMember::whereUserId($user->id)->whereGroupId($groupId)->first();
            if (!is_null($groupMember)) {
                $groupName = $groupMember->group->name;
            }
        }

        $this->viewFactory->share('groupName', $groupName);
        return $next($request);
    }
}
