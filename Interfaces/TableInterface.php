<?php

namespace Interfaces\Table;

interface TableInterface {
    /**
    * @return TableInterface[]
    */
    public static function getAll();

    /**
    * @param $col string Az oszlop neve
    * @param $val string A cella értéke
    * @throws NotFoundException
    * @return TableInterface
    */
    public static function find($col,$val);

    /**
    * @param $col string Az oszlop neve
    * @param $val string A cella értéke
    * @return TableInterface[] 
    */
    public static function findAll($col,$val);

    /**
    * @param $col string Az oszlop neve
    * @param $val string A cella értéke
    * @return void
    */
    public static function deleteAll($col,$val);

    /**
    * @param $data mixed[] ilyen formában ["VIN" => "asd", "model" => "asd"] nem sorrendben
    * @return void
    */
    public static function insert($data);

    /**
    * @param $data mixed[] ilyen formában ["VIN" => "asd", "model" => "asd"] sorrendben!
    * @return void
    */
    public function __construct($data);

    /**
    * @return void
    */
    public function save();
}

