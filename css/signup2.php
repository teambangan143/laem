<?php

if(!isset($_SESSION)){

    session_start();

}

include_once("z_db.php");

//session_start();







$sql="SELECT maintain FROM  settings WHERE sno=0";

		  if ($result = mysqli_query($con, $sql)) {



    /* fetch associative array */

    while ($row = mysqli_fetch_row($result)) {

        $main= $row[0];

    }

	if($main==2 || $main==3)

	{

	print "

				<script language='javascript'>

					window.location = 'maintain.php';

				</script>

			";

	}



}



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['todo']))

{

// Collect the data from post method of form submission // 

$todo=mysqli_real_escape_string($con,$_POST['todo']);

$fname=mysqli_real_escape_string($con,$_POST['fname']);

$mname=mysqli_real_escape_string($con,$_POST['mname']);

$lname=mysqli_real_escape_string($con,$_POST['lname']);

$username=mysqli_real_escape_string($con,$_POST['username']);

$userid=mysqli_real_escape_string($con,$_POST['username']);

$password=mysqli_real_escape_string($con,$_POST['password']);

$password2=mysqli_real_escape_string($con,$_POST['password2']);



$email=mysqli_real_escape_string($con,$_POST['email']);



$mobile=mysqli_real_escape_string($con,$_POST['mobile']);

$ref=mysqli_real_escape_string($con,$_POST['referral']);

$address=mysqli_real_escape_string($con,$_POST['address']);

$country=mysqli_real_escape_string($con,$_POST['country']);

$city=mysqli_real_escape_string($con,$_POST['city']);

$package=mysqli_real_escape_string($con,$_POST['package']);

$prepaid=mysqli_real_escape_string($con,$_POST['prepaid']);

$placement=mysqli_real_escape_string($con,$_POST['placement']);

$position=mysqli_real_escape_string($con,$_POST['position']);


$status = "OK";

$msg="";

//validation starts

// if userid is less than 6 char then status is not ok

if(!isset($username) or strlen($username) <6){

$msg=$msg."User Id Should Contain Minimum 6 CHARACTERS.<BR>";

$status= "NOTOK";}					



//if(!ctype_alnum($username)){

//$msg=$msg."User Id Should Contain Alphanumeric Chars Only.<BR>";

//$status= "NOTOK";}				





$rr=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE username = '$username'");

$r = mysqli_fetch_row($rr);

$nr = $r[0];

if($nr==1){

$msg=$msg."Userid Already Exists. Please Try Another One.<BR>";

$status= "NOTOK";

}	



/* $rrr=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE mobile = '$mobile'");

$r3 = mysqli_fetch_row($rrr);

$nr3 = $r3[0];

if($nr3==1){

$msg=$msg."Mobile Number Already Registered.<BR>";

$status= "NOTOK";

}	  */



$remail=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE email = '$email'");

$re = mysqli_fetch_row($remail);

$nremail = $re[0];

if($nremail==1){

$msg=$msg."E-Mail Id Already Registered.<BR>";

$status= "NOTOK";

}				



$result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where username = '$ref'");

$row = mysqli_fetch_row($result);

$numrows = $row[0];

if ($numrows==0)

{

$msg=$msg."Sponsor/Referral Username Not Found..<BR>";

$status= "NOTOK";

}



$resultprepaid = mysqli_query($con,"SELECT count(*) FROM  prepaidcodereg where prepaidcode = '$prepaid' AND status=0");

$rowprepaid  = mysqli_fetch_row($resultprepaid );

$numrowsprepaid  = $rowprepaid [0];

if ($numrowsprepaid ==0)

{

$msg=$msg."Prepaid code invalid..<BR>";

$status= "NOTOK";

}




if ( $package=="" ){

$msg=$msg."Please Select The Package.<BR>";

$status= "NOTOK";}	





if ( strlen($password) < 6 ){

$msg=$msg."Password Must Be More Than 6 Char Length.<BR>";

$status= "NOTOK";}	



if ( strlen($address) < 1 ){

$msg=$msg."Not Available<BR>";

}



if ( strlen($mobile) > 15 ){

$msg=$msg."Please Enter Correct Mobile Number<BR>";

}



if ( strlen($email) < 1 ){

$msg=$msg."Please Enter Your Email Id.<BR>";

$status= "NOTOK";}

			

if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){

$msg=$msg."Email Id Not Valid, Please Enter The Correct Email Id .<BR>";

$status= "NOTOK";}



if ( $password <> $password2 ){

$msg=$msg."Both Passwords Are Not Matching.<BR>";

$status= "NOTOK";}		





if ( $country == "" ){

$msg=$msg."Please Enter Your Country Name.<BR>";

$status= "NOTOK";}	



//Test if it is a shared client

if (!empty($_SERVER['HTTP_CLIENT_IP'])){

  $ip=$_SERVER['HTTP_CLIENT_IP'];

//Is it a proxy address

}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

}else{

  $ip=$_SERVER['REMOTE_ADDR'];

}

//The value of $ip at this point would look something like: "192.0.34.166"

$ip = ip2long($ip);

//The $ip would now look something like: 1073732954



$sqlquery="SELECT wlink FROM settings where sno=0"; //fetching website from databse

$rec2=mysqli_query($con,$sqlquery);

$row2 = mysqli_fetch_row($rec2);

$wlink=$row2[0]; //assigning website address



$sqlquery111="SELECT etext FROM emailtext where code='SIGNUP'"; //fetching website from databse

$rec2111=mysqli_query($con,$sqlquery111);

$row2111 = mysqli_fetch_row($rec2111);

$emailtext=$row2111[0]; //assigning email text for email



if(!($package==""))

{

$sqlquery11="SELECT validity FROM packages where id = $package"; //fetching no of days validity from package table from databse

$rec211=mysqli_query($con,$sqlquery11);

$row211 = mysqli_fetch_row($rec211);

$noofdays=$row211[0]; //assigning website address

$cur=date("Y-m-d");

$expiry=date('Y-m-d', strtotime($cur. '+ '.$noofdays.'days'));

$sbonus=0;

}





if ($status=="OK") 

{

$scode=rand(1111111111,9999999999); //generating random code, this will act as signup key

$query=mysqli_query($con,"insert into affiliateuser(username,password,fname,mname,lname,address,email,referedby,ipaddress,mobile,doj,country,city,signupcode,tamount,pcktaken,expiry,placement,position) values('$username','$password','$fname','$mname','$lname','$address','$email','$ref','$ip','$mobile','$cur','$country','$city','$scode','$sbonus','$package','$expiry','$placement','$position')");


mysqli_query($con,"UPDATE prepaidcodereg SET regby='$username', regdate=NOW(), status=1 WHERE prepaidcode='$prepaid'");

$_SESSION['paypalidsession'] = $userid;

// More headers

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";

$to=$email;

$subject="Order Confirmation";

$message=$emailtext;

mail($to,$subject,$message,$headers);

print "

				<script language='javascript'>

					window.location = 'thankyou.php?username=$username';

				</script>

			"; 



}







else

{ 

$errormsg= "

<div class='alert alert-danger'>

                    <button type='button' class='close' data-dismiss='alert'>&times;</button>

                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>".$msg."</div>"; //printing error if found in validation

					

}



}

?>

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<style type="text/css">html {

    overflow-y: scroll;

background: url(images/login2.jpg) no-repeat center center fixed; 

  -webkit-background-size: cover;

  -moz-background-size: cover;

  -o-background-size: cover;

  background-size: cover;

}



</style>

<meta charset="utf-8" />

<title>Registration</title>

<meta name="google-translate-customization" content="c3c91eff8b5a0ded-878e61fea3a9f875-g9379dbb792475ecb-13"></meta>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />



<meta property="og:title" content="LAEM Enterprises Registration" />

<meta property="og:type" content="article" />

<meta property="og:image" content="http://skinbotanicals.net/user/images/fblogo.jpg" />

<meta property="og:url" content="http://skinbotanicals.net/user/" />

<meta property="og:description" content="LAEM Enterprises " />





<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]

<div id="google_translate_element" align="right"></div><script type="text/javascript">

function googleTranslateElementInit() {

  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');

}

</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 

</head>

<body style="overflow: scroll;">

<section id="content" >

  <div class="container aside-xl"> <a class="navbar-brand block" href="#">Great Decision... ;)</a>

  <div class="row">

                <div class="col-sm-18">

                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post" data-validate="parsley">

                    <section class="panel panel-default">

                      <header class="panel-heading">

                        <span class="h4">Register</span>

                      </header>

                      <div class="panel-body">

					  

                        <p class="text-muted">Please fill the information to continue</p>

						<?php 

						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status=="NOTOK"))

						{

						print $errormsg;

						}

						?>

						<input type="hidden" name="todo" value="post">
                        
                        
                         <div class="form-group pull-in clearfix">
 <div class="col-sm-5">

                          <label>Code Activation</label>

                          <input type="text" class="form-control" data-required="true" name="prepaid" id="prepaid" required >                        

                        </div>
</div>
                        
                        
                        
                         

						<div class="form-group pull-in clearfix">
                        
                        <script type="text/javascript"> 
                          function capitalize(obj)
{
    obj.value = obj.value.charAt(0).toUpperCase() + obj.value.slice(1);
}</script>

                        <div class="col-sm-6">
                        

                          <label>Username</label>

                          <input type="text" class="form-control" data-required="true" name="username" id="username" value="" readonly>                        

                        </div>

                        <div class="col-sm-6">

                          <label>First Name</label>
                         

                         <input type="text" class="form-control" data-required="true" name="fname" id="fname" onkeyup='capitalize(this)' oninput="join_names();" onpaste="join_names();" required>   
                         <style>
						 input[type=text] {
    text-transform: capitalize;
}
						 </style> 
                         <script type="text/javascript"> 
                         $('input[type=text]').keyup(function() {
    $('b').text($(this).val());
});            </script>         

                        </div>
                        <div class="col-sm-6">

                          <label>Middle Name</label>

                         <input type="text" class="form-control" data-required="true" name="mname" id="mname" onkeyup='capitalize(this)' oninput="join_names();" onpaste="join_names();" required>    
                         <script type="text/javascript"> 
                         $('input[type=text]').keyup(function() {
    $('b').text($(this).val());
});            </script>                       

                        </div>
                        <div class="col-sm-6">

                          <label>Last Name</label>

                         <input type="text" class="form-control" data-required="true" name="lname" id="lname" onkeyup='capitalize(this)' oninput="join_names();" onpaste="join_names();" required>   
                         <script type="text/javascript"> 
                         $('input[type=text]').keyup(function() {
    $('b').text($(this).val());
});            </script>                        
                           <script type="text/javascript">
   function concatenate(/*String*/string_one, /*String*/string_two, /*boolean*/with_space) {
    if (with_space===true) {
	 return string_one+'.'+string_two;
    }
    else {
	 return string_one+string_two;
    }
   }
   function join_names() {
    var input_name_first = document.getElementsByName('fname')[0].value;
    var input_name_last = document.getElementsByName('lname')[0].value;
    var input_name_full = document.getElementsByName('username')[0];
    var var_name_full = concatenate(input_name_first, input_name_last, true);
    input_name_full.value = var_name_full;
   }
  </script>

                        </div>

						</div>

                        <div class="form-group pull-in clearfix">

                          <div class="col-sm-6">

                            <label>Enter password</label>

                            <input type="password" class="form-control" data-required="true" id="pwd" name="password" required>   

                          </div>

                          <div class="col-sm-6">

                            <label>Confirm password</label>

                            <input type="password" class="form-control" data-equalto="#pwd" data-required="true" name="password2" required>      

                          </div>   

                        </div>

						<div class="form-group pull-in clearfix">

						<div class="col-sm-6">

                          <label>Email</label>

                          <input type="email" class="form-control" data-type="email" data-required="true" name="email" required>                        

                        </div>

						<div class="col-sm-6">

                          <label>Mobile Phone</label>

                          <input name="mobile" type="text" required class="form-control" placeholder="(XXXX) XXX XXXX"  data-type="phone" data-required="true">

                        </div>

						</div>

						

                        <div class="form-group">

                          <label>Address</label>

                          <input type="text" class="form-control" data-required="true" name="address">

                        </div>

						

						<div class="form-group">

						<label>Province</label>

                            <select data-required="true" class="form-control m-t" name="country" required>

                                <option value="">Please choose</option>

                                

<?php $query="SELECT id,name FROM provinces"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$name="$row[name]";


  print "<option value='$id'>$name</option>";

  

  }

  ?>

                            </select>

                          </div>
                          
                          
                          
                          <div class="form-group">

						<label>City</label>

                            <select data-required="true" class="form-control m-t" name="city" required>

                                <option value="">Please choose</option>

                                

<?php $query="SELECT id,name,province_id FROM cities"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$name="$row[name]";
	


  print "<option value='$id'>$name</option>";



  }

  ?>

                            </select>

                          </div>
                          
                          
                          

						  <div class="form-group">

						<label>Package</label>

                            <select data-required="true" class="form-control m-t" name="package" required>

                                <option value="">Please choose</option>

								<?php $query="SELECT id,name,price,currency,tax FROM  packages WHERE active=1"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$pname="$row[name]";

	$pprice="$row[price]";

	$pcur="$row[currency]";

	$ptax="$row[tax]";

$total=$pprice*$ptax;

  print "<option value='$id'>$pname | Price - $pcur $total </option>";

  

  }

  ?>

								</select>

                          </div>





<?php 

			if(isset($_GET["laem"])){

			$aff=mysqli_real_escape_string($con,$_GET["laem"]);

			$_SESSION['laem'] = $aff;

			

			



	}		

			

			?>

			<div class="form-group">

                          <label>Sponsor/Referral Username</label>

                          <input type="text" class="form-control" data-required="true" name="referral" value="<?php if (isset($_SESSION['laem'])){

			echo $_SESSION['laem']; } ?>" required readonly>                        

                        </div>


<div class="form-group">

                          <label>Placement Username</label>

                          <input type="text" class="form-control" data-required="true" name="placement">

                        </div>



<div class="form-group">

				<label>Placement Position</label>

                            <select data-required="true" class="form-control m-t" name="position" required id="position">
                              <option value="Left">Left</option>
                              <option value="Right">Right</option>

								

								</select>

                        </div>





								

                        <div class="checkbox i-checks">

                          <label>

                            <input type="checkbox" name="check" data-required="true" required><i></i> I agree to the <a href="http://cmpcintl.com/termsofservice/" class="text-info">Terms of Service</a>

                          </label>

                        </div>

                      </div>

                      <footer class="panel-footer text-right bg-light lter">

                        <button type="submit" class="btn btn-success btn-s-xs">Register</button>

                      </footer>

                    </section>

					<div class="line line-dashed"></div>

          <p class="text-muted text-center"><small style="color:#ffffff;">Already have an account?</small></p>

          <a href="index.php" class="btn btn-lg btn-default btn-block">Sign in</a>

                  </form>

                </div>

                

              </div>

     </div>

</section>

<!-- footer -->

<footer id="footer">

  <div class="text-center padder clearfix">

    <p> <small style="color:#ffffff;"><?php $query="SELECT footer from settings where sno=0"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$footer="$row[footer]";

	print $footer;

	}

  ?>

 </small> </p>

  </div>

</footer>

<!-- / footer -->

<!-- Bootstrap -->

<!-- App -->

<script src="js/app.v1.js"></script>

<script src="js/app.plugin.js"></script>

</body>

</html>