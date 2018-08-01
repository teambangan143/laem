<?php

header( "refresh:2;url=packageOR.php" );

include_once ("z_db.php");

// Inialize session

session_start();


// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['adminidusername']) && isset($_POST['orno'])) {

        print "

				<script language='javascript'>

					window.location = 'index.php';

				</script>

			";

			

}
?>

<?php
$paymentID= mysqli_real_escape_string($con,$_GET["payid"]);

$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where Id ='$paymentID'"; 

 $r123 = mysqli_query($con,$q);

while($ro = mysqli_fetch_array($r123))

{

	$prid="$ro[Id]";

	$pruid="$ro[memberID]";

	$pramount="$ro[pcktakenID]";

	$prstatus="$ro[payment_status]";

	$prdate="$ro[doj]";
	
	$prdiscount="$ro[discount]";
	
	$prgpay="$ro[getpayment]";
}



$tomake1= $pruid;

$query1="SELECT * FROM  affiliateuser where username='$tomake1'"; 

$ri1 = mysqli_query($con,$query1);

while($li1 = mysqli_fetch_array($ri1))

{

	$ref1="$li1[referedby]";

	}

	

//print "<center>Profile Activated<br/>Redirecting in 2 seconds...</center>";

$query2="SELECT * FROM  affiliateuser where Id='$tomake1'"; 


 $result2 = mysqli_query($con,$query2);



while($row2 = mysqli_fetch_array($result2))

{

	

	$id="$row2[Id]";

	$username="$row2[username]";

	$doj="$row2[doj]";

	$ear="$row2[tamount]";

	$ref="$row2[referedby]";




$query1="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID='$tomake1' and Id='$paymentID'"; 


 $result1 = mysqli_query($con,$query1);
 
$i=0;

while($row1 = mysqli_fetch_array($result1))

{

	

	$prid1="$row1[Id]";

	$pruid1="$row1[memberID]";

	$pramount1="$row1[pcktakenID]";

	$prstatus1="$row1[payment_status]";

	$prdate1="$row1[doj]";
	
	$prdiscount1="$row1[discount]";
	
	$prgpay1="$row1[getpayment]";
	
	


$qu1="SELECT * FROM  packages where id = $pramount1"; 

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$pckid1="$r1[id]";

	$pckname1="$r1[name]";

	$pckprice1="$r1[price]";
	
	$pckqty="$r1[tax]";

	$pckcur1="$r1[currency]";

	$pcksbonus1="$r1[sbonus]";

	$l1="$r1[level1]";

	$l2="$r1[level2]";

	$l3="$r1[level3]";

	$l4="$r1[level4]";

	$l5="$r1[level5]";

	$l6="$r1[level6]";

	$l7="$r1[level7]";

	$l8="$r1[level8]";

	$l9="$r1[level9]";

	$l10="$r1[level10]";

	$l11="$r1[level11]";

	$l12="$r1[level12]";

	$l13="$r1[level13]";

	$l14="$r1[level14]";

	$l15="$r1[level15]";



	$arr=array("$l1","$l2","$l3","$l4","$l5","$l6","$l7","$l8","$l9","$l10","$l11","$l12","$l13","$l14","$l15");

	

	$temp1=$ref;
	

	$s102=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount WHERE Id='$tomake1'");

	$r123=mysqli_query($con,"UPDATE affiliateuser SET tamount= tamount-$arr[0] WHERE username='$temp1'");

	for($i=1;$i<15;$i++)

	{

	

	$qexe1="SELECT * FROM  affiliateuser where username='$temp1'"; 

  $rexe1 = mysqli_query($con,$qexe1);



while($ress1 = mysqli_fetch_array($rexe1))

{

	$ans1="$ress1[referedby]";

	}

	$r1234=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount-$arr[$i] WHERE username='$ans1'");

	$temp1=$ans1;
	


	}
	
	
}
 

}



}




?>





<?php

$resultD2=mysqli_query($con,"DELETE FROM affiliateuserpackage WHERE memberID='$tomake1' and Id='$paymentID'");
if ($resultD2)
{
print "<center>Additional Package Deleted</center>";
}
else
{
print "<center>Action could not be performed, check back again<br/>Redirecting in 2 seconds...</center>";
}


$resultD1=mysqli_query($con,"DELETE FROM paymentsclp WHERE userid='$tomake1' and affiliateuserpackageID='$paymentID'");
if ($resultD1)
{
print "<center>Payments Package History Deleted<br/>Redirecting in 2 seconds...</center>";
}
else
{
print "<center>Action could not be performed, check back again<br/>Redirecting in 2 seconds...</center>";
}


?>
