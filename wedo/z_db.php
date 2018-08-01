<?php

$con = new mysqli("localhost", "cmpcintl_nash", "74F2JrXehV5P", "cmpcintl_xzel");

if ($con->connect_errno) {

    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}

?>