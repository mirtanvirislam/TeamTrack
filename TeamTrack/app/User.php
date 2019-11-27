<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Team;

class User extends Authenticatable
{
    use Notifiable;

    //public $currentTeamId=0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setCurrentTeamId($team_id)
    {
        $this->setting->current_team_id = $team_id;
        $this->setting->save();
    }

    public function getCurrentTeamId()
    {
        return $this->setting->current_team_id;
    }

    public function getCurrentTeamName()
    {
        if($this->setting->current_team_id==0){
            return 'Select Team';
        }
        else{
            return Team::find($this->setting->current_team_id)->name;
        }
    }

    //Eloquent relation

    public function setting()
    {
        return $this->hasOne('App\Setting');
    }

 /**
     * Social Provider
     */
    public function socialProviders(){
        return $this->hasMany(SocialProvider::class);
    }


}
