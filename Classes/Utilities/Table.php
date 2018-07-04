<?php
namespace Utilities\Table;

require_once $_SERVER['DOCUMENT_ROOT'] . "/Interfaces/TableInterface.php";

abstract class Table implements \Interfaces\Table\TableInterface
{
    protected static $filename = "";
    private $colname = "";
    private $virtual_table = [];

    public static function getFileUrl()
    {
        return $_SERVER['DOCUMENT_ROOT'] . static::$filename;
    }
    public static function getAll()
    {
        
    }

    /**
     * @return TableInterface[]
     */
    private static function all()
    {
        $virtual_table = explode("\n", file_get_contents(static::getFileUrl()));
        foreach ($virtual_table as $key => $vt) {
            $virtual_table[$key] = trim($vt);
        }
        //letrehozol egy B tömböt
        $head = explode("|", $virtual_table[0]);

        $output = [];


        foreach ($virtual_table as $row) {
            $row = explode("|", $row);
            //letrehozol egy A tömböt

            $element = [];
            foreach ($head as $key => $headelement) {
                $element[$headelement] = $row[$key];
            }
            $output[] = $element;

            //beleteszed az A-t a B-be

        }
        return $output;
    }

    /**
     * @param $col string Az oszlop neve
     * @param $val string A cella értéke
     * @throws NotFoundException
     * @return TableInterface
     */
    public static function find($col, $val)
    {
        foreach (static::all() as $key => $cucc) {
            if ($cucc[$col] == $val) {
                return new static($cucc);
            }

        }
    }

    /**
     * @param $col string Az oszlop neve
     * @param $val string A cella értéke
     * @return TableInterface[]
     */
    public static function findAll($col, $val)
    {
        $found = [];
        $all = static::all();
        foreach ($all as $cucc) {
            if ($cucc[$col] == $val) {
                $found[] = new static($cucc);
            }

        }
        return $found;
    }
    /**
     * @param $col string Az oszlop neve
     * @param $val string A cella értéke
     * @return void
     */
    public function delete()
    {

    }
    /**
     * @param $col string Az oszlop neve
     * @param $val string A cella értéke
     * @return void
     */
    public static function deleteAll($col, $val)
    {
        $keys = [];
        $keys[] = static::findAll($col, $val);
        foreach ($keys as $unsetkey) {
            unset($virtual_table[$key]);
        }
    }

    /**
     * @param $data mixed[] ilyen formában ["VIN" => "asd", "model" => "asd"] nem sorrendben
     * @return void
     */
    public static function insert($data)
    {
        $file = static::getFileUrl();
        $virtual_table = static::all();
        $head=$virtual_table[0];
        var_dump($head);
        $newrow=[];
        foreach($head as $h){
            foreach($data as $key=> $d){
                if ($key==$h){
                    $newrow[$key]=$d;
                    var_dump($newrow);
                }
            }
        }
        $virtual_table[] = $newrow;
        foreach ($virtual_table as $key => $v) {
                $virtual_table[$key] = implode("|", $v);
        }

        file_put_contents($file, implode("\n", $virtual_table));
    }

    /**
     * @param $data mixed[] ilyen formában ["VIN" => "asd", "model" => "asd"] sorrendben!
     * @return void
     */
    public function __construct($data)
    {
        foreach ($data as $key => $val) {
            $this->$key = $val;
        }
    }

}
class Todo extends Table
{
    protected static $filename = "/API/todo.txt";
}

class Car extends Table
{
    protected static $filename = "/Resources/Tables/Cars.txt";
}
Car::insert(["manufacturer" => "asd","licence_plate"=>"aaa:204","model"=>"focus","year"=>"2010","VIN"=>"12345678901234567"]);
foreach (Car::findAll("model", "focus") as $kocsi) {
    echo $kocsi->licence_plate . " ";
    echo $kocsi->manufacturer . " ";
    echo $kocsi->model . " ";
    echo $kocsi->year . "</br>";
}
Todo::insert(["todoname"=>"defdef"]);
foreach (Todo::findAll("todoname", "defdef") as $kocsi) {
    echo $kocsi->todoname . "</br>";
}
