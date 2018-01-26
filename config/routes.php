<?php

  $routes->get('/', function() {
    HelloWorldController::index();
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
