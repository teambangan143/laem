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



$result1=mysqli_query($con,"UPDATE payments SET payment_status=1 WHERE id=$tomake");

$result2=mysqli_query($con,"UPDATE payments SET release_date=NOW() WHERE id=$tomake");

if ($result1 && $result2)
{
print "<center>Status Updated<br/>Redirecting in 2 seconds...</center>";
}
else
{
print "<center>Action could not be performed, Something went wrong. Check back again<br/>Redirecting in 2 seconds...</center>";
}

?>