<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\TaskRelationship;

class Task extends Model
{
    use TaskRelationship;

    protected $table = 'task';
    protected $fillable = ['id', 'title', 'description', 'status_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
