<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    
    protected $guarded = [];


    // Functions

    public static function createTeam($team_name, $leader_id)
    {
        $default_no_of_sprints = 4;                             //sets no of sprints in new Team

        $newTeam = self::createTeamDB($team_name, $leader_id);  //creates Team in DB and assigns creator as Leader
        self::addMember($leader_id, $newTeam->id);              //adds creator to created Team's member-list
        $newTeamBacklog = self::createBacklog($newTeam->id, $default_no_of_sprints);    //create Backlog for created Team
        self::createSprints($newTeamBacklog->id, $default_no_of_sprints);               // create Sprints for created team
        return $newTeam;
    }

    public static function deleteTeam($teamId)
    {
        $team = Team::find($teamId);

        //delete tasks for each sprint
        foreach($team->backlog->sprints as $sprint)
        {
            //$sprint->tasks()->delete();
            self::emptySprint($sprint->id);
        }
        //delete sprints
        $team->backlog->sprints()->delete();
        //delete backlog
        $team->backlog()->delete();
        //detach members
            //TODO refactor to removeMember()
        $team->members()->detach();
        //delete team
        $team->delete();
    }

    public static function deleteSprint($sprintId)
    {
        $sprint = Sprint::find($sprintId);
        $sprint->tasks()->delete(); //delete tasks in sprint
        $sprint->delete();          //delete sprint
    }

    public static function addMember($member_id, $team_id)
    {
        $team = Team::find($team_id);
        $team->members()->syncWithoutDetaching($member_id);
    }

    public static function addMemberByEmail($member_email, $team_id)
    {
        $newMember = User::where('email',$member_email)->first();
        $team = Team::find($team_id);
        $team->members()->syncWithoutDetaching($newMember->id);
    }

    public static function removeMember($memberId, $teamId)
    {  
        $team = Team::find($teamId);
        $team->members()->detach($memberId);
    }


    // Internal Functions

    private static function createTeamDB($team_name, $leader_id)
    {
        $newTeam = Team::create([
            'name'=>$team_name, 
            'leader_id'=>$leader_id 
            ]);

        return $newTeam;
    }

    private static function createBacklog($team_id, $default_no_of_sprints)
    {
        $newTeamBacklog = Backlog::create([
            'team_id'=>$team_id, 
            'no_of_sprints'=>$default_no_of_sprints, 
            'due_date'=>'2019-08-12 00:00:00'
            ]);
        return $newTeamBacklog;
    }

    private static function createSprints($backlog_id, $default_no_of_sprints)
    {
        for($x=1; $x <= $default_no_of_sprints; $x++)
        {
            Sprint::create([
                'backlog_id'=>$backlog_id, 
                'sprint_no'=>$x, 
                'start_date'=>'2019-08-08 00:00:00', 
                'due_date'=>'2019-08-10 00:00:00'
                ]);
        }
    }

        //deletes all tasks inside a sprint
    public static function emptySprint($sprintId)
    {
        $sprint = Sprint::find($sprintId);
        $sprint->tasks()->delete();
    }


    // Eloquent Relationships 

    public function users(){
        return $this->belongsToMany('App\User','team_user','team_id');
    }

    public function members(){
        return $this->belongsToMany('App\Member','team_user','team_id','user_id');
    }

    public function leader()
    {
        return $this->belongsTo('App\Leader','leader_id');
    }

    public function backlog()
    {
        return $this->hasOne('App\Backlog');
    }

}
