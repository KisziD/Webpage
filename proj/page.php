<?php

class Page
{
    public function __construct($page)
    {

        $requested_page = $page.".php";

        include "view.php";
    }
}

$a=new Page($_GET['page']);
