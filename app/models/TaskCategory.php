<?php
class TaskCategory extends BaseModel{
  public $tasklist_id, $category_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public function save() {
    $query = DB::connection()->prepare('INSERT INTO TaskCategory (task_id, category_id) VALUES (:task_id, :category_id)');

    $query->execute(array('task_id' => $task_id, 'category_id' => $category_id));

    $row = $query->fetch();
  }

  public static function destroyByTask($task_id) {
    $query = DB::connection()->prepare('DELETE FROM Taskcategory WHERE task_id = :task_id');
    $query->execute(array('task_id' => $task_id));
  }

  public static function destroyByCategory($category_id) {
    $query = DB::connection()->prepare('DELETE FROM Taskcategory WHERE category_id = :category_id');
    $query->execute(array('category_id' => $category_id));
  }
}
