<?php 

namespace App;
use Illuminate\Database\Eloquent\Model;


trait RecordsActivity {


	public $oldAttributes = [];


	/**
		a model hook/event function. by convention must be
				- static
				- have name-syntax: bootCLASSNAME
		

	*/
	public static function bootRecordsActivity()
	{
		foreach(self::recordableEvents() as $event) 
		{
			static::$event(function ($model) use ($event) 
			{
				$model->recordActivity(strtolower(class_basename($model)) .  "_{$event}");
			});

			if ($event === 'updated')  {
				static::updating(function ($model) 
				{
 					$model->oldAttributes = $model->getOriginal();
				}); 
			}
		}
		
	}


	protected static function recordableEvents() 
	{
		if (isset(static::$recordableEvents)) 
		{
			return static::$recordableEvents;
		} 
	
		return ['created', 'updated'];
	}


    public function activity() 
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }


	public function recordActivity($description) 
    {
        $this->activity()->create(
            [
            'description' => $description,
            'changes'   => $this->activityChanges($description),
            'user_id'	=> ($this->project ?? $this)->owner->id,
            'project_id'    => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
  
    }



    protected function activityChanges($description) 
    {   //dd($description);
        if ($this->wasChanged())    //($description == 'project_updated') 
        {
            return [
                'before'     => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after'    => array_except($this->getChanges(), 'updated_at')
                ];
        } 

    }


}