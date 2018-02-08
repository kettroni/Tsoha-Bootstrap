<?php
  class HelloWorldController extends BaseController{

    public static function sandbox(){
      $doom = new Task(array(
        'name' => 'dos',
        'description' => 'Boom, boom!',
        'priority' => 41
      ));
      $errors = $doom->errors();

      Kint::dump($errors);
    }

    public static function helloworld() {
      View::make('home.html');
    }

    public static function note_list(){
      View::make('suunnitelmat/note_list.html');
    }

    public static function note_edit(){
     View::make('suunnitelmat/note_edit.html');
    }

    public static function login(){
     View::make('suunnitelmat/login.html');
    }

    public static function account_lists(){
      View::make('suunnitelmat/account_lists.html');
    }

  }
