<?php

include_once "libs/iModel.php";
class Model
{
    function __construcut()
    {
        $this->database = new Database();
    }

    function query($query)
    {
        return $this->database->connect()->query($query);
    }

    function prepare($STRING)
    {
        return $this->database->connect()->prepare($STRING);
    }
}
