<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function validate_string_length($string, $length) {
        $errors = array();
        if ($string == '' || $string == null) {
          $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if(strlen($string) < $length){
          $errors[] = 'Nimen pituuden tulee olla vähintään ' . $length . ' merkkiä!';
        }
        return $errors;
    }

    public function validate_password_length($string, $length) {
      $errors = array();
      if ($string == '' || $string == null) {
        $errors[] = 'Salasana ei saa olla tyhjä!';
      }
      if(strlen($string) < $length){
        $errors[] = 'Salasanan pituuden tulee olla vähintään ' . $length . ' merkkiä!';
      }
      return $errors;
    }

    public function validate_accountname($string, $length) {
      $errors = array();
      $errors = $this->validate_string_length($string, $length);

      $query = DB::connection()->prepare('SELECT * FROM Account WHERE name = :name');
      $query->execute(array('name' => $string));
      $rows = $query->fetch();
      if ($rows) {
        $errors[] = 'Käyttäjätunnus on jo käytössä, valitse uusi!';
      }

      return $errors;
    }

    public function validate_integer($integer) {
      $errors = array();
      if($integer == null){
        $errors[] = 'Anna prioriteetti!';
      }

      return $errors;
    }



    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();
      foreach($this->validators as $validator){
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

  }
