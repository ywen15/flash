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
}