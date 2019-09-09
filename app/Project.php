<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{

    protected $guarded = [];

    public $old = [];


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
    
/*
    public function activity() 
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
        //return $this->hasMany(Activity::class)->latest();

    }
*/


    public function recordActivity($description) 
    {
        $this->activity()->create(
            [
            'description' => $description,
            'changes'   => $this->activityChanges($description)
        ]);
  
    }


    protected function activityChanges($description) 
    {   //dd($description);
        if ($description === 'project_updated') 
        {
            return [
                'before'     => array_except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after'    => array_except(array_diff($this->getAttributes(), $this->old), 'updated_at')
                ];
        } 

        return null;
    }

 

}
