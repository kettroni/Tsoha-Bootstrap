<?php

class TasklistController extends BaseController {

  public static function index() {
    if (isset($_SESSION['account'])) {
      $tasklists = Tasklist::all();
      View::make('tasklist/index.html', array('tasklists' => $tasklists));
    } else {
      View::make('/account/login.html');
    }
  }

  public static function create() {
    View::make('tasklist/new.html');
  }

  public static function store(){
      $params = $_POST;
      $attributes = array(
        'name' => $params['name'],
        'account_id' => $params['account_id']
      );
      $tasklist = new Tasklist($attributes);

      $errors = $tasklist->errors();
      if(count($errors) == 0){
        $tasklist->save();

        Redirect::to('/tasklist/' . $tasklist->id, array('message' => 'Tallennettu!'));
      }else{
        View::make('tasklist/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function update($id){
      $params = $_POST;
      $attributes = array(
        'id' => $id,
        'name' => $params['name'],
        'account_id' => $params['account_id']
      );

      $tasklist = new Tasklist($attributes);
      $errors = $tasklist->errors();

      if(count($errors) > 0){
        View::make('tasklist/edit.html', array('errors' => $errors, 'tasklist' => $attributes));
      }else{
        $tasklist->update($id);

        Redirect::to('/tasklist/' . $id, array('message' => 'Muistilistaa muokattu onnistuneesti'));
      }
    }

    public static function edit($id){
      $tasklist = Tasklist::find($id);
      View::make('tasklist/edit.html', array('tasklist' => $tasklist));
    }

    public static function destroy($id){
      $tasklist = Tasklist::find($id);
      $tasklist->destroy($id);
      Redirect::to('/tasklist', array('message' => 'Poistettu onnistuneesti!'));
    }

}
