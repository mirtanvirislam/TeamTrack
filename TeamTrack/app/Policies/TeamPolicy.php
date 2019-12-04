<?php

namespace App\Policies;

use App\User;
use App\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewTeam(User $user, Team $team)
    {
        return $team->members->contains('id',$user->id);
    }

    public function addMember(User $user, Team $team)
    {
        return $user->id == $team->leader_id;
    }

    public function removeMember(User $user, Team $team)
    {
        return $user->id == $team->leader_id;
    }

    public function destroyTeam(User $user, Team $team)
    {
        return $user->id == $team->leader_id;
    }

}