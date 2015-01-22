<?php

use Carbon\Carbon;

class ProjectController extends \BaseController {

	private $CACHE_EXPIRE_TIME = 1440; // in minutes
	private $USER_INFO;

	public function __construct()
	{
		$this->USER_INFO = app('USER_INFO');
	}

	/**
	 * Display a listing of the resource.
	 * GET /project
	 *
	 * @return Response
	 */
	public function index($type=null)
	{
		return View::make('projects.index')->with('type', $type);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /project/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /project
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /project/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function delete($id)
	{
		return View::make('projects.delete')->with('project', Project::findOrFail($id));
	}

	public function dataTable($project_type=null)
	{
		if(Cache::has($project_type)) {
			return Response::json(array('data' => Cache::get($project_type)));
		}

		$projects = Project::getProjectType($project_type);

		$daysDiff = $customer = $rep = $pm = null;
		$editBtn = $completeBtn = $deleteBtn = $resetBtn = $billBtn = null;

		foreach($projects as $p) {
			$p->timeline = '<button type="button" class="btn btn-sm btn-primary project-tl" data-project="'.$p->id.'"><span class="glyphicon glyphicon-plus"></span></button>';
			$daysDiff = Carbon::now()->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s', $p->due_at), false);
			if($daysDiff < 0) $p->days_left = HTML::span($daysDiff, array('class' => 'days-left-past'));
			else if($daysDiff > 0) $p->days_left = HTML::span($daysDiff, array('class' => 'days-left-future'));
			else $p->days_left = HTML::span($daysDiff, array('class' => 'days-left-current'));

			$customer = $p->customer()->first();
			$p->customer = ($customer) ? $customer->name : null;

			$rep = $p->rep()->first();
			$p->rep = ($rep) ? $rep->first_name.' '.$rep->last_name : null;

			$pm = $p->pm()->first();
			$p->pm = ($pm) ? $pm->first_name.' '.$pm->last_name : null;

			$p->total = $p->order_amount + $p->hst;

			$p->days_to_complete = Carbon::createFromFormat('Y-m-d H:i:s', $p->due_at)->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s', $p->created_at));
			$p->schedule = ($p->schedule) ? HTML::image('images/on_schedule.png') : HTML::image('images/off_schedule.png');
			$p->task = count($p->tasks()->get());

			$editBtn = HTML::btnEdit('project', $p->id);
			$deleteBtn = HTML::btnDelete('project', $p->id);
			$p->modify = $completeBtn . $resetBtn . $billBtn . $editBtn . $deleteBtn;
		}

		Cache::add($project_type, $projects, $this->CACHE_EXPIRE_TIME);
		return Response::json(array('data' => $projects));
		
	}

	public function billing()
	{
		return $this->index('billing');
	}

	public function archive()
	{
		return $this->index('archive');
	}

}