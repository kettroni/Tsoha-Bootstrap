<?php

  $routes->get('/', function() {
    TaskController::index();
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

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/note_list', function() {
  HelloWorldController::note_list();
  });

  $routes->get('/note_edit', function() {
    HelloWorldController::note_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/account_lists', function() {
    HelloWorldController::account_lists();
  });
