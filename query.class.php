<?php
// Query 0.1
// MySQLi Query object for PHP

// Not copyrighted, Alan Hardman, 2013
// Licensed under WTFPL, the full text is available at http://www.wtfpl.net/txt/copying
// If you use it, I'd love to know, but srsly do whatever with this.  Took me far longer to write the README than the class itself.

class Query {

    public $sql = '';
    public $use_result = false;
    public $conn = null;
    public $query = null;

    // Set all class variables and run the query if $exec is true
    public function __construct($conn, $sql, $use_result = false, $exec = true) {
        $this->conn = $conn;
        $this->sql = $sql;
        $this->use_result = $use_result;
        if($exec) {
            $this->exec();
		}
    }
    
    // Free the result on destruct if $use_result is true
    public function __destruct() {
        $this->freeResult();
    }
    
    // PHP 4 compatibility (still requires MySQLi)
    public function Query($conn, $sql, $use_result = false, $exec = true) {
        if(version_compare(PHP_VERSION,"5.0.0","<")) {
            $this->__construct($conn, $sql, $use_result = false, $exec = true)
            register_shutdown_function(array($this,'__destruct'));
        } else {
            trigger_error('Do not call Query->Query directly, instead create a new instance using "new Query".',E_USER_NOTICE);
        }
    }
    
    // Connect to a server
    public static function connect($host='localhost', $user='root', $pass='', $database='') {
        return mysqli_connect($host,$user,$pass,$database);
    }
    
    // Run query
    public function exec() {
        if($this->query === null) {
            $this->query = mysqli_query($this->conn,$this->sql,$this->use_result);
            $this->rows = mysqli_num_rows($this->query);
        }
    }

    // Result array
    public function fetch() {
        return mysqli_fetch_assoc($this->query);
    }

    // Result array with multiple rows
    public function fetchAll() {
        $a = array();
        while(($row = mysqli_fetch_assoc($this->query)) !== false)
            $a[] = $row;
        return $a;
    }
    
    // Free result
    public function freeResult() {
        if($this->use_result)
            mysqli_free_result($this->query);
    }

}
?>