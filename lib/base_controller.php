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
    
    public static function log_out($id) {
      if ($id == $_SESSION['account']) {
        unset($_SESSION['account']);
        Redirect::to('/login');
      } else {
        Redirect::to('');
      }

    }

  }
