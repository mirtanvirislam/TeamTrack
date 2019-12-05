<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    public $primaryKey = 'id';
    public $timestamp =true;

    protected $guarded = [];


    // Functions

    public static function createTask($sprint_id, $assigned_to, $due_date, $created_by, $title, $description)
    {
        $newTask = Task::create([
            'sprint_id' => $sprint_id,
            'user_id' => $assigned_to, // TODO: change user_id to assigned_id in DB and update relation ? 
            'created_by' => $created_by,
            'title' => $title,
            'description' => $description,
            'due_date' => $due_date,
            'is_completed' => false 
        ]);
    }

    public static function commentTask($taskId, $commentorId, $commentContent)
    {
        $newComment = Comment::create([
            'task_id'=>$taskId,
            'commentor_id'=>$commentorId,
            'content'=>$commentContent
        ]);
    }


    // Eloquent Relationships 

    public function sprint()
    {
        return $this->belongsTo('App\Sprint');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
