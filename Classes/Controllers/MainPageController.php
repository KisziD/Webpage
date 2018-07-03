<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/Controller.php";

class MainPageController implements Controller
{
    public function show()
    {
        $page=$_SERVER['DOCUMENT_ROOT']."/index.php";
        include  $_SERVER['DOCUMENT_ROOT']."/View/Layouts/Main_view.php";
    
    }
}