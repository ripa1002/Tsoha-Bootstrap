<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Katsotaan onko käyttäjä-avain sessiossa
    if(isset($_SESSION['kayttaja'])){
      $kayttaja_id = $_SESSION['kayttaja'];
      // Pyydetään Kayttaja-mallilta käyttäjä session mukaisella id:llä
      $kayttaja = Kayttaja::etsi($kayttaja_id);

      return $kayttaja;
    }
    // Käyttäjä ei ole kirjautunut sisään
    return null;
  }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
