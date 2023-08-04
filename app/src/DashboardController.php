<?php

use SilverStripe\Control\Controller;
use SilverStripe\Security\Security;

class DashboardController extends Controller {
    private static $allowed_actions = ['index'];

    public function index() {
        // Überprüfen Sie, ob der Benutzer angemeldet ist
        if (!Security::getCurrentUser()) {
            return $this->redirect('login');
        }

        // Hier können Sie die Dashboard-Seite rendern
        return $this->renderWith('Dashboard');
    }
}
