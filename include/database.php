<?php
/**
 * Created by PhpStorm.
 * User: marcus
 * Date: 2015-08-10
 * Time: 14:59
 */

class database {

    public $connection;

    function __construct() {
        $this->open_connection();
    }

    public function open_connection() {
        $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_TABLE);
        $this->connection->set_charset('utf8');
        if(!$this->connection) {
            die('Databasanslutning misslyckades: ' . $this->connection->connect_error);
        }
    }

    public function close_connection() {
        if(isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function myResult($sql) {
        $result = $this->connection->query($sql);
        return $result;
    }
}

    $database = new database();