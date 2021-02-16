<?php

use Illuminate\Database\Capsule\Manager;

$capsule = new Manager;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'db',
    'database'  => 'phpcrud',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

/*  
 // Create connection
$conn = new mysqli("db", "root","root","phpcrud");

$DB_TYPE = 'mysql'; //Type of database<br>
$DB_HOST = 'db'; //Host name<br>
$DB_USER = 'root'; //Host Username<br>
$DB_PASS = 'root'; //Host Password<br>
$DB_NAME = 'phpcrud'; //Database name<br><br>

#$dbh = new PDO("$DB_TYPE:host=$DB_HOST; dbname=$DB_NAME;", $DB_USER, $DB_PASS); // PDO Connection


 if (!$conn) {
    die('Não foi possível conectar: ' . mysql_error());
}
  echo "<pre>";
 var_dump($conn);
echo "</pre>";

$result = $conn->query("SELECT * FROM users");
 
while ($row = $result->fetch_row()) {
        var_dump($row);
    }
 */