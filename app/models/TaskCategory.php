<?php
class TaskCategory extends BaseModel{
  public $task_id, $category_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function findCategoriesByTaskId($task_id) {
    $query = DB::connection()->prepare('SELECT Category.name FROM Taskcategory, Category WHERE  Taskcategory.task_id = :task_id
  AND Taskcategory.category_id = Category.id');

     $query->execute(array('task_id' => $task_id));
     $row = $query->fetch();
     return $row['name'];
  }

  public function save() {
    $query = DB::connection()->prepare('INSERT INTO TaskCategory (task_id, category_id) VALUES (:task_id, :category_id)');

    $query->execute(array('task_id' => $this->task_id, 'category_id' => $this->category_id));

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
