<?php

include_once ("z_db.php");


header( "refresh:3;url=users2.php" );

// Inialize session

session_start();

// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['adminidusername'])) {

        print "

				<script language='javascript'>

					window.location = 'index.php';

				</script>

			";

			

}


$value1 = mysqli_real_escape_string($con,isset($_POST['package']));

$qu="SELECT * FROM  packages where id = $value1"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$pckid="$r[id]";

	$pckname="$r[name]";

	$pckprice="$r[price]";
	
	$pckqty="$r[tax]";

	$pckcur="$r[currency]";

	$pcksbonus="$r[sbonus]";
	
	$total= $pckprice*$pckqty;

  }
 


$uname=mysqli_real_escape_string($con,$_POST['username']);
$orno=mysqli_real_escape_string($con,$_POST['orno']);
$doj=mysqli_real_escape_string($con,$_POST['doj']);

	

$date1 = date("m/d/Y", strtotime($doj));
$date2 = '12/31/2099';
$Total = $total * (30/100);

$ORno = $orno;


function returnDates($fromdate, $todate) {

    $fromdate = \DateTime::createFromFormat('m/d/Y', $fromdate);

    $todate = \DateTime::createFromFormat('m/d/Y', $todate);

    return new \DatePeriod(

        $fromdate->modify('+15 day'),

        new \DateInterval('P15D'),

        $todate->modify('+15 day')

    );

}



$datePeriod = returnDates($date1, $date2);


$i = 1;

foreach($datePeriod as $date) {

	$offer=$i++;
    echo $Total,"\n";
	echo $date->format('Y-m-d'),"\n";
	$date2 = $date->format('Y-m-d');
    echo "</br>";
mysqli_query($con,"INSERT into `paymentsclp` (userid,ORno,payment_amount,payment_date,createdtime) VALUES ('$uname','$ORno','$Total','$date2','$doj')");	
	

	if($offer==5) break;

}













//else

//{

//print "<center>Action could not be performed, Something went wrong. Check back again<br/>Redirecting in 2 seconds...</center>";

//}



?>