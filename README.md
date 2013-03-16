## Query
#### Simplified object-based MySQL queries in PHP
____
Query requires PHP 5 with the MySQL Improved (MySQLi) Extension, which is included by default in PHP 5.3.0 and later.

### Usage
Include `query.class.php` in any PHP script you want to use it in, using `require_once 'query.class.php';`.

Before running a query, you need an instance of MySQLi with an active database connection.  This can be created using `$conn = mysqli_connect( ... );`, `$conn = new mysqli( ... )`, or directly from Query using `Query::connect( ... )`, which is simply an alias of mysqli_connect.

To run a query, simply create a new instance of the Query class with `$query = new Query($conn, $sql, [[$use_result = false], $exec = true])`.

##### Parameters
* $conn - MySQLi instance with an active MySQLi connection
* $sql - The SQL query to run
* $use_result - Whether to use the result, or store it. (false is default, if set to true, you will need to call `$query->freeResult()` or unset the Query instance before running additional queries)
* $exec - Whether to run the SQL query immediately, or just create the Query instance (true is default, if set to false, you can run the query with `$query->exec()`)

#### Getting Results
Once you've run a query, you can get the results in a few various forms.  If you are just `SELECT`ing a single row, you can get an associative array of it's values with `$query->fetch()`.  If you need multiple rows, use `$query->fetchAll()`.  It's pretty simple.

#### Additional Methods
`connect()` and `freeResult()` are also available in addition to the result methods, and they are described above.

#### Error Handling
Nothing yet, I'll add that to version 0.2.