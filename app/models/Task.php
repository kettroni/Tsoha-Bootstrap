<?php
class Task extends BaseModel{
  public $id, $tasklist_id, $name, $done, $description, $added, $priority;
  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all(){
   $query = DB::connection()->prepare('SELECT * FROM Task');
   $query->execute();
   $rows = $query->fetchAll();
   $tasks = array();

   foreach($rows as $row){
     $tasks[] = new Task(array(
       'id' => $row['id'],
       'tasklist_id' => $row['tasklist_id'],
       'name' => $row['name'],
       'done' => $row['done'],
       'description' => $row['description'],
       'added' => $row['added'],
       'priority' => $row['priority']
     ));
    }

   return $tasks;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row) {
      $task = new Task(array(
        'id' => $row['id'],
        'tasklist_id' => $row['tasklist_id'],
        'name' => $row['name'],
        'done' => $row['done'],
        'description' => $row['description'],
        'added' => $row['added'],
        'priority' => $row['priority']
      ));

      return $task;
    }
    return null;
  }

  public function save() {

    $query = DB::connection()->prepare('INSERT INTO Task (name, priority, description, added) VALUES (:name, :priority, :description, NOW()) RETURNING id');

    $query->execute(array('name' => $this->name, 'description' => $this->description, 'priority' => $this->priority));

    $row = $query->fetch();

    $this->id = $row['id'];
  }

}
