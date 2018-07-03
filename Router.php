<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Utilities/Route.php";
Route::get("index", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/MainPageController.php";
    $a = new MainPageController();
    $a->show();
});

Route::get("Cars", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/CarController.php";
    $a = new CarController();
    $a->show();
});

Route::post("Cars", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/CarController.php";
    $a = new CarController();
    $a->create($_POST);
});

Route::get("todo", function () {
    $page = $_SERVER['DOCUMENT_ROOT'] . "/Classes/Utilities/todo.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/View/Layouts/Main_view.php";
});
Route::get("get_todo", function () {
    include $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/TodoController.php";
    $a=new Todo();
    $a->getTodo();
});