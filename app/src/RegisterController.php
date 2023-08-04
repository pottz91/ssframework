
<?php 
use SilverStripe\Control\Controller;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;
use SilverStripe\Control\HTTPRequest;

class RegisterController extends Controller {
    private static $allowed_actions = ['RegisterForm'];

    public function RegisterForm() {
        return RegisterForm::create($this, 'RegisterForm');
    }

    public function doRegister($data, $form) {
        // Überprüfen Sie, ob ein Benutzer mit dieser E-Mail-Adresse bereits existiert
        if (Member::get()->filter('Email', $data['Email'])->exists()) {
            $form->addErrorMessage('Email', 'Diese E-Mail-Adresse ist bereits registriert.');
            return $this->redirectBack();
        }

        // Erstellen Sie ein neues Mitglied und speichern Sie es
        $member = Member::create();
        $member->Email = $data['Email'];
        $member->Password = $data['Password'];
        $member->write();

        // Melden Sie den Benutzer an und leiten Sie ihn zum Dashboard weiter
        Security::setCurrentUser($member);
        return $this->redirect('dashboard');
    }
}
