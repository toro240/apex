<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskPostRequest;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Task;
use App\Models\TaskTarget;
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
     * @param TaskPostRequest $request
     * @return RedirectResponse
     */
    public function store(TaskPostRequest $request): RedirectResponse
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);

        DB::transaction(function() use($request) {
            $subject = $request->get('subject');
            $map = $request->get('map');
            $legend = $request->get('legend');
            $contents = $request->get('contents');
            $limitedAt = $request->get('limitedAt');
            $targetUsers = array_unique($request->get('targetUser'));

            $authUser = Auth::user();

            $task = Task::create([
                'subject' => $subject,
                'map' => $map,
                'legend' => $legend,
                'contents' => $contents,
                'limited_at' => $limitedAt,
                'created_user_id' => $authUser->id,
            ]);

            foreach ($targetUsers as $targetUser) {
                $user = User::find($targetUser);
                if (is_null($user)) {
                    continue;
                }

                TaskTarget::create([
                    'task_id' => $task->id,
                    'user_id' => $user->id,
                ]);
            }
        });

        return Redirect::to('/home');
    }
}
