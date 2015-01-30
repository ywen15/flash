<?php

use Carbon\Carbon;

class ProcessController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /process
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /process/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /process
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /process/{id}
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
	 * GET /process/{id}/edit
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
	 * PUT /process/{id}
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
	 * DELETE /process/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getEquipmentList($id)
	{
		return Process::findOrFail($id)->equipments()->lists('name');
	}

	public function weekelyTask($id)
	{
		$result = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array());
		
		$start_date = Carbon::createFromTimestamp(intval($_GET['start']) / 1000);
		$end_date = Carbon::createFromTimestamp(intval($_GET['end']) / 1000);

		$tasks = Process::findOrFail($id)->tasks()->where('equipment_id', '=', $_GET['equipment'])
												  ->where('started_at', '>=', $start_date)
												  ->where('finished_at', '<=', $end_date)
												  ->orderBy('started_at', 'asc')->get();

		foreach ($tasks as $t) {
			array_push($result[intval($t->started_at->format('N'))], $t);
		}
		$data = array('tasks' => $result,
					  'start' => $start_date,
					  'end'   => $end_date);

		return View::make('tasks.weekly_view')->with($data);
	}

}