<?php


  $routes->get('/create_account', function() {
    AccountController::createAccount();
  });

  $routes->post('/create_account', function() {
    AccountController::store();
  });

  $routes->post('/logout', function() {
    $params = $_POST;
    BaseController::log_out($params['id']);
  });

  $routes->get('/login', function(){
    AccountController::login();
  });

  $routes->post('/login', function(){
    AccountController::handle_login();
  });

  $routes->get('/', function() {
    TasklistController::index();
  });

  $routes->get('/:tasklist_id/task', function($tasklist_id){
    TaskController::index($tasklist_id);
  });

  $routes->get('/category', function() {
    CategoryController::index();
  });

  $routes->get('/tasklist', function() {
    TasklistController::index();
  });

  $routes->post('/:tasklist_id/task', function($tasklist_id){
    TaskController::store($tasklist_id);
  });

  $routes->post('/category', function() {
    CategoryController::store();
  });

  $routes->post('/tasklist', function() {
    TasklistController::store();
  });

  $routes->get('/:tasklist_id/task/new', function($tasklist_id){
    TaskController::create($tasklist_id);
  });

  $routes->get('/category/new', function() {
    CategoryController::create();
  });

  $routes->get('/tasklist/new', function() {
    TasklistController::create();
  });

  $routes->get('/:tasklist_id/task/:id', function($tasklist_id, $id){
    TaskController::show($tasklist_id, $id);
  });

  $routes->get('/category/:id', function() {
    CategoryController::index();
  });

  $routes->get('/tasklist/:id', function() {
    TasklistController::index();
  });

  $routes->get('/:tasklist_id/task/:id/edit', function($tasklist_id, $id){
    TaskController::edit($tasklist_id, $id);
  });

  $routes->get('/tasklist/:id/edit', function($id) {
    TasklistController::edit($id);
  });

  $routes->post('/:tasklist_id/task/:id/edit', function($tasklist_id, $id){
    TaskController::update($tasklist_id, $id);
  });

  $routes->post('/tasklist/:id/edit', function($id) {
    TasklistController::update($id);
  });

  $routes->post('/:tasklist_id/task/:id/destroy', function($tasklist_id, $id){
    TaskController::destroy($id);
  });

  $routes->post('/category/:id/destroy', function($id) {
    CategoryController::destroy($id);
  });

  $routes->post('/tasklist/:id/destroy', function($id) {
    TasklistController::destroy($id);
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
