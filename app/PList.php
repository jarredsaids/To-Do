<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PList extends Model
{
    // Table Name
    protected $table = 'p_lists';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
