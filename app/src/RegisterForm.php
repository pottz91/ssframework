<?php
use SilverStripe\Forms\Form;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\PasswordField;
use SilverStripe\Forms\FormAction;

class RegisterForm extends Form {
    public function __construct($controller, $name) {
        $fields = new FieldList(
            EmailField::create('Email'),
            PasswordField::create('Password'),
            PasswordField::create('ConfirmPassword')
        );
        $actions = new FieldList(
            FormAction::create('doRegister', 'Register')
        );
        parent::__construct($controller, $name, $fields, $actions);
    }
}
