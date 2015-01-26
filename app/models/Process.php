<?php

use LaravelBook\Ardent\Ardent;

class Process extends Ardent {
	/** Properties **/
	protected $fillable = array();
	public static $rules = array();

	/** Enable softDeleting **/
	use SoftDeletingTrait;

	/** Relations **/
	public function equipments() {
		return $this->hasMany('Equipment');
	}
	public function tasks() {
		return $this->hasManyThrough('Task', 'Equipment');
	}
	public function scheduled_tasks() {
		$tasks = array();
		foreach($this->tasks()->whereNotNull('started_at')->whereNotNull('finished_at')->where('status', '<>', 'complete')->orderBy('finished_at')->get() as $t) {
			if($t->project()->first()->schedule) {
				array_push($tasks, $t);
			}
		}
		return $tasks;
	}
	
}