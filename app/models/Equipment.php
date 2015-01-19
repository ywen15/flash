<?php

use LaravelBook\Ardent\Ardent;

class Equipment extends Ardent {
	/** Properties **/
	protected $fillable = array();
	public static $rules = array();

	/** Relations **/
	public function process() {
		return $this->belongsTo('Process');
	}
	public function tasks() {
		return $this->hasMany('Task');
	}
}