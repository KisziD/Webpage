<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/Controller.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Utilities/Todo.php";
class TodoController implements Controller
{
    public function show()
    {

        $todos = Todo::getAll();
        unset($todos[0]);
        if (isset($_SESSION["message"])) {$message = explode("|||", $_SESSION["message"]);} else { $message = [];}
        $page = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Tables/todoform.php";
        //$page=$_SERVER['DOCUMENT_ROOT']."/Classes/Controllers/CarController.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/View/Layouts/Main_view.php";

        unset($_SESSION["message"]);
    }
    public function create($a)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Utilities/Validator.php";

        $v = new Validator([
            "todo" => "required",
        ], $a);
        if ($v->isvalid()) {
            Todo::insert([
                "todoname" => $a["todo"],
            ]);} else {
            $m = $v->getMessages();
            $_SESSION["message"] = implode("|||", $m);
        }

        header("location: Router.php?page=todo");

    }
}
