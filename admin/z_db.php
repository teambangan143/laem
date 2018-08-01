<?php

date_default_timezone_set("Asia/Manila");

$con = new mysqli("localhost", "laemnet_temp", "@Fwl5*X-{I][", "laemnet_temp");

if ($con->connect_errno) {

    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}

?>