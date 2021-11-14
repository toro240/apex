<?php

namespace App\Services\Tasks;

use App\Models\Task;
use App\Utils\SQLUtils;

class TaskSearchService
{
    public function execute(TaskSearchCriteria $taskSearchCriteria)
    {
        $query = Task::whereGroupId($taskSearchCriteria->getGroupId());
        if (!is_null($taskSearchCriteria->getSubject())) {
            $query->where('subject', 'LIKE',  '%' . SQLUtils::escapeLike($taskSearchCriteria->getSubject()) . '%');
        }
        if (!empty($taskSearchCriteria->getMaps())) {
            $query->whereIn('map', $taskSearchCriteria->getMaps());
        }
        if (!empty($taskSearchCriteria->getLegends())) {
            $query->whereIn('legend', $taskSearchCriteria->getLegends());
        }
        if (!is_null($taskSearchCriteria->getContents())) {
            $query->where('contents', 'LIKE',  '%' . SQLUtils::escapeLike($taskSearchCriteria->getContents()) . '%');
        }
        if (!is_null($taskSearchCriteria->getLimitedAtFrom())) {
            $query->where('limited_at', '>=',  $taskSearchCriteria->getLimitedAtFrom());
        }
        if (!is_null($taskSearchCriteria->getLimitedAtTo())) {
            $query->where('limited_at', '<=',  $taskSearchCriteria->getLimitedAtTo());
        }
        if (!empty($taskSearchCriteria->getTargetUsers())) {
            $query->whereHas('taskTargets', function($sQuery) use($taskSearchCriteria) {
                $sQuery->whereIn('user_id', array_merge($taskSearchCriteria->getTargetUsers()));
            });
        }

        $query->orderByRaw($taskSearchCriteria->getSort());

        return $query->get();
    }
}
