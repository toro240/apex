<?php

namespace Tests\Unit\Services\Tasks;

use App\Models\Group;
use App\Models\Task;
use App\Models\TaskTarget;
use App\Models\User;
use App\Services\Tasks\TaskSearchCriteria;
use App\Services\Tasks\TaskSearchService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TaskSearchServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * TaskSearchService->execute.
     * group_id で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereGroupId()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
        ]);
        // テスト対象外
        $excludedGroup = Group::factory()->create();
        Task::factory()->create([
            'group_id' => $excludedGroup->id,
            'created_user_id' => $user->id,
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(1, $actual);
        $this->assertEquals($expected->id, $actual[0]->id);
    }

    /**
     * TaskSearchService->execute.
     * Limited At ASC でソートしていることのテスト
     * @return void
     */
    public function testExecute_sortLimitedAtAsc()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        // sort 2番目
        $expected_2 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2021-10-02 0:00:00',
        ]);
        // sort 1番目
        $expected_1 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2021-10-01 0:00:00',
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(2, $actual);
        $this->assertEquals($expected_1->id, $actual[0]->id);
        $this->assertEquals($expected_2->id, $actual[1]->id);
    }

    /**
     * TaskSearchService->execute.
     * subject で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereSubject()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'subject' => 'test',
        ]);
        // テスト対象外
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'subject' => 'tes' . PHP_EOL . 't'
        ]);
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'subject' => 'exclude'
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setSubject('test');
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(1, $actual);
        $this->assertEquals($expected->id, $actual[0]->id);
    }

    /**
     * TaskSearchService->execute.
     * map で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereInMaps()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected_1 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'map' => 1,
        ]);
        $expected_2 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'map' => 2,
        ]);
        // テスト対象外
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'map' => 3,
        ]);
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'map' => null,
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setMaps([1, 2]);
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(2, $actual);
        $this->assertEquals($expected_1->id, $actual[0]->id);
        $this->assertEquals($expected_2->id, $actual[1]->id);
    }

    /**
     * TaskSearchService->execute.
     * legend で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereInLegends()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected_1 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'legend' => 1,
        ]);
        $expected_2 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'legend' => 2,
        ]);
        // テスト対象外
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'legend' => 3,
        ]);
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'legend' => null,
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setLegends([1, 2]);
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(2, $actual);
        $this->assertEquals($expected_1->id, $actual[0]->id);
        $this->assertEquals($expected_2->id, $actual[1]->id);
    }

    /**
     * TaskSearchService->execute.
     * contents で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereContents()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'contents' => 'test',
        ]);
        // テスト対象外
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'contents' => 'tes' . PHP_EOL . 't',
        ]);
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'contents' => 'exclude',
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setContents('test');
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(1, $actual);
        $this->assertEquals($expected->id, $actual[0]->id);
    }

    /**
     * TaskSearchService->execute.
     * limited_at From で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereLimitedAtFrom()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected_1 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2021-01-01 0:00:00',
        ]);
        $expected_2 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2021-01-02 0:00:00',
        ]);
        // テスト対象外
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2020-12-31 23:59:59',
        ]);
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => null,
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setLimitedAtFrom('2021-01-01 0:00:00');
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(2, $actual);
        $this->assertEquals($expected_1->id, $actual[0]->id);
        $this->assertEquals($expected_2->id, $actual[1]->id);
    }

    /**
     * TaskSearchService->execute.
     * limited_at To で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereLimitedAtTo()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $expected_1 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2020-12-30 0:00:00',
        ]);
        $expected_2 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2020-12-31 0:00:00',
        ]);

        // テスト対象外
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => '2021-01-01 0:00:00',
        ]);
        Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user->id,
            'limited_at' => null,
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setLimitedAtTo('2020-12-31 0:00:00');
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(2, $actual);
        $this->assertEquals($expected_1->id, $actual[0]->id);
        $this->assertEquals($expected_2->id, $actual[1]->id);
    }

    /**
     * TaskSearchService->execute.
     * task_targets.user_id で絞り込めていることのテスト
     * @return void
     */
    public function testExecute_whereInTaskTargetsUserId()
    {
        $user_1 = User::factory()->create();
        $user_2 = User::factory()->create();
        $user_3 = User::factory()->create(); // テスト対象外
        $group = Group::factory()->create();
        $task_1 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user_1->id,
        ]);
        $expected_1 = TaskTarget::factory()->create([
            'task_id' => $task_1->id,
            'user_id' => $user_1->id,
        ]);
        $expected_2 = TaskTarget::factory()->create([
            'task_id' => $task_1->id,
            'user_id' => $user_2->id,
        ]);

        $task_2 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user_1->id,
        ]);
        $expected_3 = TaskTarget::factory()->create([
            'task_id' => $task_2->id,
            'user_id' => $user_1->id,
        ]);

        // テスト対象外
        $task_3 = Task::factory()->create([
            'group_id' => $group->id,
            'created_user_id' => $user_1->id,
        ]);
        TaskTarget::factory()->create([
            'task_id' => $task_3->id,
            'user_id' => $user_3->id,
        ]);

        $taskSearchCriteria = new TaskSearchCriteria($group->id, 1);
        $taskSearchCriteria->setTargetUsers([$user_1->id, $user_2->id]);
        $taskSearchService = new TaskSearchService();
        $actual = $taskSearchService->execute($taskSearchCriteria);

        $this->assertCount(2, $actual);

        $this->assertCount(2, $actual[0]->taskTargets);
        $this->assertEquals($expected_1->id, $actual[0]->taskTargets[0]->id);
        $this->assertEquals($expected_2->id, $actual[0]->taskTargets[1]->id);

        $this->assertCount(1, $actual[1]->taskTargets);
        $this->assertEquals($expected_3->id, $actual[1]->taskTargets[0]->id);
    }
}
