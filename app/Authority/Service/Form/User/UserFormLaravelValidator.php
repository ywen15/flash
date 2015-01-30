<?php namespace Authority\Service\Form\User;

use Authority\Service\Validation\AbstractLaravelValidator;

class UserFormLaravelValidator extends AbstractLaravelValidator {
	
	/**
	 * Validation rules
	 *
	 * @var Array 
	 */
	protected $rules = array(
		'firstName' => array('required', 'alpha'),
        'lastName' => array('required', 'alpha'),
        'phone' => array('required', 'integer'),
        'fax' => 'integer',
        'colour' => array('required')
	);

	/**
	 * Custom Validation Messages
	 *
	 * @var Array 
	 */
	protected $messages = array(
		//'email.required' => 'An email address is required.'
	);
}