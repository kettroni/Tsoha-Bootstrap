<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
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
