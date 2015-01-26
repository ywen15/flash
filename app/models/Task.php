<?php

use LaravelBook\Ardent\Ardent;

class Task extends Ardent {
	/** Properties **/
	protected $fillable = array('equipment_id', 'recorded_time', 'actual_time', 'status', 'notes', 'started_at', 'finished_at');
	public static $rules = array();

	/** Enable softDeleting **/
	use SoftDeletingTrait;

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
}