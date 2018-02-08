<?php

  $routes->get('/', function() {
    TaskController::index();
  });

  $routes->post('/logout', function() {
    $params = $_POST;
    Kint::dump($params['id']);


    BaseController::log_out($params['id']);
  });

  $routes->get('/login', function(){
    AccountController::login();
  });

  $routes->post('/login', function(){
    AccountController::handle_login();
  });

  $routes->get('/task', function(){
    TaskController::index();
  });

  $routes->post('/task', function(){
    TaskController::store();
  });

  $routes->get('/task/new', function(){
    TaskController::create();
  });

  $routes->get('/task/:id', function($id){
    TaskController::show($id);
  });

  $routes->get('/task/:id/edit', function($id){
    TaskController::edit($id);
  });

  $routes->post('/task/:id/edit', function($id){
    TaskController::update($id);
  });

  $routes->post('/task/:id/destroy', function($id){
    TaskController::destroy($id);
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/note_list', function() {
  HelloWorldController::note_list();
  });

  $routes->get('/note_edit', function() {
    HelloWorldController::note_edit();
  });

  $routes->get('/account_lists', function() {
    HelloWorldController::account_lists();
  });
