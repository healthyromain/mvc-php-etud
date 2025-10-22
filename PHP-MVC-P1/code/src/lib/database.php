<?php
namespace Application\Lib;

class DatabaseConnection
{
    /** @var \PDO|null */
    public $database = null;

    public function getConnection()
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'mdp');
            $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->database;
    }
}
