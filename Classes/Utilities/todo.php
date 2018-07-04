<?php
require_once $_SERVER['DOCUMENT_ROOT']."/Classes/Utilities/Table.php";
use \Utilities\Table\Table;



class Todo extends Table
{

    protected static $filename = "/API/todo.txt";
}