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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    /**
     * グループ作成画面
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('groups.create');
    }

    /**
     * グループ作成処理
     * @param GroupPostRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
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
                if (is_null($user)) {
                    continue;
                }

                GroupMember::create([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                ]);
            }

            session(['group_id' => $group->id]);
        });

        return Redirect::to('/home');
    }

    /**
     * グループ編集画面表示
     * @param int $id groups.id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $authUser = Auth::user();
        $groupMember = GroupMember::whereUserId($authUser->id)->whereGroupId($id)->first();
        abort_if(is_null($groupMember), Response::HTTP_BAD_REQUEST);
        $viewParams = [
            'id' => $id,
            'name' => $groupMember->group->name
        ];
        return view('groups.edit')->with($viewParams);
    }

    /**
     * グループ編集処理
     * @param GroupPostRequest $request
     * @param int $id groups.id
     * @return RedirectResponse
     */
    public function update(GroupPostRequest $request, int $id): RedirectResponse
    {
        $authUser = Auth::user();
        $groupMember = GroupMember::whereUserId($authUser->id)->whereGroupId($id)->first();
        abort_if(is_null($groupMember), Response::HTTP_BAD_REQUEST);

        $name = $request->get('name');

        Group::where('id', $id)->update([
            'name' => $name
        ]);

        return Redirect::to('/home');
    }
}
