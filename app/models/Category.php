<?php

class Category extends BaseModel{
  public $id, $name;

  public function __construct($attributes){
    parent::__construct($attributes);

    $this->validators = array('validate_name');
  }

  public function validate_name(){
    $errors = $this->validate_string_length($this->name, 3);
    return $errors;
  }

  public static function all(){
   $query = DB::connection()->prepare('SELECT * FROM Category');
   $query->execute();
   $rows = $query->fetchAll();
   $categories = array();

   foreach($rows as $row){
     $categories[] = new Category(array(
       'id' => $row['id'],
       'name' => $row['name']
     ));
    }

   return $categories;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Category WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row) {
      $category = new Category(array(
        'id' => $row['id'],
        'name' => $row['name']
      ));
      return $category;
    }
    return null;
  }

  public static function findByName($name) {
    $query = DB::connection()->prepare('SELECT * FROM Category WHERE name = :name LIMIT 1');
    $query->execute(array('name' => $name));
    $row = $query->fetch();

    if($row) {
      $category = new Category(array(
        'id' => $row['id'],
        'name' => $row['name']
      ));
      Kint::dump($category);
      return $category;
    }
    return null;
  }





  public function save() {
    $query = DB::connection()->prepare('INSERT INTO Category (name) VALUES (:name) RETURNING id');

    $query->execute(array('name' => $this->name));

    $row = $query->fetch();

    $this->id = $row['id'];
  }

  public function destroy($id) {
    TaskCategory::destroyByCategory($id);
    $query = DB::connection()->prepare('DELETE FROM Category WHERE id=:id');

    $query->execute(array('id' => $id));
  }


}
