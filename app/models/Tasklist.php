<?php
class Tasklist extends BaseModel{
  public $id, $account_id, $name;

  public function __construct($attributes){
    parent::__construct($attributes);

    $this->validators = array('validate_name');
  }

  public function validate_name(){
    $errors = $this->validate_string_length($this->name, 3);
    return $errors;
  }

  public static function all(){

    $account = BaseController::get_user_logged_in();

    $query = DB::connection()->prepare('SELECT * FROM Tasklist WHERE account_id = :account_id');
    $query->execute(array('account_id' => $account->id));
    $rows = $query->fetchAll();

    $tasklists = array();

    foreach($rows as $row){
      $tasklists[] = new Tasklist(array(
        'id' => $row['id'],
        '$account_id' => $row['account_id'],
        'name' => $row['name']
       ));
      }
      return $tasklists;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Tasklist WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row) {
      $tasklist = new Tasklist(array(
        'id' => $row['id'],
        'account_id' => $row['account_id'],
        'name' => $row['name']
      ));

      return $tasklist;
    }
    return null;
  }



  public function save() {

    $query = DB::connection()->prepare('INSERT INTO Tasklist (name, account_id) VALUES (:name, :account_id) RETURNING id');

    $query->execute(array('name' => $this->name, 'account_id' => $this->account_id));

    $row = $query->fetch();

    $this->id = $row['id'];
  }

  public function update($id) {

    $query = DB::connection()->prepare('UPDATE Tasklist SET name = :name WHERE id=:id');

    $query->execute(array('id' => $id, 'name' => $this->name));
  }

  public static function destroy($id) {
    $first = DB::connection()->prepare('SELECT id FROM Task WHERE tasklist_id = :tasklist_id');
    $first->execute(array('tasklist_id' => $id));
    Kint::dump($first);
    foreach ($first as $value) {
      Task::destroy($value['id']);
    }

    $query = DB::connection()->prepare('DELETE FROM Tasklist WHERE id=:id');

    $query->execute(array('id' => $id));

  }


}
