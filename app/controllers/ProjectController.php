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
		$users = User::whereNull('deleted_at')->orderBy('first_name')->get(['first_name', 'last_name', 'id'])->lists('full_name', 'id');
		$customers = Customer::whereNull('deleted_at')->orderBy('name')->lists('name', 'id');

		$processes = Process::whereNull('deleted_at')->orderBy('order')->get();
		$equipments = array();
		foreach($processes as $process) {
			$equipments = array_add($equipments, $process->name, $process->equipments()->orderBy('name')->lists('name', 'id'));
		}

		$taskStatus = Task::getTaskStatus();

		return View::make('projects.new')->with(array('users' => $users, 'customers' => $customers, 'equipments' => $equipments, 'taskStatus' => $taskStatus));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /project
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data['due_at'] = Carbon::createFromFormat('d F Y', $data['due_at'])->format('Y-m-d H:i:s');
		$project = new Project($data);

		if($project->save()) {
			$task = new Task($data);
			if($project->tasks()->save($task)) {
				Session::flash('success', trans('flash.project_create_success'));
				return Redirect::route('project.index');
			}
		}

		Session::flash('fail', trans('flash.project_create_fail'));
		return Redirect::route('project.index');
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
		$users = User::whereNull('deleted_at')->orderBy('first_name')->get(['first_name', 'last_name', 'id'])->lists('full_name', 'id');
		$customers = Customer::whereNull('deleted_at')->orderBy('name')->lists('name', 'id');

		$processes = Process::whereNull('deleted_at')->orderBy('order')->get();
		$equipments = array();
		foreach($processes as $process) {
			$equipments = array_add($equipments, $process->name, $process->equipments()->orderBy('name')->lists('name', 'id'));
		}

		$taskStatus = Task::getTaskStatus();

		return View::make('projects.edit')->with(array('project' => Project::findOrFail($id), 'users' => $users, 'customers' => $customers, 'equipments' => $equipments, 'taskStatus' => $taskStatus));
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
		$project = Project::findOrFail($id);

		$project->tasks()->delete();
		if($project->delete()) {
			Session::flash('success', trans('flash.project_delete_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_delete_fail'));
		}

		return Redirect::back();
	}

	public function modal($id, $type)
	{
		return View::make('projects.modal')->with('type', $type)->with('project', Project::findOrFail($id));
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
			$daysDiff = Carbon::now()->diffInDays($p->due_at, false);
			if($daysDiff < 0) $p->days_left = HTML::span($daysDiff, array('class' => 'days-left-past'));
			else if($daysDiff > 0) $p->days_left = HTML::span($daysDiff, array('class' => 'days-left-future'));
			else $p->days_left = HTML::span($daysDiff, array('class' => 'days-left-current'));

			$customer = $p->customer()->first();
			$p->customer = ($customer) ? $customer->name : null;

			$rep = $p->rep()->first();
			$p->rep = ($rep) ? $rep->first_name.' '.$rep->last_name : null;

			$pm = $p->pm()->first();
			$p->pm = ($pm) ? $pm->first_name.' '.$pm->last_name : null;

			$p->total = $p->order_amount + $p->shipping + $p->hst;

			$p->input_date = $p->created_at->format($this->USER_INFO->project_date_format);
			$p->due_date = HTML::span($p->due_at->format($this->USER_INFO->project_date_format), array('data-project' => $p->id));

			$p->days_to_complete = $p->due_at->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s', $p->created_at));
			$p->schedule = HTML::btnSchedule($p->id, $p->schedule);
			$p->task = count($p->tasks()->get());

			$p->notes = HTML::span($p->notes, array('data-project' => $p->id));

			if(!$project_type) {
				$completeBtn = HTML::btnComplete('project', $p->id);
			}
			else if($project_type == 'billing') {
				$billBtn = HTML::btnBill('project', $p->id);
				$resetBtn = HTML::btnReschedule('project', $p->id);
			}
			$editBtn = HTML::btnEdit('project', $p->id);
			$deleteBtn = HTML::btnDelete('project', $p->id);
			$p->modify = $completeBtn . $resetBtn . $billBtn . $editBtn . $deleteBtn;
		}

		//Cache::add($project_type, $projects, $this->CACHE_EXPIRE_TIME);
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

	public function reset($id)
	{
		$project = Project::findOrFail($id);

		$project->tasks()->update(array('status' => 'in-progress'));
		$project->completed_at = null;
		if($project->save()) {
			Session::flash('success', trans('flash.project_reschedule_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_reschedule_fail'));
		}

		return Redirect::back();
	}

	public function complete($id)
	{
		$project = Project::findOrFail($id);

		$project->tasks()->update(array('status' => 'complete'));
		$project->schedule = false;
		$project->completed_at = \Carbon\Carbon::now();

		if($project->save()) {
			Session::flash('success', trans('flash.project_complete_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_complete_fail'));
		}

		return Redirect::back();
	}

	public function bill($id)
	{
		$data = Input::all();
		$project = Project::findOrFail($id)->fill($data);
		$project->billed_at = \Carbon\Carbon::now()->toDateTimeString();

		if($project->save()) {
			Session::flash('success', trans('flash.project_bill_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_bill_fail'));
		}

		return Redirect::back();
	}

	public function saveNotes($id)
	{
		$project = Project::findOrFail($id);
		$project->notes = $_POST['notes'];

		if($project->save()) {
			Session::flash('success', trans('flash.project_notes_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_notes_fail'));
		}
	}

	public function saveDueDate($id)
	{
		$project = Project::findOrFail($id);
		$project->due_at = Carbon::createFromFormat('D/M/d/Y', $_POST['dueDate'])->format('Y-m-d H:i:s');

		if($project->save()) {
			Session::flash('success', trans('flash.project_duedate_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_duedate_fail'));
		}
	}

	public function schedule($id)
	{
		$project = Project::findOrFail($id);
		$project->schedule = ($project->schedule) ? false : true;

		if($project->save()) {
			Session::flash('success', trans('flash.project_schedule_success'));
		}
		else {
			Session::flash('fail', trans('flash.project_schedule_fail'));
		}

		return Redirect::back();
	}

	public function timeline($id)
	{
		$project = Project::findOrFail($id);
		$taskStatus = Task::getTaskStatus();
		return View::make('projects.timeline')->with('project', $project)->with('duration', $project->duration())->with('taskStatus', $taskStatus);
	}

}