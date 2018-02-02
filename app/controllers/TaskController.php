<?php

class TaskController extends BaseController {

  public static function index() {
    $tasks = Task::all();

    View::make('task/index.html', array('tasks' => $tasks));
  }

  public static function show($id) {
    $task = Task::find($id);
    Kint::dump($task);
    View::make('task/show.html', array('task' => $task));
  }

  public static function create() {
    View::make('task/new.html');
  }

  public static function store(){
      $params = $_POST;
      $task = new Task(array(
        'name' => $params['name'],
        'description' => $params['description'],
        'priority' => $params['priority']
      ));

      $task->save();

      Redirect::to('/task/' . $task->id, array('message' => 'Tallennettu!'));
    }
}
