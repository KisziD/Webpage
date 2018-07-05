<?php

class DB
{
    private $filename;
    public function __construct($f)
    {
        $this->filename = $f;
    }
    private $file_path;
    private $file;
    public $key;
    public $array;
    public function find($d)
    {
        $data = $d;
        $file_path = "users\\" . $this->filename;
        $array = file($file_path);
        $key = array_search($data, $array);
        return $array[$key];
    }
    public function insert($d)
    {

        $data = $d;
        $id=$id+1;
        
        //var_dump($data);
        $data = $id."|".implode("|", $data);
        $file_path = "users\\" . $this->filename;
        $file = fopen($file_path, "a");

        fwrite($file, "\n");
        fwrite($file, $data);

        fclose($file);
    }
    public function delete($k)
    {
        $file_path = "users\\" . $this->filename;
        $contents = file_get_contents($file_path);
        var_dump($contents);
        $contents = str_replace($array[$key], '', $contents);
        file_put_contents($file_path, $contents);

    }
    public function update($d)
    {
        $this->data = $d;
        $file_path = "users\\" . $this->filename;
        $contents = file_get_contents($file_path);
        $contents = str_replace($array[$key], $data, $contents);
        file_put_contents($file_path, $contents);
    }
}

//torles
$db = new DB("users.txt");

//hozzadas
$db = new DB("users.txt");
$db->insert([
    
    "user_name" => "valaki",
    "user_email" => "valaki@gmail.com",
]);
$db->save();

//szerkesztes

$db = new DB("users.txt");
$db->find(123)->update([
    "user_email" => "valakimas@gmail.com",
]);
$db->save();

//listázás

$db = new DB("users.txt");
foreach($db->getRows() as $row){
echo $row['user_name']. " | ". $row['user_email'];
}
