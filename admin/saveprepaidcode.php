<?php
header( "refresh:1;url=prepaidactivation.php#save" );
session_start(); //starting session
include('z_db.php'); //connection details
$status = "OK"; //initial status
$msg="";
$prepaidcde = mysqli_real_escape_string($con,$_POST['prodcode']);



if ( strlen($prepaidcde) < 10 ){ //checking if body is greater then 4 or not
$msg=$msg."Must contain prepaid code.<BR>";
$status= "NOTOK";}



if($status=="OK")
{
$res1=mysqli_query($con,"INSERT INTO prepaidcodereg (prepaidcode, status) VALUES ('$prepaidcde', 0)");

if($res1)
{
print "Notification Posted...!!!";
}
else
{
print "error!!!! try again later or ask for help from your administrator.";
}


} 
else {
        
echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>"; //printing errors
	 
}

?>
