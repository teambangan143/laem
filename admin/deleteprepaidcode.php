<?php
header( "refresh:1;url=prepaidactivation.php#profile" );
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
$todelete= mysqli_real_escape_string($con,$_GET["codeId"]);

$result=mysqli_query($con,"DELETE FROM prepaidcodereg WHERE codeId='$todelete'");
if ($result)
{
print "<center>Product Code Deleted<br/>Redirecting in 2 seconds...</center>";
}
else
{
print "<center>Action could not be performed, check back again<br/>Redirecting in 2 seconds...</center>";
}

?>