<?php

namespace App\Http\Controllers\Groups;

use App\Models\GroupMember;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class ChangeController
{
    /**
     * グループ変更画面表示
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $authUser = Auth::user();
        $groupMembers = GroupMember::whereUserId($authUser->id)->get();
        abort_if(count($groupMembers) == 0, Response::HTTP_FORBIDDEN);
        $viewParams = [
            'groupMembers' => $groupMembers,
        ];
        return view('groups.change')->with($viewParams);
    }

    /**
     * グループ変更処理
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $groupId = $request->get('groupId');

        $authUser = Auth::user();
        $groupMember = GroupMember::whereUserId($authUser->id)->whereGroupId($groupId)->first();
        abort_if(is_null($groupMember), Response::HTTP_BAD_REQUEST);
        session(['group_id' => $groupMember->group->id]);
        return Redirect::to('/home');
    }
}
