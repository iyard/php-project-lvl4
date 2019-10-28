<?php

function getTagsString($taskId = null)
{
    if (is_null($taskId)) {
        return '';
    }
    return \App\Task::find($taskId)
        ->tags()
        ->get()
        ->implode('name', ', ');
}

function saveTags($task, $inputTags)
{
    $tags = explodeTags($inputTags);
    foreach ($tags as $tag) {
        \App\Tag::firstOrCreate(['name' => $tag]);
    }
    $task->tags()->detach();
    $tags = \App\Tag::whereIn('name', $tags)
        ->get();
    $task->tags()->attach($tags);
}

function explodeTags($tags)
{
    return collect(explode(',', $tags))
        ->map(function ($tag) {
            return trim($tag);
        })
        ->filter(function ($tag) {
            return $tag != '';
        })
        ->all();
}
