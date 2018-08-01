<?php
header( "refresh:2;url=payrequest.php" );
include_once ("z_db.php");
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
$tomake= mysqli_real_escape_string($con,$_GET["payid"]);



$q="SELECT * FROM  payments WHERE id=$tomake"; 


 $r123 = mysqli_query($con,$q);



while($ro = mysqli_fetch_array($r123))

{

	

	$prid="$ro[id]";

	$pruid="$ro[userid]";

	$pramount="$ro[payment_amount]";

	$prstatus="$ro[payment_status]";

	$prdate="$ro[createdtime]";

	

	

				  

 $query="SELECT * FROM  affiliateuser where Id=$pruid "; 

 

 

 $result = mysqli_query($con,$query);


while($row = mysqli_fetch_array($result))

{

	

	$id="$row[Id]";

	$username="$row[username]";

	$active="$row[active]";

	$ear="$row[tamount]";

	$getpayment="$row[getpayment]";

	
}
}


$r123=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount+$pramount WHERE Id='$pruid'");
if ($r123)
{
print "<center>Payment Amount Earning Retracked</center>";
}
else
{
print "<center>Action could not be performed, Something went wrong. Check back again<br/>Redirecting in 2 seconds...</center>";
}




$resultdel=mysqli_query($con,"DELETE FROM payments WHERE id='$tomake' and userid='$pruid'");
if ($resultdel)
{
print "<center>Payment Request Deleted<br/>Redirecting in 2 seconds...</center>";
}
else
{
print "<center>Action could not be performed, Something went wrong. Check back again<br/>Redirecting in 2 seconds...</center>";
}

?>