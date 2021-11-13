<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static whereTaskId(int $id)
 * @method static create(array $array)
 */
class TaskTarget extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
