<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tag;
use App\TaskStatus;

class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'creator_id',
        'assignedTo_id',
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assignedTo_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_task');
    }

    /**
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeOfCreator($query, $name)
    {
        return $query->whereHas('creator', function ($q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%');
        });
    }

    public function scopeOfAssignedTo($query, $name)
    {
        return $query->whereHas('assignedTo', function ($q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%');
        });
    }

    public function scopeOfTaskStatus($query, $taskStatusId)
    {
         return $taskStatusId === 0 ? $query : $query->where('status_id', $taskStatusId);
    }

    public function scopeOfTags($query, $name)
    {
        return $query->whereHas('tags', function ($q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%');
        });
    }
}
