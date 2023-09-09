<?php

/* 
# Installation de PHPMailer : 
sudo apt-get install libphp-phpmailer
sudo systemctl restart apache2
*/

class Mailer {

    // Attributes

    private object $phpmailer;
    private array $mailer;
    private array $general;

    public function __construct() {
        require_once('/usr/share/php/libphp-phpmailer/src/PHPMailer.php');
        require_once('/usr/share/php/libphp-phpmailer/autoload.php');
        require('./configuration.php');
        $this->mailer = (array) $mailer;
        $this->general = (array) $general;
        $this->prepareMailer();
    }

    // Methods

    private function prepareMailer() : void  {
        // Instanciation de la librairie PHPMailer et creation de l'objet $phpmailer
        $this->phpmailer = (object) new PHPMailer\PHPMailer\PHPMailer(true);
        // Appel de la methode prive pour les parametres generaux
        $this->setConfiguration();
        // Appel de la methode prive pour la configuration du serveur SMTP
        $this->setServer();
        // Appel de la methode prive pour la configuration des identifiants
        $this->setAuth();
    }

    private function setConfiguration() : void {
        // Definition du delai d'attente
        $this->phpmailer->Timeout = (int) 10;
	$this->phpmailer->XMailer = '';
        // Permet d'afficher les bugs 
        //$this->phpmailer->SMTPDebug = (int) 3;    
    }

    private function setServer() : void {
        // PHPMailer utilisera les sockets
        $this->phpmailer->isSMTP();
        // Definition du domaine
        $this->phpmailer->Host = (string) $this->mailer['host'];
        // Definition du port
        $this->phpmailer->Port = (string) $this->mailer['port'];
        // Definition du chiffrement
        $this->phpmailer->SMTPSecure = (string) 'tls';
    }

    private function setAuth() : void {
        // Le serveur necessite une identification
        $this->phpmailer->SMTPAuth = (bool) true;
        // Definition du nom d'utilisateur
        $this->phpmailer->Username = (string) $this->mailer['username'];
        // Definition du mot de passe
        $this->phpmailer->Password = (string) $this->mailer['password'];
    }

    public function sendEmail(string $email, string $subject, string $body) : void {

        // Definition de l'expediteur
        $this->phpmailer->setFrom($this->mailer['username'], $this->general['domain']);
        // Definition du destinataire
        $this->phpmailer->addAddress($email, '');

        // Permet l'envoi de message au format HTML
        $this->phpmailer->isHTML(true);
        // Definition du titre du mail
        $this->phpmailer->Subject = (string) $subject;
        // Definition du corps du mail
        $this->phpmailer->Body = (string) $body;
        // Appel de la methode prive pour l'envoi du mail
        $this->deliveryEmail();
    }

    private function deliveryEmail() : void {
        try {
            // Negociation avec le serveur SMTP pour l'envoi
            $this->phpmailer->send();
        } catch (Exception $exception) {
            die($exception);
        }
    }

}

?>