<?php

use LaravelBook\Ardent\Ardent;

class Equipment extends Ardent {
	/** Properties **/
	protected $table = 'equipments';
	protected $fillable = array();
	public static $rules = array();

	/** Enable softDeleting **/
	use SoftDeletingTrait;

	/** Relations **/
	public function process() {
		return $this->belongsTo('Process');
	}
	public function tasks() {
		return $this->hasMany('Task');
	}
	public function unscheduled() {
		$tasks = array();
		foreach($this->tasks()->whereNull('started_at')->whereNull('finished_at')->get() as $t) {
			if($t->project()->first()->schedule) {
				array_push($tasks, $t);
			}
		}
		return $tasks;
	}
}