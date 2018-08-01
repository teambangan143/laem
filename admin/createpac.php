<?php
header( "refresh:3;url=pacsettings.php" );
session_start(); //starting session
include('z_db.php'); //connection details
$status = "OK"; //initial status
$msg="";
$pname=mysqli_real_escape_string($con,$_POST['pckname']); //fetching details through post method
$pdetail =mysqli_real_escape_string( $con,$_POST['pckdetail']);
$pprice = mysqli_real_escape_string($con,$_POST['pckprice']);
$pcurid = mysqli_real_escape_string($con,$_POST['currency']);
$pckmpay =mysqli_real_escape_string($con, $_POST['pckmpay']);
$pcksbonus = mysqli_real_escape_string($con,$_POST['pcksbonus']);
$pcktax = mysqli_real_escape_string($con,$_POST['pcktax']);
$pcktax1 = mysqli_real_escape_string($con,$_POST['pcktax1']);
$p1 = mysqli_real_escape_string($con,$_POST['lev1']);
$p2 = mysqli_real_escape_string($con,$_POST['lev2']);
$p3 = mysqli_real_escape_string($con,$_POST['lev3']);
$p4 = mysqli_real_escape_string($con,$_POST['lev4']);
$p5 = mysqli_real_escape_string($con,$_POST['lev5']);
$p6 = mysqli_real_escape_string($con,$_POST['lev6']);
$p7 = mysqli_real_escape_string($con,$_POST['lev7']);
$p8 = mysqli_real_escape_string($con,$_POST['lev8']);
$p9 = mysqli_real_escape_string($con,$_POST['lev9']);
$p10 = mysqli_real_escape_string($con,$_POST['lev10']);
$p11 = mysqli_real_escape_string($con,$_POST['lev11']);
$p12 = mysqli_real_escape_string($con,$_POST['lev12']);
$p13 = mysqli_real_escape_string($con,$_POST['lev13']);
$p14 = mysqli_real_escape_string($con,$_POST['lev14']);
$p15 = mysqli_real_escape_string($con,$_POST['lev15']);
$p1pts = mysqli_real_escape_string($con,$_POST['lev1pts']);
$p2pts = mysqli_real_escape_string($con,$_POST['lev2pts']);
$p3pts = mysqli_real_escape_string($con,$_POST['lev3pts']);
$p4pts = mysqli_real_escape_string($con,$_POST['lev4pts']);
$p5pts = mysqli_real_escape_string($con,$_POST['lev5pts']);
$p6pts = mysqli_real_escape_string($con,$_POST['lev6pts']);
$p7pts = mysqli_real_escape_string($con,$_POST['lev7pts']);
$p8pts = mysqli_real_escape_string($con,$_POST['lev8pts']);
$p9pts = mysqli_real_escape_string($con,$_POST['lev9pts']);
$p10pts = mysqli_real_escape_string($con,$_POST['lev10pts']);
$p11pts = mysqli_real_escape_string($con,$_POST['lev11pts']);
$p12pts = mysqli_real_escape_string($con,$_POST['lev12pts']);
$p13pts = mysqli_real_escape_string($con,$_POST['lev13pts']);
$p14pts = mysqli_real_escape_string($con,$_POST['lev14pts']);
$p15pts = mysqli_real_escape_string($con,$_POST['lev15pts']);
$gateway = 0;
$renewdays = mysqli_real_escape_string($con,$_POST['renewdays']);


if ( strlen($pname) < 2 ){
$msg=$msg."Package Name Should Have Minimum 2 Characters.<BR>";
$status= "NOTOK";}

if ( strlen($pdetail) < 4 ){ //checking if body is greater then 4 or not
$msg=$msg."Package details must contain more than 4 char length.<BR>";
$status= "NOTOK";}

if($status=="OK")
{
$res1=mysqli_query($con,"INSERT INTO packages (name,price,currency,details,tax,tax1,mpay,sbonus,cdate,active,level1,level2,level3,level4,level5,level6,level7,level8,level9,level10,level11,level12,level13,level14,level15,level1pts,level2pts,level3pts,level4pts,level5pts,level6pts,level7pts,level8pts,level9pts,level10pts,level11pts,level12pts,level13pts,level14pts,level15pts,gateway,validity) VALUES ('$pname', '$pprice', '$pcurid', '$pdetail','$pcktax','$pcktax1', '$pckmpay', '$pcksbonus', NOW(), 1, '$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9','$p10','$p11','$p12','$p13','$p14','$p15','$p1pts','$p2pts','$p3pts','$p4pts','$p5pts','$p6pts','$p7pts','$p8pts','$p9pts','$p10pts','$p11pts','$p12pts','$p13pts','$p14pts','$p15pts','$gateway','$renewdays')");

if($res1)
{
print "Package Created...!!! Redirecting...";
}
else
{
print "error!!!! try again later or ask for help from your administrator!!!! Redirecting...";
}


} 
else {
        
echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>"; //printing errors
	 
}

?>
