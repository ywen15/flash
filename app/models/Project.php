<?php

use LaravelBook\Ardent\Ardent;

class Project extends Ardent {
	/** Properties **/
	protected $fillable = array('description', 'docket', 'customer_id', 'quantity', 'stock', 'notes', 'rep_id', 'pm_id', 'schedule', 'reference', 'order_amount', 'shipping', 'hst', 'due_at', 'completed_at', 'billed_at');
	public static $rules = array();

	/** Enable softDeleting **/
	use SoftDeletingTrait;

	/** Boot **/
	public static function boot() {
		parent::boot();

		static::creating(function($project) {
			Cache::flush();
		});

		static::updating(function($project) {
			Cache::flush();
		});

		static::deleted(function($project) {
			Cache::flush();
		});
	}

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
	public function duration() {
		$duration = 0;
		foreach($this->tasks()->get() as $t) {
			$duration += intval($t->actual_time);
		}
		return $duration;
	}

	/** Get project collection count **/
	public static function getProjectType($type=null) {
		if($type == 'billing') {
			$projects = Cache::rememberForever('query_billing', function() {
				return Project::whereNull('deleted_at')->whereNull('billed_at')->whereNotNull('completed_at')->get();
			});
		}
		else if($type == 'archive') {
			$projects = Cache::rememberForever('query_archive', function() {
				return Project::whereNull('deleted_at')->whereNotNull('billed_at')->get();
			});
		}
		else {
			$projects = Cache::rememberForever('query_normal', function() {
				return Project::whereNull('deleted_at')->whereNull('completed_at')->whereNull('billed_at')->get();
			});
		}
		return $projects;
	}
}