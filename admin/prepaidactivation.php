<?php

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

?>

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Notifications Settings</title>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />

<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->

<!--<div id="google_translate_element" align="right"></div><script type="text/javascript">

function googleTranslateElementInit() {

  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');

}

</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
        

</head>

<body class="">

<section class="vbox">

  <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">

    <div class="navbar-header aside-md dk"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="fa fa-bars"></i> </a> <a href="dashboard.php" class="navbar-brand"><img src="images/logo.png" class="m-r-sm"><?php $query="SELECT header from settings where sno=0"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$header="$row[header]";

	print $header;

	}

  ?></a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"> <i class="fa fa-cog"></i> </a> </div>

  
<?php /*?><?php include ("../google_trans.php"); ?><?php */?>
    

    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">

      

      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb-sm avatar pull-left"> <img src="images/a0.jpg"> </span> <?php

		  $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";

		  if ($result = mysqli_query($con, $sql)) {



    /* fetch associative array */

    while ($row = mysqli_fetch_row($result)) {

        print $row[0];

    }



}



   

	   

	   ?> <b class="caret"></b> </a>

       <ul class="dropdown-menu animated fadeInRight">

          <span class="arrow top"></span>

          <li> <a href="profile.php">Profile</a> </li>

          <li class="divider"></li>

          <li> <a href="logout.php" data-toggle="ajaxModal" >Logout</a> </li>

        </ul>

      </li>

    </ul>

  </header>

  <section>

    <section class="hbox stretch">

    <?php include ("menu_admin.php"); ?>

      <section id="content">
      

        <section class="vbox">

          <header class="header bg-white b-b b-light">

            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. </p>

          </header>

          <section class="scrollable padder">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">
                
                
                <header class="panel-heading"> Notifications Settings </header>

                  <section class="panel panel-default">

                  <header class="panel-heading bg-light">

                    <ul class="nav nav-tabs nav-justified">

                      <li class="active"><a href="#home" data-toggle="tab">Generate Prepaid Code</a></li>
                      
                      <li><a href="#save" data-toggle="tab">Save Prepaid Code</a></li>

                      <li><a href="#profile" data-toggle="tab">Prepaid Code List</a></li>

                                          

                    </ul>

                  </header>

                  

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane active" id="home">

					  

					  

					  <div class="panel-body">




<iframe src="coupon/prepaid.php" allowtransparency frameborder="0" scrolling="no" onload="resizeIframe(this)" style="width:100%">

</iframe>





</div>

                      

                      

                    </div>
                    
                    
                    
                    
                    
                    <div class="tab-pane" id="save">

					  

					  

					  <div class="panel-body">

                    <form action="saveprepaidcode.php" method="post">

                      <!--<div class="form-group">

                        <label>Member ID | Name</label>

                        <select data-required="true" class="form-control" name="id_number" required>

                                <option value="">Please choose</option>

								<?php /*?><?php $query="SELECT Id,username FROM  affiliateuser where level=2 ORDER BY username ASC"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[Id]";

	$pname="$row[username]";
	


  print "<option value='$id'>$id | $pname</option>";

  

  }

  ?><?php */?>

								</select>

                      </div>-->
                      
                      
                      
                     
                      
                      
                      

                      <div class="form-group">

                        <label>Prepaid Code</label><br/>

                       <input name="prodcode" type="text" class="form-control" placeholder="Enter Prepaid Code" value="" maxlength="30">

                      </div>


                     <button type="submit" class="btn btn-lg btn-danger btn-block">Save Prepaid Code</button>

                    </form>

                  </div>

					  

					  </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="tab-pane" id="profile">

					  

					  

					  <div class="panel-body">

                    

					  

<div class="table-responsive">

                <table class="table table-striped b-t b-light">

                  <thead>

                    <tr>

                     

                      <th width="7%">ID</th>

					  <th width="20%">Prepaid Code</th>

					  <th width="20%">Reg By</th>

					  <th width="15%">Reg Date</th>

					  <th width="12%">Status</th>

					  <th width="12%">Action</th>

                    </tr>

                  </thead>

                  <tbody></tbody>

				  <?php 
				  
				  
				  $que2="SELECT * FROM  prepaidcodereg ORDER BY codeId DESC"; 
 
 $ref = mysqli_query($con,$que2);

while($rs = mysqli_fetch_array($ref))

/*if (!$ref) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}*/

{

	$code_id1="$rs[codeId]";

	$prodcode1="$rs[prepaidcode]";

	$regby1="$rs[regby]";
	
	$regdate1="$rs[regdate]";
	
	$status1="$rs[status]";
	
	 
	 
	 
	 
	 

	 
	 
	
	if($status1==1)

	{

	$stat="Active";

	}

	else if($status1==0)

	{

	$stat="<span class='label bg-info'>UnActive</span>";

	}

	else

	{

	$stat="Unknown";

	}
	




 
  
// $query="SELECT * FROM  affiliateuser where Id=$regby1"; 
//
//
// $result = mysqli_query($con,$query);
//
//
//while($row = mysqli_fetch_array($result))
//
//{
//
//	
//
//	$id="$row[Id]";
//
//	$username="$row[username]";
//	
//	$fname="$row[fname]";
//	
//	$lname="$row[lname]";
//	
//	$fullname="$fname $lname";
//
//
//}



//$queryprod="SELECT productName FROM  products where id=$prodname1";  
//
//
// $resultprod = mysqli_query($con,$queryprod);
//
//
//while($rowprod = mysqli_fetch_array($resultprod))
//
//{
//
//    
//	$prodname2="$rowprod[productName]";
//
//
//}








  print "<tr>


				  <td>

				  $code_id1

				  </td>

				  <td>
				  
				  <input type='text' class='form-control' value='$prodcode1' maxlength='11'>

				  

				  </td>
				  
				  

				  <td>

				  <b>$regby1</b> 

				  </td>

				  <td>

				  $regdate1

				  </td>

				  <td>

				  

				  $stat

				  </td>

				  <td> ";

				  

				  if($stat==0)

	{
		
		/*echo "<br/><label>OR No.:</label>

                          <input type='text' class='form-control' data-required='true' name='orno' id='orno' value='<?php echo $orno; ?>' required>  ";*/

	print "
	
	<a href='deleteprepaidcode.php?codeId=$code_id1' class='label bg-danger'>Delete Code</a> <br/><br/>
	
	";

	}	  
/*else
{

		
		echo "<br/><label>OR No.:</label>

                          <input type='text' class='form-control' data-required='true' name='orno' id='orno' value='.&var.' required>  ";

	print "<a href='date.php' class='btn btn-sm btn-info pull-left'>Register OR</a>";
	  
	
}*/
			
			
	

	

				  

		print"		  </p> 

				  </td>

				  

				  </tr>";

  

  }


  ?>

				  

                  </tbody>

                </table>

              </div>


                    

                  </div>
                      

                      

                    </div>
                    
                    
                    

                  </div>

                </section>

                </section>

                

              <!--</div>

            </div>-->

          </section>

        </section>

        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>

    </section>

  </section>

</section>

<!-- Bootstrap -->

<!-- App -->

<script src="js/app.v1.js"></script>

<script src="js/jquery.ui.touch-punch.min.js"></script>

<script src="js/jquery-ui-1.10.3.custom.min.js"></script>

<script src="js/app.plugin.js"></script>

</body>

</html>