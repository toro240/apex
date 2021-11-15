<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Models\Task;
use App\Services\Tasks\TaskSearchCriteria;
use App\Services\Tasks\TaskSearchService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * トップ画面表示
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $user = Auth::user();
        $groupId = session('group_id');
        $tasks = [];
        $taskSearchCriteria = null;
        if (!is_null($groupId)) {
            $taskSearchCriteria = $this->getTaskSearchCriteria($groupId, $request);
            $taskSearchService = new TaskSearchService();
            $tasks = $taskSearchService->execute($taskSearchCriteria);
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
            'targetUsers' => GroupMember::whereGroupId($groupId)->get(),
            'taskSearchCriteria' => $taskSearchCriteria,
        ];
        return view('home')->with($viewParams);
    }

    /**
     * @param int $groupId
     * @param Request $request
     * @return TaskSearchCriteria
     */
    private function getTaskSearchCriteria(int $groupId, Request $request): TaskSearchCriteria
    {
        $requestSort = $request->get('sort');
        $sort = is_null($requestSort) || !isset(Task::SORT[$requestSort]) ? 1 : $requestSort;
        $taskSearchCriteria = new TaskSearchCriteria($groupId, $sort);
        if (!$request->exists('isSearched')) {
            return $taskSearchCriteria;
        }

        $subject = $request->get('subject');
        $maps = $request->get('map');
        $legends = $request->get('legend');
        $contents = $request->get('contents');
        $limitedAtFrom = $request->get('limitedAtFrom');
        $limitedAtTo = $request->get('limitedAtTo');
        $targetUsers = $request->get('targetUser');

        if (!is_null($subject)) {
            $taskSearchCriteria->setSubject($subject);
        }

        if (!is_null($maps)) {
            $taskSearchCriteria->setMaps($maps);
        }

        if (!is_null($legends)) {
            $taskSearchCriteria->setLegends($legends);
        }

        if (!is_null($contents)) {
            $taskSearchCriteria->setContents($contents);
        }

        if (strtotime($limitedAtFrom)) {
            $taskSearchCriteria->setLimitedAtFrom(date('Y-m-d', strtotime($limitedAtFrom)));
        }

        if (strtotime($limitedAtTo)) {
            $taskSearchCriteria->setLimitedAtTo(date('Y-m-d', strtotime($limitedAtTo)));
        }

        if (!is_null($targetUsers)) {
            $taskSearchCriteria->setTargetUsers($targetUsers);
        }

        return $taskSearchCriteria;
    }
}
