<?php

class TaskController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /task
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /task/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /task
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /task/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$taskStatus = Task::getTaskStatus();
		return View::make('tasks.show')->with('task', Task::findOrFail($id))->with('taskStatus', $taskStatus);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /task/{id}/edit
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
	 * PUT /task/{id}
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
	 * DELETE /task/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function saveStatus($id)
	{
		$task = Task::findOrFail($id);
		$task->status = $_POST['status'];

		if($task->save()) {
			Session::flash('success', trans('flash.task_status_success'));
		}
		else {
			Session::flash('fail', trans('flash.task_status_fail'));
		}
	}

	public function scheduler($process=null)
	{
		$process = ($process) ? Process::where('name', '=', $process)->first() : Process::orderBy('order')->first();
		$processes = Process::whereNull('deleted_at')->orderBy('order')->get();
		return View::make('tasks.scheduler')->with(array('processes' => $processes))->with('process', $process);
	}

	public function taskByDate($id)
	{
		$start = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $_POST['start']);
		$end = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $_POST['end']);
		$tasks = Process::findOrFail($id)->tasks()->where('started_at', '>=', $start)->where('finished_at', '<=', $end)->get();

		$results = Task::$scheduler;
		foreach($tasks as $t) {
			$project = $t->project()->first();
			$event = array(
				'id' => $t->id,
				'admin' => 'true',
				'project_id' => $t->project_id,
				'start' => $t->started_at->timestamp . '000',
				'end' => $t->finished_at->timestamp . '000',
				'title' => $project->description,
				'description' => $project->docket . '<br />' . $project->customer()->first()->name . '<br />' . trans('flash.'.$t->status),
				'locked' => true,
				'hasnote' => false,
				'userId' => intval($t->equipment()->first()->order),
				'colour' => $project->rep()->first()->colour
			);
			array_push($results['events'], $event);
		}
		return $results;
	}

	public function reschedule($id)
	{
		$task = Task::findOrFail($id);
		$task->started_at = null;
		$task->finished_at = null;
		$task->save();
	}

}