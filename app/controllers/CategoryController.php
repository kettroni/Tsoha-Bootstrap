<?php

class CategoryController extends BaseController {

  public static function index() {
    $categories = Category::all();

    View::make('category/index.html', array('categories' => $categories));
  }

  public static function create() {
    View::make('category/new.html');
  }

  public static function store(){
      $params = $_POST;
      $attributes = array(
        'name' => $params['name']
      );
      $category = new Category($attributes);

      $errors = $category->errors();
      if(count($errors) == 0){
        $category->save();

        Redirect::to('/category/' . $category->id, array('message' => 'Tallennettu!'));
      }else{
        View::make('category/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function destroy($id){
      $category = Category::find($id);
      $category->destroy($id);
      Redirect::to('/category', array('message' => 'Poistettu onnistuneesti!'));
    }

}
