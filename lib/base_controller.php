<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['account'])) {
        $account_id = $_SESSION['account'];
        $account = Account::find($account_id);
        return $account;
      }
      // Toteuta kirjautuneen käyttäjän haku tähän
      return null;
    }

    public static function check_logged_in($id){
      if (self::get_user_logged_in != $id) {
        Redirect::to('{{base_path}}/login');
        return false;
      }
      Kint::dump($_SESSION['account']);
      return true;
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

    public static function log_out($id) {
      if ($id == $_SESSION['account']) {
        unset($_SESSION['account']);
        Redirect::to('/login');
      } else {
        Redirect::to('');
      }

    }

  }
