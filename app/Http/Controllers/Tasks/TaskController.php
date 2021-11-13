<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskPostRequest;
use App\Models\GroupMember;
use App\Models\Task;
use App\Models\TaskTarget;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

        DB::transaction(function() use($request, $groupId) {
            $subject = $request->get('subject');
            $map = $request->get('map');
            $legend = $request->get('legend');
            $contents = $request->get('contents');
            $limitedAt = $request->get('limitedAt');
            $targetUsers = array_unique($request->get('targetUser'));

            $authUser = Auth::user();

            $task = Task::create([
                'group_id' => $groupId,
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

    /**
     * 課題編集画面
     * @param int $id task.id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);

        $task = Task::whereId($id)->whereGroupId($groupId)->first();
        abort_if(is_null($task), Response::HTTP_BAD_REQUEST);
        $viewParams = [
            'task' => $task,
            'maps' => Task::MAP,
            'legends' => Task::LEGEND,
            'targetUsers' => GroupMember::whereGroupId($groupId)->get(),
        ];
        return view('tasks.edit')->with($viewParams);
    }

    /**
     * 課題編集処理
     * @param TaskPostRequest $request
     * @param int $id task.id
     * @return RedirectResponse
     */
    public function update(TaskPostRequest $request, int $id): RedirectResponse
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);
        abort_if(!Task::whereId($id)->whereGroupId($groupId)->exists(), Response::HTTP_BAD_REQUEST);

        DB::transaction(function() use($request, $groupId, $id) {
            $subject = $request->get('subject');
            $map = $request->get('map');
            $legend = $request->get('legend');
            $contents = $request->get('contents');
            $limitedAt = $request->get('limitedAt');
            $targetUsers = array_filter(array_unique($request->get('targetUser')), function($v) {
                return !is_null($v);
            });

            Task::whereId($id)->whereGroupId($groupId)->update([
                'subject' => $subject,
                'map' => $map,
                'legend' => $legend,
                'contents' => $contents,
                'limited_at' => $limitedAt,
            ]);
            $oldTaskTargets = TaskTarget::whereTaskId($id)->get();
            $oldTaskUserIds = $oldTaskTargets->map(function($v) {
                return $v->user_id;
            })->toArray();
            $addTargetUserIds = array_diff($targetUsers, $oldTaskUserIds);
            $removeTargetUserIds = array_diff($oldTaskUserIds, $targetUsers);

            foreach ($addTargetUserIds as $addTargetUserId) {
                TaskTarget::create([
                    'task_id' => $id,
                    'user_id' => $addTargetUserId,
                ]);
            }

            foreach ($removeTargetUserIds as $removeTargetUserId) {
                TaskTarget::whereTaskId($id)->whereUserId($removeTargetUserId)->delete();
            }
        });

        return Redirect::to('/home');
    }

    /**
     * task_targets からログイン中のユーザを削除する
     * @param int $id task.id
     * @return RedirectResponse
     */
    public function removeMe(int $id): RedirectResponse
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);
        abort_if(!Task::whereId($id)->whereGroupId($groupId)->exists(), Response::HTTP_BAD_REQUEST);

        $authUser = Auth::user();
        TaskTarget::whereTaskId($id)->whereUserId($authUser->id)->delete();
        return Redirect::to('/home');
    }

    /**
     * 課題の削除処理
     * @param int $id task.id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $groupId = session('group_id');
        abort_if(is_null($groupId), Response::HTTP_FORBIDDEN);
        abort_if(!Task::whereId($id)->whereGroupId($groupId)->exists(), Response::HTTP_BAD_REQUEST);

        DB::transaction(function() use($groupId, $id) {
            TaskTarget::whereTaskId($id)->delete();
            Task::whereId($id)->whereGroupId($groupId)->delete();
        });
        return Redirect::to('/home');
    }
}
