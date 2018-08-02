<?php
include_once("../z_db.php");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$req = (object)$_POST;

$select = "SELECT * FROM affiliateuser WHERE affiliateuser.username = '$req->username'";

$result = $con->query($select);

$resu = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resu = $row['Id'];
    }
}

$query1 = "UPDATE affiliateuser SET charts_id = $req->charts_id WHERE id = $resu ";
$r = $con->query($query1) or die ("Couldn't execute query.");

$con->close();


echo json_encode($resu);