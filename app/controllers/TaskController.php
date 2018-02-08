<?php

class TaskController extends BaseController {

  public static function index() {
    $tasks = Task::all();

    View::make('task/index.html', array('tasks' => $tasks));
  }

  public static function show($id) {
    $task = Task::find($id);
    View::make('task/show.html', array('task' => $task));
  }

  public static function create() {
    View::make('task/new.html');
  }

  public static function store(){
      $params = $_POST;
      $attributes = array(
        'name' => $params['name'],
        'description' => $params['description'],
        'priority' => $params['priority']
      );
      $task = new Task($attributes);

      $errors = $task->errors();
      if(count($errors) == 0){
        $task->save();

        Redirect::to('/task/' . $task->id, array('message' => 'Tallennettu!'));
      }else{
        View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function update($id){
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

        Redirect::to('/task/' . $id, array('message' => 'Tapahtumaa muokattu onnistuneesti'));
      }
    }

    public static function edit($id){
      $task = Task::find($id);
      View::make('task/edit.html', array('task' => $task));
    }

    public static function destroy($id){
      $task = Task::find($id);
      $task->destroy($id);
      Redirect::to('/task', array('message' => 'Poistettu onnistuneesti!'));
    }

}
