<?php

// Importieren der benötigten Klassen
use SilverStripe\Control\Controller;
use SilverStripe\Security\Security;
use SilverStripe\Control\HTTPRequest;

// Definition der LoginController-Klasse, die von der Controller-Klasse erbt
class LoginController extends Controller {
    // Definieren der erlaubten Aktionen für diesen Controller
    private static $allowed_actions = ['LoginForm', 'doLogin']; // Fügen Sie 'doLogin' zu den erlaubten Aktionen hinzu

    // Definieren der URL-Handler für diesen Controller
    private static $url_handlers = [
        '' => 'LoginForm', // Die Basis-URL (z.B. /login) zeigt das Anmeldeformular an
        'doLogin' => 'doLogin' // Die URL /login/doLogin führt die Anmeldung durch
    ];

    // Definition der LoginForm-Methode, die ein LoginForm-Objekt zurückgibt
    public function LoginForm() {
        return $this->renderWith(['honey/LoginController/LoginForm', 'Page']); // Verwenden Sie renderWith, um die richtige .ss-Datei zu verwenden
    }

    // Definition der doLogin-Methode, die die Anmeldeinformationen überprüft und den Benutzer entsprechend umleitet
    public function doLogin($data, $form) {
        // Versuchen Sie, den Benutzer anzumelden
        $member = Security::findAnAuthenticatedUser($data['Email'], $data['Password']);

        // Überprüfen, ob die Anmeldung erfolgreich war
        if ($member) {
            // Wenn die Anmeldung erfolgreich war, leiten Sie den Benutzer zum Dashboard weiter
            Security::setCurrentUser($member);
            return $this->redirect('dashboard');
        } else {
            // Wenn die Anmeldung fehlgeschlagen ist, fügen Sie eine Fehlermeldung hinzu und leiten Sie den Benutzer zurück
            $form->addErrorMessage('Email', 'Ungültige E-Mail-Adresse oder Passwort.');
            return $this->redirectBack();
        }
    }

    // Definition der Link-Methode, die die Basis-URL für diesen Controller zurückgibt
    public function Link($action = null) {
        return Controller::join_links('login', $action);
    }
}
