<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * eager load the user model
     */
    public $with = [
        'user'
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function scopeDeletedTasks($query)
    {
        return $query->where('deleted_at', '!=', null);
    }
}
