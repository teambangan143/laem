<?php

include_once ("z_db.php");


header( "refresh:1;url=dashboard.php" );

// Inialize session

session_start();

// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['username'])) {

        print "

				<script language='javascript'>

					window.location = 'index.php';

				</script>

			";

			

}





 





$con1 = mysqli_connect("localhost", "cmpcintl_nash", "74F2JrXehV5P", "cmpcintl_xzel");


 $sql="SELECT Id FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_array($result)) {

        $uname="$row[Id]";
		$username="$row[username]";
    }
}



	

$date1 = date('m/d/Y');
$date2 = '12/31/2099';

$amount = 1700;
$share = 850;


function returnDates($fromdate, $todate) {

    $fromdate = \DateTime::createFromFormat('m/d/Y', $fromdate);

    $todate = \DateTime::createFromFormat('m/d/Y', $todate);

    return new \DatePeriod(

        $fromdate->modify('+60 day'),

        new \DateInterval('P60D'),

        $todate->modify('+60 day')

    );

}



$datePeriod = returnDates($date1, $date2);


$i = 1;

foreach($datePeriod as $date) {

	$offer=$i++;
	echo $date->format('Y-m-d'),"\n";
	$date2 = $date->format('Y-m-d');
mysqli_query($con,"INSERT into `affiliateusermaintenance` (memberID,amount,share,releasedate,doj) VALUES ('$uname','$amount','$share','$date2',NOW())");	
	

	if($offer==1) break;
	

}




?>