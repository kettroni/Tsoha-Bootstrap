<?php

class AccountController extends BaseController {

  public static function login() {
    View::make('account/login.html');
  }

  public static function handle_login() {
    $params = $_POST;
    $account = Account::authenticate($params['name'], $params['password']);

    if(!$account){
      View::make('account/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
    }else{
      $_SESSION['account'] = $account->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $account->name . '!'));
    }
  }
}
