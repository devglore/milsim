<?php
/**
 * Created by PhpStorm.
 * User: marcus
 * Date: 2015-08-10
 * Time: 15:38
 */

class session {
    public $sessionID, $sessionUsername;
    public $loggedIn = false;
    public $HasShownInfo = false; //om vi har loggat in så har vi sett dialogrutan om sessioner, då ändras denna till true

    //Vid varje ny instans så starta en session och kolla om man redan är inloggad
    function __construct() {
        session_start();
        $this->CheckLogin();
        if($this->loggedIn) {
            //TODO
        } else {
            //TODO
        }
    }

    //Loginfunktion, kommer hit via User klassen om inloggningen lyckades
    public function Login($userData) {
        if($userData) {
            $this->sessionID = $_SESSION['id'] = $userData['id'];
            $this->sessionUsername = $_SESSION['username'] =  $userData['username'];
            $this->loggedIn = true;
            $this->HasShownInfo = true;
        }
    }

    //Logout, nollställer variablerna
    function Logout(){
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($this->sessionID);
        unset($this->sessionUsername);
        $this->loggedIn = false;
    }

    //Kolla om vi har ett sessions id och i så fall uppdaterar vi instansen med den informationen, annars nollställer vi allt
    function CheckLogin() {
        if(isset($_SESSION['id'])) {
            $this->sessionID = $_SESSION['id'];
            $this->loggedIn = true;
            $this->HasShownInfo = true;
        } else {
            unset($this->sessionID);
            unset($this->sessionUsername);
            unset($_SESSION['username']);
            $this->loggedIn = false;;
        }
    }

    //Funktion för att snabbt kolla om man är inloggad eller inte
    public function IsLoggedIn() {
        return $this->$loggedIn;
    }

}
    $session = new session();