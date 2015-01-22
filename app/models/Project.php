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
		return $this->belongsTo('User', 'rep_id');
	}
	public function pm() {
		return $this->belongsTo('User', 'pm_id');
	}
	public function customer() {
		return $this->belongsTo('Customer');
	}

	/** Get project collection count **/
	public static function getProjectType($type=null) {
		if($type == 'billing') {
			$projects = Cache::rememberForever('query_billing', function() {
				return Project::whereNull('billed_at')->whereNotNull('completed_at')->get();
			});
		}
		else if($type == 'archive') {
			$projects = Cache::rememberForever('query_archive', function() {
				return Project::whereNotNull('billed_at')->get();
			});
		}
		else {
			$projects = Cache::rememberForever('query_normal', function() {
				return Project::whereNull('completed_at')->whereNull('billed_at')->get();
			});
		}
		return $projects;
	}
}