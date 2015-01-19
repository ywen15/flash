<?php

use LaravelBook\Ardent\Ardent;

class Task extends Ardent {
	/** Properties **/
	protected $fillable = array();
	public static $rules = array();

	/** Relations **/
	public function project() {
		return $this->belongsTo('Project');
	}
	public function equipment() {
		return $this->belongsTo('Equipment');
	}
}