<?php

class Todo
{
    public function getTodo(){
        $todolist=file($_SERVER['DOCUMENT_ROOT'] . "/API/todo.txt");
        echo json_encode($todolist);
    }
}