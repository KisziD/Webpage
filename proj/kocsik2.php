<?php
class AlreadyThereException extends Exception
{}
class NotValidException extends Exception
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
            throw new NotFoundException("Nem létezik a keresett sor.");
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

    public function isValid($a, $data)
    {
        if ($a == "manufacturer") {
            if ($data["manufacturer"] != "" && ctype_alpha($data["manufacturer"]) == true) {
                return true;
            } else {
                return false;
            }
        } elseif ($a == "model") {
            if ($data["model"] != "" && ctype_alnum($data["model"]) == true) {
                return true;
            } else {
                return false;
            }
        } elseif ($a == "year") {

            if (1913 <= $data["year"] && $data["year"] <= date("Y")) {
                return true;
            } else {
                return false;
            }
        } elseif ($a == "VIN") {
            if (strlen($data["VIN"]) == 17) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insert($data)
    {
        $count = 0;
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

class Validator
{
    private $valid = true;
    private $messages = [];
    public function __construct($pattern, $inputs)
    {
        foreach ($pattern as $key => $rules) {
            foreach (explode("|", $rules) as $rule) {
                if (!$this->activateRule(trim($rule), $inputs[$key])) {
                    $this->messages[] = "Rule: $rule failed for '$key'";
                    $this->valid = false;
                }
            }
        }
    }

    public function isValid()
    {
        return $this->valid;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    private function activateRule($rule, $string)
    {
        if ($rule == "alpha") {
            return $this->ruleAlpha($string);
        } elseif ($rule == "alnum") {
            return $this->ruleAlnum($string);
        } elseif ($rule == "num") {
            return $this->ruleNum($string);
        } elseif (strpos($rule, "if") !== false) {
            return $this->ruleIf(str_replace("{x}", "'$string'", $rule));
        }
    }

    private function ruleAlpha($string)
    {
        return ctype_alpha($string);
    }
    private function ruleAlnum($string)
    {
        return ctype_alnum($string);
    }
    private function ruleNum($string)
    {
        return is_numeric($string);
    }
    private function ruleIf($string)
    {
        $if = str_replace("if", "", $string);
        $ret = false;
        eval('
        $ret = (' . $if . ');
        ');
        return $ret;
    }
}

class CarController
{
    public function show()
    {
        $data = new Car("Cars.txt");
        include "form.html";
    }
    public function create($a)
    {

        $db = new Car("Cars.txt");
        $db->insert([
            "manufacturer" => $a["manufacturer"],
            "model" => $a["model"],
            "year" => $a["year"],
            "VIN" => $a["VIN"],
        ]);
        $db->save();
        header("location: page.php?page=kocsik2");
    }
}

class Route
{
    public function get($func)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $func();
        }

    }

    public function post($func)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $func();
        }

    }
} /*try {
try {
$a = new Car("Cars.txt");
$a->insert([
"manufacturer" => "ford",
"model" => "galaxy",
"year" => "2005",
"VIN" => "2FVXFXYB7TA804207",
]);
$a->save();
} catch (NotValidException $e) {
echo "<h2>The given car information is not valid, check the input and try again.</h2>";
}
} catch (AlreadyThereException $e) {
echo "<h2>The given car already exists in the database</h2>";
}*/
$a = new Car("Cars.txt");
Route::get(function () {
    $c = new CarController();
    $c->show();
});

Route::post(function () {
    $c = new CarController();
    $c->create($_POST);
});
