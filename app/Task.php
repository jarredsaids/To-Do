<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(int $id)
 */
class Task extends Model
{

    protected $fillable = [
        'title', 'body', 'completed_at'
    ];

    protected $dates = [
        'completed_at'
    ];

    public $with = [
        'user', 'priorities'
    ];

    public function priorities()
    {
        return $this->belongsToMany(Priority::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDeletedTasks($query)
    {
        return $query->where('deleted_at', '!=', null);
    }

    public function getIsCompletedAttribute()
    {
        return ($this->completed_at);
    }

    public function markAsCompleted()
    {
        $this->update([
            'completed_at' => now()
        ]);
    }

    public function markAsIncomplete()
    {
        $this->update([
            'completed_at' => null
        ]);
    }

}
