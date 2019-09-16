<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;


class Project extends Model
{


    use RecordsActivity;

    protected $guarded = [];



    public function path() 
    {
    	return "/projects/{$this->id}";
    }


    public function owner() 
    {
    	return $this->belongsTo(User::class);
    }


    public function tasks() {
    	return $this->hasMany(Task::class);
    }


    public function addTask($body) 
    {
        return $this->tasks()->create(compact('body'));
    }

    
    public function activity() 
    {
        return $this->hasMany(Activity::class)->latest();
    }


    public function invite(User $user) 
    {
        return $this->members()->attach($user);
    }


    /**

        a project can have many users
        a user can have many projects
            => a separate db-table and belongs-to-many relationship 

        arg 1: User type
        arg 2: tablename 
    
    **/
    public function members() {
        return $this->belongsToMany(User::class, 'project_members');
    }
    


}
