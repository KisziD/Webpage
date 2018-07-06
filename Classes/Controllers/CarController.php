<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Controllers/Controller.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Utilities/Car.php";
class CarController implements Controller
{
    public function show()
    {
        
        $cars= Car::getAll();
        unset($cars[0]);
        if (isset($_SESSION["message"])){$message=explode("|||",$_SESSION["message"]);}else{$message=[];}
        $page = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Tables/form.php";
        //$page=$_SERVER['DOCUMENT_ROOT']."/Classes/Controllers/CarController.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/View/Layouts/Main_view.php";
        
        unset($_SESSION["message"]);
    }
    public function create($a)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/Classes/Utilities/Validator.php";

        $v = new Validator([
            "manufacturer" => "alpha",
            "model" => "alnum",
            "year" => "num",
            "VIN" => "if strlen({x}) == 17 ",
        ], $a);

        if ($v->isValid() == true) {
            Car::insert([
                "manufacturer" => $a["manufacturer"],
                "model" => $a["model"],
                "year" => $a["year"],
                "VIN" => $a["VIN"],
            ]);
            
        } else{
            $m=$v->getMessages();
            $_SESSION["message"]=implode("|||",$m);
        }
        
        header("location: Router.php?page=Cars");

    }
    public function mod($id, $a)
    { 
        $c=Car::find("licence_plate", $id);
        
        Car::modify($id, $a);
        $page = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Tables/Carmod.php";
        //$page=$_SERVER['DOCUMENT_ROOT']."/Classes/Controllers/CarController.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/View/Layouts/Main_view.php";
        
    }
    public function del($id)
    {
        Car::delete($id);
    }
}
