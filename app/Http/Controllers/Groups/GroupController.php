<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Http\Requests\Groups\GroupPostRequest;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function create(): Factory|View|Application
    {
        return view('groups.groupCreate');
    }

    public function store(GroupPostRequest $request): Application|Factory|View|RedirectResponse
    {
        $name = $request->get('name');
        $userNames = $request->get('userName');

        DB::transaction(function() use($name, $userNames) {
            $group = Group::create([
                'name' => $name
            ]);

            $authUser = Auth::user();
            GroupMember::create([
                'group_id' => $group->id,
                'user_id' => $authUser->id,
            ]);

            foreach ($userNames as $userName) {
                $user = User::whereName($userName)->first();
                if (!$user->exists()) {
                    continue;
                }

                GroupMember::create([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                ]);
            }
        });

        return view('groups.groupCreate');
    }
}
