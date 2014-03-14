<?php namespace Authority\Service\Form\Login;

use Authority\Service\Validation\AbstractLaravelValidator;

class LoginFormLaravelValidator extends AbstractLaravelValidator
{

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'email'    => 'required|min:4|max:32|email',
        'password' => 'required'
    );

    /**
     * Custom Validation Messages
     *
     * @var Array
     */
    protected $messages = array(//'email.required' => 'An email address is required.'
    );
}