<?php
session_start();
class Route
{
    public static function get($page,$func)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['page']==$page ) {
            $func();
        }

    }

    public static function post($page, $func)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['page']==$page) {
            $func();
        }

    }

}