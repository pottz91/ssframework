<?php

use SilverStripe\Forms\Form;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\PasswordField;
use SilverStripe\Forms\FormAction;

class LoginForm extends Form {
    public function __construct($controller, $name) {
        $fields = new FieldList(
            EmailField::create('Email'),
            PasswordField::create('Password')
        );
        $actions = new FieldList(
            FormAction::create('doLogin', 'Login')
        );
        parent::__construct($controller, $name, $fields, $actions);
    }
}
