<?php
session_start();
class AlreadyThereException extends Exception
{}

class Car
{

    private $virtual_table = [];
    private $head;
    private $fn;

    public function __construct($filename)
    {
        $this->fn = $filename;
        $rows = explode("\n", file_get_contents($filename));
        foreach ($rows as $key => $row) {
            if (empty($row)) {
                continue;
            }

            if ($key == 0) {
                $this->head = new HeadRow($row);
            } else {
                $this->virtual_table[] = new DataRow($row, $this->head);
            }

        }
    }

    public function delete()
    {
        foreach ($this->virtual_table as $key => $row) {
            if ($this->found->get("VIN") == $row->get("VIN")) {
                unset($this->virtual_table[$key]);
            }
        }
        $this->save();
    }

    public function find($id)
    {

        foreach ($this->virtual_table as $row) {
            if ($row->get("VIN") == $id) {
                $this->found = $row;
            }
        }
        if ($this->found == null) {
        } else {
            return $this;
        }
    }

    public $licence_plate;

    public function getLastRowID()
    {

        $lastRow = $this->virtual_table[count($this->virtual_table) - 1];
        $lastRowID = $lastRow->get("licence_plate");
        return $lastRowID;
    }

    public function getLicencePlate()
    {
        $licence_plate = explode(":", self::getLastRowID());
        if ($licence_plate[1] == "999") {
            $licence_plate[0] = $licence_plate[0] + 1;
            $licence_plate[1] = "111";
        } else {
            $licence_plate[1] = $licence_plate[1] + 1;
        }
        $nextRowID = implode(":", $licence_plate);
        return $nextRowID;

    }

    public function getRows()
    {
        return $this->virtual_table;
    }

    public function getNewData($data)
    {
        $data['licence_plate'] = self::getLicencePlate();
        $data2 = [];
        foreach ($this->head->data as $colName) {
            if (isset($data[$colName])) {
                $data2[] = $data[$colName];
            } else {
                $data2[] = "";
            }
        }

        $newdata = new DataRow(implode("|", $data2), $this->head);

        $this->virtual_table[] = $newdata;
        return $this->virtual_table;
    }

    public function getElements()
    {
        $array = explode("\n", str_replace("|", "\n", file_get_contents($this->fn)));
        return $array;
    }
    public function insert($data)
    {
        $column = "";
        $licence = $this->getLastRowID();
        $file = $this->getRows();
        $elements = $this->getElements();
        $head = ["manufacturer", "model", "year", "VIN"];

        if (array_search($data["VIN"], $elements) !== false) {
            // throw new AlreadyThereException();
        } else {
            $this->getNewData($data);
        }
    }

    public function getVINs()
    {
        $VINs = [];
        //var_dump($this->getRows());
        $rows = $this->getRows();
        foreach ($rows as $row) {
            $currentrow = explode("|", $row);
            $VINs[] = $currentrow[4];
        }
        return $VINs;
    }

    public function save()
    {
        $newfile = "";
        $newfile .= $this->head . "\n";
        foreach ($this->virtual_table as $row) {
            $newfile .= $row . "\n";

        }
        $f = fopen($this->fn, "w");
        fwrite($f, $newfile);
        fclose($f);
    }

}

class Row
{
    public $data;
    public function __construct($rowString)
    {
        $this->data = explode("|", $rowString);
    }

    protected function getNth($key)
    {
        return $this->data[$key];
    }

    public function __toString()
    {
        return implode("|", $this->data);
    }

}

class HeadRow extends Row
{
    public function whichCol($givenColName)
    {
        foreach ($this->data as $key => $colName) {
            if ($colName == $givenColName) {
                return $key;
            }

        }
    }
}

class DataRow extends Row
{
    private $head;
    public function __construct($rowString, $head)
    {
        $this->head = $head;
        parent::__construct($rowString);
    }

    public function get($col)
    {
        $key = $this->head->whichCol($col);
        return $this->data[$key];
    }

}
