<?php
include_once("../z_db.php");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$sql = "SELECT a.username, c.ID, c.parentID FROM affiliateuser a RIGHT JOIN chart c on c.ID = a.charts_id";

$result = $con->query($sql);

$data = array();


//$i = array();
//array_push($i, 2);


if ($result->num_rows > 0) {
    // output data of each row



    while ($row = $result->fetch_assoc()) {
        $item = array(
            "id" => $row['ID'],
            "parentId" => $row['parentID'],
            "Name" => $row['username'] !== null? $row['username'] : "",
        );

        array_push($data, $item);

    }
}

$con->close();




echo json_encode($data);