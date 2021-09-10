<?php
    session_start();

    require_once(__DIR__ . '/app/core/Аutoloader.php');

    Router::init([
        [
            'method' => 'GET',
            'path' => '/',
            'callback' => function(){
                MainController::show();
            }
        ],
        [
            'method' => 'GET',
            'path' => '/task/update/(\d+)',
            'callback' => function($task_id){
                TaskController::updateTaskShow($task_id);
            }
        ],
        [
            'method' => 'POST',
            'path' => '/task',
            'callback' => function(){
                TaskController::createTask();
            }
        ],
        [
            'method' => 'PATCH',
            'path' => '/task/(\d+)',
            'callback' => function($task_id){
                TaskController::updateTask($task_id);
            }
        ],
        [
            'method' => 'DELETE',
            'path' => '/task/(\d+)',
            'callback' => function($task_id){
                TaskController::deleteTask($task_id);
            }
        ],
        [
            'method' => 'GET',
            'path' => '/login',
            'callback' => function(){
                LoginController::show();
            } 
        ],
        [
            'method' => 'POST',
            'path' => '/login',
            'callback' => function(){
                LoginController::login();
            } 
        ],
        [
            'method' => 'POST',
            'path' => '/logout',
            'callback' => function(){
                LoginController::logout();
            } 
        ]
    ]);