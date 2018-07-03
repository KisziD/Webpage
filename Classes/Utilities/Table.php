<?php
namespace Utilities\Table;

require_once $_SERVER['DOCUMENT_ROOT'] . "/Interfaces/TableInterface.php";

abstract class Table implements \Interfaces\Table\TableInterface
{
    protected static $filename = "";
    private $colname = "";
    private $virtual_table = [];

    public static function getFileUrl(){
        return $_SERVER['DOCUMENT_ROOT'].static::$filename;
    }

    /**
     * @return TableInterface[]
     */
    public static function all()
    {
        $virtual_table = explode("\n",file_get_contents(static::getFileUrl()));
        //letrehozol egy B tömböt
        $head = explode("|", $virtual_table[0]);
        unset($virtual_table[0]);
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
        foreach ($all as $key=> $cucc) {
            var_dump($col);
            var_dump($cucc);
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
        $keys=[];
        $keys[]=static::findAll($col, $val);
        foreach($keys as $unsetkey){
            unset($virtual_table[$key]);
        }
    }

    /**
     * @param $data mixed[] ilyen formában ["VIN" => "asd", "model" => "asd"] nem sorrendben
     * @return void
     */
    public static function insert($data)
    {

    }

    /**
     * @param $data mixed[] ilyen formában ["VIN" => "asd", "model" => "asd"] sorrendben!
     * @return void
     */
    public function __construct($data)
    {
        foreach($data as $key =>$val){
        $this->$key = $val;
        }
    }

}
class Todo extends Table{
    protected static $filename="/API/todo.txt";
}


class Car extends Table {
    protected static $filename= "/Resources/Tables/Cars.txt";
}


foreach(Car::findAll("model", "focus") as $kocsi){
    echo $kocsi->licence_plate." ";
    echo $kocsi->manufacturer." ";
    echo $kocsi->model." ";
    echo $kocsi->year."</br>";
}
foreach (Todo::findAll("todo_name", "asd") as $kocsi) {
        echo $kocsi->todo_name."</br>";
}