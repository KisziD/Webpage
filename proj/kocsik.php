<?php
class notLicenceException extends Exception
{}
class alreadyThereException extends Exception
{}
class Car
{
    private $virtual_table = [];
    private $filename;
    private $rows = [];
    private $head;
    public function __construct($a)
    {
        $this->filename = $a;
        $this->virtual_table = explode("\n", file_get_contents($this->filename));
        foreach ($this->virtual_table as $key => $row) {
            if ($key == 0) {
                $this->head = $row;
            } else {
                $this->rows[] = $row;
            }
        }
    }

    public function getRows()
    {
        $rows=[];
        $rows=file($this->fn);
        var_dump($rows);
        return $rows;
    }

    public function insert($array)
    {
        $string = implode("|", $array);
        if (array_search($string, $this->virtual_table)) {
            throw new alreadyThereException();
        } else { $this->virtual_table[] = $string;
            //var_dump($virtual_table);
        }
        return $this->virtual_table;
    }

    public function find($data)
    {

        foreach ($this->virtual_table as $key => $row) {
            if (strpos($row, $data) !== false) {
                $kulcs = $key;
            }
        }

        return $kulcs;
    }
    
    public function delete($valami)
    {

        if (strpos($valami, ":") !== false && self::find($valami) !== null) {
            $this->valami = $valami;
            foreach ($this->virtual_table as $key => $row) {

                if (self::find($valami) == $key) {
                    //var_dump($this->virtual_table[$key]);
                    unset($this->virtual_table[$key]);
                }
            }
            $this->save();
        } else {
            throw new notLicenceException();
        }

    }

    public function save()
    {

        $newfile = "";
        //var_dump($this->virtual_table);
        $newfile = implode("\n", $this->virtual_table);
        // var_dump($newfile);
        $file = fopen($this->filename, "w");
        fwrite($file, $newfile);
        fclose($file);
    }

public function show()
{
    $a=new Car("Cars.txt");
    include "show_cars.php";
}
}

try {
    $a = new Car("Cars.txt");
    $a->insert([
        "licence_plate" => "aaa:112",
        "manufacturer" => "ford",
        "model" => "focus",
        "year" => "2000",

    ]);
    $a->save();
} catch (alreadyThereException $e) {
    echo "már fel lett véve ez az autó.";
}
echo "</br>";
try {
    $a->delete("abc:123");
} catch (notLicenceException $e) {
    echo "nem rendszám lett megadva, vagy az autó nem szerepel  listán.";
}
$a=new Car("cars.txt");
$a->show();
$a->getRows();