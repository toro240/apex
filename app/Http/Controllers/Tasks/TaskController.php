<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\GroupMember;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * 課題作成画面
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);

        $viewParams = [
            'maps' => Task::MAP,
            'legends' => Task::LEGEND,
            'targetUsers' => GroupMember::whereGroupId($groupId)->get(),
        ];
        return view('tasks.create')->with($viewParams);
    }

    /**
     * 課題作成処理
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);

        return Redirect::to('/home');
    }
}
