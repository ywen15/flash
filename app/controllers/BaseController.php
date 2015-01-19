<?php

class BaseController extends Controller {

	protected $USER_INFO;

	public function __contruct()
	{
		$this->USER_INFO = app('USER_INFO');
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
