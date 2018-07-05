<?php

class NotFoundException extends Exception
{}

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

class DB
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

    public function insert($data)
    {
        $lastRow = $this->virtual_table[count($this->virtual_table) - 1];
        $lasRowID = $lastRow->get("id");
        $nextRowID = $lasRowID + 1;
        $data['id'] = $nextRowID;

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
        // lekĂŠri az utolĂłs ID -t
        // beleteszi a tĂĄblĂĄba virtuĂĄlisan
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

        //a virtuĂĄlis tĂĄblĂĄt beleĂ­rja a fĂĄjlba
    }

    public $found = null;
    public function find($id)
    {

        foreach ($this->virtual_table as $row) {
            if ($row->get("id") == $id) {
                $this->found = $row;
            }
        }
        if ($this->found == null) {
            throw new NotFoundException("Nem létezik a keresett sor.");
        } else {
            return $this;
        }
    }

    // megkeresi a virtuĂĄlis tĂĄblĂĄban az id-t, ĂŠs visszaadja azt a sort

    public function delete()
    {
        foreach ($this->virtual_table as $key => $row) {
            if ($this->found->get("id") == $row->get("id")) {
                unset($this->virtual_table[$key]);
            }
        }
        $this->save();
    }

    public function getRows()
    {
        return $this->virtual_table;
    }
}

class User extends DB
{
    public function __construct()
    {
        parent::__construct("users.txt");
    }
}

class UserController
{
    public function show()
    {
        $data = new User();
        include "show_users.php";
    }
    public function create($a)
    {
        $name = $this->test_input($a["name"]);
        $email = $this->test_input($a["email"]);
        $db = new User();
        $db->insert([
            "user_name" => $name,
            "user_email" => $email,
        ]);
        $db->save();
        header("location: debug.php");
    }
    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

class Route
{
    public function get($func)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") 
        $func();
    }

    public function post($func)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        $func();
    }
}
//$db = new DB("users.txt");
//$db->insert([
//   "user_name" => "dave",
// "user_email" => "valami@a.hu",
//]);
//$db->save();

/*$db = new DB("users.txt");

foreach ($db->getRows() as $row) {
echo $row->get("user_name") . "<br>";}

try {
$db = new DB("users.txt");
$db->find(123)->delete();
} catch (NotFoundException $e) {
echo "<b>Nem</b> létezik a keresett sor.";
} catch (Exception $e) {
echo "nem tudom mi történt";
}

$db = new User();
$db->insert([
"user_name" => "dave",
"user_email" => "valami@a.hu",
]);
$db->save();*/

Route::get(function () {
    $c = new UserController();
    $c->show();
});
Route::post(function () {
    $c = new UserController();
    $c->create($_POST);
});
