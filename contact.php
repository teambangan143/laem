<?php

include_once ("z_db.php");

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

?>



		  <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken FROM  affiliateuser where username = '".$_SESSION['username']."'"; 

 

 //fetching details for user

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $aid="$row[id]";

 $regdate="$row[doj]";

 $name="$row[fname]";

 $address="$row[address]";

 $acti="$row[active]";

 $pck="$row[pcktaken]";

 

 }

 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']))

{



$subject=mysqli_real_escape_string($con,$_POST['subject']);

$subjetc=$subject."Registered Customer Query";

$message=mysqli_real_escape_string($con,$_POST['message']);

$email=mysqli_real_escape_string($con,$_POST['email']);

$from=$email;







//if(isset($todo) and $todo=="post"){



$status = "OK";

$msg="";

//validation starts

if ( strlen($subject) < 2 ){

$msg=$msg."Enter Subject.<BR>";

$status= "NOTOK";}



if ( strlen($message) < 2 ){

$msg=$msg."Enter Message.<BR>";

$status= "NOTOK";}



if ( strlen($email) < 2 ){

$msg=$msg."Enter Email.<BR>";

$status= "NOTOK";}



$sqlquery="SELECT email FROM settings where sno=0"; //fetching website from databse

$rec2=mysqli_query($con,$sqlquery);

$row2 = mysqli_fetch_row($rec2);

$to=$row2[0]; //assigning website address

//}



if ($status=="OK") 

{

// More headers

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: <'.$email.'>' . "\r\n";

mail($to,$subject,$message,$headers);

$errormsg= "

<div class='alert alert-success'>

                    <button type='button' class='close' data-dismiss='alert'>&times;</button>

                    <i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Your Mail Has Been Sent! Our Representative Will Get Back To You.</div>"; //printing error if found in validation

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

<meta charset="utf-8" />

<title>Contact Us</title>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />

<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->

</head>

<body class="">

<section class="vbox">

<?php include ("header.php"); ?>

  <section>

    <section class="hbox stretch">
    
    <?php include ("menu.php"); ?>

      <section id="content">

        <section class="vbox bg-white">

          <header class="header b-b b-light hidden-print">

            

            <p>Contact Us | Available 24*7</p>

          </header>

		  <br>

		  <br>

		  		<div class="col-sm-8">

                <section class="panel panel-default">

				<section class="scrollable padder">

				<?php 

						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))

						{

						print $errormsg;

						}

						?>

                  <header class="panel-heading font-bold">Use Below Form To Ask Query</header>

                  <div class="panel-body">

                    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?> method="post">

					<input type="hidden" name="todo" value="post">

                      <div class="form-group">

                        <label>Email address</label>

                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>

                      </div>

                      <div class="form-group">

                        <label>Subject</label>

                        <input type="text" name="subject" class="form-control" placeholder="Message Subject" required>

                      </div>

					  <div class="form-group">

                        <label>Body</label>

                        <textarea rows="8" cols="90" name="message" placeholder="Message Subject" required></textarea>

                      </div>

                      

                      <button type="submit" class="btn btn-sm btn-default">Submit</button>

                    </form>

                  </div>

                </section>

              </div>  

          </section>

        </section>

        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>

    </section>

  </section>

</section>

<!-- Bootstrap -->

<!-- App -->

<script src="js/app.v1.js"></script>

<script src="js/app.plugin.js"></script>

</body>

</html>