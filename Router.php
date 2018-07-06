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
Route::get("todomodify", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/TodoController.php";
    $a = new TodoController();
    $a->mod($_GET["id"], $_POST);
});
Route::post("todomodify", function () { 
    unset($_POST["submit"]);
    if($_POST["todoname"]==""){
        unset($_POST["todoname"]);
    }
    if($_POST["finished"]=="on"){
        $_POST["finished"]=1;
    }else{
        $_POST["finished"]=0 ;
    }
      header("location: Router.php?page=todo");
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/TodoController.php";
    $a = new TodoController();
    $a->mod($_GET["id"], $_POST);
 
});

Route::get("help", function (){
    $page = $_SERVER['DOCUMENT_ROOT'] . "/View/Layouts/Help.php";
    //$page=$_SERVER['DOCUMENT_ROOT']."/Classes/Controllers/CarController.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/View/Layouts/Main_view.php";

});

Route::get("carmodify", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/CarController.php";
    $c=Car::find("licence_plate", $_GET["id"]);
    $a = new CarController();
    $a->mod($_GET["id"], $_POST);
});
Route::post("carmodify", function () { 
    unset($_POST["submit"]);
    if($_POST["manufacturer"]==""){
        unset($_POST["manufacturer"]);
    }
    if($_POST["model"]==""){
        unset($_POST["model"]);
    }
    if($_POST["year"]==""){
        unset($_POST["year"]);
    }
    if($_POST["VIN"]==""){
        unset($_POST["VIN"]);
    }
 
      header("location: Router.php?page=Cars");
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/CarController.php";
    $a = new CarController();
    $a->mod($_GET["id"], $_POST);
 
});

Route::get("cardelete", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/CarController.php";
    $a = new CarController();
    $a->del($_GET["id"]);
    header("location: Router.php?page=Cars");
});
Route::get("tododelete", function () {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/TodoController.php";
    $a = new TodoController();
    $a->del($_GET["id"]);
    header("location: Router.php?page=todo");
});