<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * トップ画面表示
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $user = Auth::user();
        $groupId = session('group_id');
        $tasks = [];
        if (!is_null($groupId)) {
            $tasks = Task::whereGroupId($groupId)->orderBy('updated_at', 'desc')->get();
            foreach ($tasks as &$task) {
                $task['isLimitOver'] = !is_null($task->limited_at) && Carbon::now()->gt(Carbon::parse($task->limited_at));
                $task['isMeTarget'] = in_array($user->id , $task->taskTargets->map(function($v) {
                    return $v->user_id;
                })->toArray());

                $task['isAnotherTarget'] = false;
                foreach($task->taskTargets as $taskTarget) {
                    if ($taskTarget->user_id !== $user->id) {
                        $task['isAnotherTarget'] = true;
                        break;
                    }
                }
            }
        }

        $viewParams = [
            'isJoinedGroup' => GroupMember::whereUserId($user->id)->exists(),
            'tasks' => $tasks,
        ];
        return view('home')->with($viewParams);
    }
}
