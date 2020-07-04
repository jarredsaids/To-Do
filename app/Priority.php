<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    // Table Name
    protected $table = 'priorities';
    // Primary Key
    public $primaryKey = 'id';

    public function task()
    {
        return $this->belongsToMany(Task::class);
    }
}
