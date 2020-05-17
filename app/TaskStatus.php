<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    public static function getList()
    {
        return self::pluck('name', 'id')->prepend('', '');
    }
}
