<?php
require_once $_SERVER['DOCUMENT_ROOT']."/Classes/Utilities/Table.php";
use \Utilities\Table\Table;

class Car extends Table
{

    protected static $filename = "/Resources/Tables/Cars.txt";
public static function getLastID()
    {
        $virtual_table = static::all();
        $lastRow = $virtual_table[count($virtual_table) - 1];
        $lastRowID = $lastRow["licence_plate"];
        return $lastRowID;
    }
    protected static function incrementID($id)
    {
        $licence_plate = explode(":", static::getLastID());
        if ($licence_plate[1] == "999") {
            $licence_plate[0] = $licence_plate[0] + 1;
            $licence_plate[1] = "111";
        } else {
            $licence_plate[1] = $licence_plate[1] + 1;
        }
        $nextRowID = implode(":", $licence_plate);
        return $nextRowID;

    }
}
