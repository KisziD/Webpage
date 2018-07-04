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
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/TodoController.php";
    $a = new TodoController();
    $a->show();
});

Route::post("todo", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/TodoController.php";
    $a = new TodoController();
    $a->create($_POST);
});
