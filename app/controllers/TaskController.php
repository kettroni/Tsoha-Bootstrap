<?php

class TaskController extends BaseController {

  public static function index($tasklist_id) {
    $tasks = Task::all($tasklist_id);
    $tasklist = Tasklist::find($tasklist_id);

    View::make('task/index.html', array('tasks' => $tasks, 'tasklist' => $tasklist));
  }

  public static function show($tasklist_id, $id) {
    $task = Task::find($id);
    $tasklist = Tasklist::find($tasklist_id);
    View::make('task/show.html', array('task' => $task, 'tasklist' => $tasklist));
  }

  public static function create($tasklist_id) {
    $tasklist = Tasklist::find($tasklist_id);
    View::make('task/new.html', array('tasklist' => $tasklist));
  }

  public static function store($tasklist_id){
      $params = $_POST;
      $attributes = array(
        'name' => $params['name'],
        'tasklist_id' => $tasklist_id,
        'description' => $params['description'],
        'priority' => $params['priority']
      );
      $task = new Task($attributes);

      $errors = $task->errors();
      if(count($errors) == 0){
        $task->save();

        Redirect::to('/' . $tasklist_id . '/task', array('message' => 'Tallennettu!'));
      }else{
        View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function update($tasklist_id, $id){
      $params = $_POST;
      if (!isset ($params['done'])) {
        $params['done'] = 0;
      }
      $attributes = array(
        'id' => $id,
        'name' => $params['name'],
        'done' => $params['done'],
        'description' => $params['description'],
        'added' => $params['added'],
        'priority' => $params['priority']
      );

      $task = new Task($attributes);
      $errors = $task->errors();

      if(count($errors) > 0){
        View::make('task/edit.html', array('errors' => $errors, 'task' => $attributes));
      }else{
        $task->update($id);

        Redirect::to('/' . $tasklist_id .'/task', array('message' => 'Tapahtumaa muokattu onnistuneesti'));
      }
    }

    public static function edit($tasklist_id, $id){
      $task = Task::find($id);
      $tasklist = Tasklist::find($tasklist_id);
      View::make('task/edit.html', array('task' => $task, 'tasklist' => $tasklist));
    }

    public static function destroy($tasklist_id, $id){
      $task = Task::find($id);
      $task->destroy($id);
      Redirect::to('/' . $tasklist_id . '/task', array('message' => 'Poistettu onnistuneesti!'));
    }

}
