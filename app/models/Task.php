<?php

use LaravelBook\Ardent\Ardent;

class Task extends Ardent {
	/** Properties **/
	protected $fillable = array('equipment_id', 'recorded_time', 'actual_time', 'status', 'notes', 'started_at', 'finished_at');
	public static $rules = array();

	public static $scheduler = array('options' => array('timeslotsPerHour' => 1, 'timeslotHeight' => 60, 'defaultFreeBusy' => array('free' => true)), 'events' => array());

	/** Enable softDeleting **/
	use SoftDeletingTrait;

	/** Convert columns to Carbon objects **/
	public function getDates() {
		return array('started_at', 'finished_at', 'created_at', 'updated_at', 'deleted_at');
	}

	/** Relations **/
	public function project() {
		return $this->belongsTo('Project');
	}
	public function equipment() {
		return $this->belongsTo('Equipment');
	}

	public static function getTaskStatus() {
		return array('pending' => trans('flash.pending'), 'approved' => trans('flash.approved'), 'in-progress' => trans('flash.in-progress'), 'complete' => trans('flash.complete'));
	}

	public static function getScheduledTask() {
		$tasks = array();
		foreach(Task::whereNull('started_at')->whereNull('finished_at')->get() as $t) {
			if($t->project()->first()->schedule) {
				array_push($tasks, $t);
			}
		}
		return $tasks;
	}

}