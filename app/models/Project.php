<?php

use LaravelBook\Ardent\Ardent;

class Project extends Ardent {
	/** Properties **/
	protected $fillable = array();
	public static $rules = array();

	/** Relations **/
	public function tasks() {
		return $this->hasMany('Task');
	}
	public function rep() {
		return $this->belongsTo('User');
	}
	public function pm() {
		return $this->belongsTo('User');
	}
	public function customer() {
		return $this->belongsTo('Customer')
	}
}