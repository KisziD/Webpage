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

    public static function modify($id, $data)
    {
        $virtual_table = static::all();
        foreach ($virtual_table as $vkey => $v) {
            if ($v["licence_plate"]==$id) {
                   $virtual_table[$vkey]=array_replace($virtual_table[$vkey],$data);
            }
            
        }
        static::savetable($virtual_table);
    }
    public static function delete($id)
    {
        $virtual_table = static::all();
        foreach ($virtual_table as $vkey => $v) {
            if ($v["licence_plate"]==$id) {
                  unset( $virtual_table[$vkey]);
            }
            
        }
        static::savetable($virtual_table);
    }

}
