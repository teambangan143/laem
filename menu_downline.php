      <!-- .aside -->

      <aside class="bg-light aside-md hidden-print" id="nav">

        <section class="vbox">

          <section class="w-f scrollable">

            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-color="#333333">

              <div class="clearfix wrapper dk nav-user hidden-xs">

                <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb avatar pull-left m-r"> <img src="images/a0.jpg"> <i class="on md b-black"></i> </span> <span class="hidden-nav-xs clear"> <span class="block m-t-xs"> <strong class="font-bold text-lt"><?php

		  $sql="SELECT fname,country,pcktaken FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {



    /* fetch associative array */

    while ($row = mysqli_fetch_row($result)) {

        print $row[0];

		$coun=$row[1];

		$pcktaken=$row[2];

		 $sql2="SELECT name FROM packages WHERE id=$pcktaken";

		 if ($result2 = mysqli_query($con, $sql2)) {

		  while ($row2 = mysqli_fetch_row($result2)) {

		 $pkname=$row2[0];

		 }

		 }

		

    }



}



//customized Code Part 1 Start

//fetching level settings

  $qu="SELECT * FROM  packages where id = $pcktaken"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$pckid="$r[id]";

	$pckname="$r[name]";

	$pckprice="$r[price]";

	

	$pckcur="$r[currency]";

	$pcksbonus="$r[sbonus]";

	$l1="$r[level1]";

	$l2="$r[level2]";

	$l3="$r[level3]";

	$l4="$r[level4]";

	$l5="$r[level5]";

	$l6="$r[level6]";

	$l7="$r[level7]";

	$l8="$r[level8]";

	$l9="$r[level9]";

	$l10="$r[level10]";

	$l11="$r[level11]";

	$l12="$r[level12]";

	$l13="$r[level13]";

	$l14="$r[level14]";

	$l15="$r[level15]";

//fetching elevl settings ends

//Customiezed Code Part 1 Ends

}	

	   ?></strong> <b class="caret"></b> </span> <span class="text-muted text-xs block"><?php print "LAEM Enterprises Member"; ?></span> </span> </a>

                  <ul class="dropdown-menu animated fadeInRight m-t-xs">

                    <span class="arrow top hidden-nav-xs"></span>

                 

                    <li> <a href="profile.php">Profile</a> </li>

                    <li> <a href="notifications.php">Notifications </a> </li>

                    <li> <a href="contact.php">Help</a> </li>

                    <li class="divider"></li>

                    <li> <a href="logout.php" data-toggle="ajaxModal" >Logout</a> </li>

                  </ul>

                </div>

              </div>

              <!-- nav -->

              <nav class="nav-primary hidden-xs">

                <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm"><span class="text-primary"><b>ID NUMBER:</b></span> <?php

		  $sql="SELECT Id FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {

        print $row[0];
    }
}
 ?></br><span class="text-info"><b>USERNAME:</b></span> <?php

		  $sql="SELECT username FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {

        print $row[0];
    }
}
 ?></br><span class="text-success"><b>DATE REGISTERED:</b></span> <?php

		  $sql="SELECT doj FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {

        print $row[0];
    }
}
 ?></div>

                <ul class="nav nav-main" data-ride="collapse">

                  <li> <a href="dashboard.php" class="auto"> <i class="i i-statistics icon"> </i> <span class="font-bold">Dashboard</span> </a> </li>

                  

                  <li class="active" > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-lab icon"> </i> <span class="font-bold">Earnings</span></a>
                    <ul class="nav dk">
                      <li > <a href="downline.php" class="auto"> <i class="i i-dot"></i>Referral List</a> </li>

                      <!--<li > <a href="accounthistory.php" class="auto"> <i class="i i-dot"></i> <span>Package Acquired</span> </a> </li>-->

                      

                      

                     <!-- <li> <a href="invoice.php" class="auto"> <i class="i i-dot"></i> <span>Invoice/Account Status</span> </a> </li>

					 <li> <a href="paymentshistory.php" class="auto"> <i class="i i-dot"></i> <span>Savings Reports</span> </a> </li>-->
                      
                       <li> <a href="paymentshistory1a.php" class="auto"> <i class="i i-dot"></i> <span>Earning Reports</span> </a> </li>
                       
                        <!--<li> <a href="paymentshistory2b.php" class="auto"> <i class="i i-dot"></i> <span>Maintenance Reports</span> </a> </li>-->

                      


                    </ul>

                  </li>

                  

                  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-grid2 icon"> </i> <span class="font-bold">Information</span> </a>

                    <ul class="nav dk">

                      <li > <a href="notifications.php" class="auto"> <i class="i i-dot"></i> <span>Notifications</span> </a> </li>

                      <li > <a href="contact.php" class="auto"> <i class="i i-dot"></i> <span>Contact</span> </a> </li>

                    </ul>

                  </li>

                </ul>

                <div class="line dk hidden-nav-xs"></div>

                

                

              </nav>

              <!-- / nav -->

            </div>

          </section>

          <footer class="footer hidden-xs no-padder text-center-nav-xs"> <a href="logout.php" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs"> <i class="i i-logout"></i> </a> <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs"> <i class="i i-circleleft text"></i> <i class="i i-circleright text-active"></i> </a> </footer>

        </section>

      </aside>

      <!-- /.aside -->