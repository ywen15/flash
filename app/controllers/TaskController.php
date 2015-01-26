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
		//
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
		//Mon Jan 26 2015 00:00:00 GMT-0500 (EST)
		$tasks = Process::findOrFail($id)->tasks()->where('started_at', '>=', $_POST['start'])->where('finished_at', '<=', $_POST['end'])->get();
		dd(Carbon\Carbon::createFromFormat('D M d Y H:i:s', $_POST['start']));
	}

}