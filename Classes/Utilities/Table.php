<?php
namespace Utilities\Table;

require_once $_SERVER['DOCUMENT_ROOT'] . "/Interfaces/TableInterface.php";

class Table implements \Interfaces\Table\TableInterface
{
    private $filename =  "\Resources\Tables\Cars.txt";
    private $colname = "";
    private $virtual_table = [];

    private function getHead()
    {
        $table = file($_SERVER['DOCUMENT_ROOT'] . "/Resources/Tables/Cars.txt");
        $head = $table[0];
        return $head;
    }
    /**
     * @return TableInterface[]
     */
    public static function all()
    {
        $virtual_table = file($_SERVER['DOCUMENT_ROOT'] . "/Resources/Tables/Cars.txt");
        unset($virtual_table[0]);
        //letrehozol egy B tömböt
        $head = explode("|", Table::getHead());
        $output = [];
      
        foreach ($virtual_table as $row) {
            $row = explode("|", $row);
            //letrehozol egy A tömböt
            
              $element=[];
            foreach ($head as $key => $headelement) {
                $element[$headelement] = $row[$key];
            }
            $output[]=$element;
           
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

    }

    /**
     * @param $col string Az oszlop neve
     * @param $val string A cella értéke
     * @return TableInterface[]
     */
    public static function findAll($col, $val)
    {

    }

    /**
     * @param $col string Az oszlop neve
     * @param $val string A cella értéke
     * @return void
     */
    public static function deleteAll($col, $val)
    {

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

    }

}
var_dump(Table::all());

