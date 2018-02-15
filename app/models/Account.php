<?php

class Account extends BaseModel{
  public $id, $name, $password;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_name', 'validate_password');
  }

  public function validate_name(){
    $errors = $this->validate_accountname($this->name, 3);
    return $errors;
  }

  public function validate_password(){
    $errors = $this->validate_password_length($this->password, 3);
    return $errors;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row) {
      $account = new Account(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
      ));

      return $account;
    }
    return null;
  }

  public function save() {
    $query = DB::connection()->prepare('INSERT INTO Account (name, password) VALUES (:name, :password) RETURNING id');
    $query->execute(array('name' => $this->name, 'password' => $this->password));

    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public static function authenticate($name, $password) {
    $query = DB::connection()->prepare('SELECT * FROM Account WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if($row){
      return Account::find($row['id']);
    } else {
      return null;
    }
  }
}
