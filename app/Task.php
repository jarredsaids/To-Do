<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Table Name
    protected $table = 'tasks';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function priorities()
    {
        return $this->belongsToMany(Priority::class);
    }


    /**
     * @var mixed
     */
}
