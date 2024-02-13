<?php
// define variables

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Amber');
define('DB_PASSWORD', 'fencys-qeGvus-zegfo4');
define('DB_NAME', 'Amber');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//check if ok
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// define root directory:
// change accordingly!
$root_folder = 'http://localhost/videovuokramo';

?>