<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'due_date',
        'priority',
        'task_image'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
