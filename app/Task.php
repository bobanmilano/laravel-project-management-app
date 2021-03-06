<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{


    use RecordsActivity;

    
    protected $guarded  = [];

    protected $touches  = [ 'project' ];

    protected $casts    = [ "completed" => "boolean" ];

    protected static $recordableEvents = ['created', 'deleted'];


    protected static function boot() 
    {
        parent::boot();
    }


    public function complete() 
    {
        $this->update(["completed" => true]);

        $this->recordActivity("task_completed");       
    }


    public function incomplete() 
    {
        $this->update(["completed" => false]);

        $this->recordActivity("task_incompleted");       
    }


    public function project() 
    {
    	return $this->belongsTo(Project::class);
    }


    public function path() 
    {
        return "/projects/" . $this->project->id . "/tasks/" . $this->id;
    }


     


}