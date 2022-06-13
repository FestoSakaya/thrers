<?php
session_start();
require_once('configlrcn/db_mconfig.php'); 
require_once('configlrcn/slmain_mlquery.php'); 
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>National Research Information Management System : NRIMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<meta name="keywords" content="National Research Information Management System, NRIMS, Clinical Research Information Management System, CRIMS, , Clinical Research Management, Non Clinical Research Management, CRIMS Uganda, Clinical Trials Uganda" />
<meta name="description" content="This is an online platform that supports the National Regulatory Agencies; NDA/UNHRO/UNCST and Research Ethics Committees in the regulatory oversight of clinical research to be carried in the country. The system provides efficient reviews of research and provides the researcher with an interface with the regulatory agencies in the data capture, data management, data validation, quality control and overall regulatory compliance to clinical research management processes" />

        <link rel="stylesheet" href="assets/css/slick/slick.css"> 
        <link rel="stylesheet" href="assets/css/slick/slick-theme.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/iconfont.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/bootsnav.css">

        <!-- xsslider slider css -->


        <!--<link rel="stylesheet" href="assets/css/xsslider.css">-->




        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
        </script>
        
        
<script language="JavaScript" type="text/javascript" src="./assets/js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="./assets/js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>
<script type="text/javascript" src="./assets/js/ajax.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">




        <div class="culmn">
            <!--Home page style-->


            <nav class="navbar navbar-default bootsnav navbar-fixed">
                <div class="navbar-top bg-grey fix">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="navbar-callus text-left sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href=""><i class="fa fa-phone"></i> Call us: +256 414 705500</a></li>
                                        <li><a href=""><i class="fa fa-envelope-o"></i> Contact us: info@uncst.go.ug</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="navbar-socail text-right sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href="https://web.facebook.com/UNCST?_rdc=1&_rdr" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/UNCST_Uganda" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/company/uganda-national-council-for-science-and-technology" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://plus.google.com/113486680663842578110" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Top Search -->
                <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <!-- End Top Search -->


                <div class="container"> 
                    <div class="attr-nav">
                        <ul>
                            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        </ul>
                    </div> 

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="#brand">
                            <img src="assets/images/logo.png" class="logo" alt="CRIMS">
                            <!--<img src="assets/images/footer-logo.png" class="logo logo-scrolled" alt="">-->
                        </a>

                    </div>
                    <!-- End Header Navigation -->

                    <!-- navbar menu -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                        <?php //Menu();?>
                    <li><a href="./#Home">Home</a></li>
                     <li><a href="./#about">About the Portal</a></li>
                     <li><a href="./#HowtoApply">How to Apply</a></li>
                  
                     <li><a href="faqs.php">FAQs</a></li>
                        </ul>
                        
                    </div><!-- /.navbar-collapse -->
                    <?php if(isset($err2)){echo $err2;}?>
					
                </div> 

            </nav>

            <!--Home Sections-->

        

<!--Brand Section-->
            <section id="brand" class="brand fix roomy-80">
                <div class="container">
                    <div class="row" style="padding-top:30px;">
                    
                    
                    
            <?php
/******** EMAIL ACTIVATION LINK**********************/
if(isset($_GET['a']) && !empty($_GET['code']) && !empty($_GET['a']) ) {
$a = $mysqli->real_escape_string($_GET['a']);
$activ = $mysqli->real_escape_string($_GET['code']);


//check if activ code and a is valid
$rs_check = $mysqli->query("select * from ".$prefix."user where rstug_md5_id='$a' and rstug_act_code='$activ'");
$num = $rs_check->num_rows;
  // Match row found with more than 1 results  - the user is authenticated. 
if (!$num) { 
echo $message='<div class="error2">This account has already been activated.</div>';
}
if ($num) { 
// set the rstug_approved field to 1 to activate the account
$rs_activ = "update ".$prefix."user set is_active='1' WHERE  rstug_md5_id='$a' AND rstug_act_code = '$activ' ";
$mysqli->query($rs_activ);
echo $messageOK='<div class="success">Thank you. Your account has been activated, you can now proceed to login.</div>';

///Check whether this accout exists
require_once('configlrcn/dblogresearch_app.php');
$qREc="select * from scth_usrlogin where rstug_md5_id='$a'";
$RecT = $conn->query($qREc);
$TotalsREc = $RecT->num_rows;
if($TotalsREc){
$Insert_QR="update scth_usrlogin set rstug_approved='1' where rstug_md5_id='$a'";
$conn->query($Insert_QR);

$Insert_QRw="update scth_usrlogin set rstug_md5_id='' where rstug_md5_id='$a'";
$conn->query($Insert_QRw);
///Anotherone
$rs_activ3 = "update ".$prefix."user set rstug_md5_id='' WHERE  rstug_md5_id='$a'";
$mysqli->query($rs_activ3);
}
///ecn chek


///Check whether this accout exists
/*require_once('configlrcn/dblonda_app.php');
$qNDA="select * from gcta_users where asrmMd5userID='$a'";
$ndaCT = $connnda->query($qNDA);
$TotalsNDAC = $ndaCT->num_rows;
if($TotalsNDAC){
$Insert_QRnda="update gcta_users set asrmApproved='Yes' where asrmMd5userID='$a'";
$connnda->query($Insert_QRnda);

$Insert_QRwnd="update gcta_users set asrmMd5userID='' where asrmMd5userID='$a'";
$connnda->query($Insert_QRwnd);

}*/
///ecn chek



}

}


?>     
                         
<?php if($messageOK){?><a href="#Home" class="btn btn-primary" id="login" onClick="document.getElementById('id01').style.display='block'" > Returning user/Login</a>  <?php }?>
 
 <?php if (!$num) {?><a href="#Home" class="btn btn-primary" id="login" onClick="document.getElementById('id01').style.display='block'" > Returning user/Login</a>  <?php }?>              
                          
                  
                    </div>
                </div>
            </section><!-- End off Brand section -->


  
            <!--Call to  action section-->
            <section id="action" class="action bg-primary roomy-40">
                <div class="container">
                    <div class="row">
                        <div class="maine_action">
                            <div class="col-md-8">
                                <div class="action_item text-center">
                                    <h2 class="text-white text-uppercase">"A prosperous Science and Technology Led Ugandan Society."</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="action_btn text-left sm-text-center">
                                    <a href="<?php echo $base_url;?>" class="btn btn-default">CRIMS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <footer id="contact" class="footer action-lage bg-black p-top-80">
                <!--<div class="action-lage"></div>-->
             
                <div class="main_footer fix bg-mega text-center p-top-40 p-bottom-30 m-top-80">
                    <div class="col-md-12">
                        <p class="wow fadeInRight" data-wow-duration="1s">
                            Copyright &copy; <?php echo date("Y");?> all rights reserved to Uganda National Council for Science and Technology (UNCST)
                        </p>
                    </div>
                </div>
            </footer>




        </div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
<!--    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./assets/images/img_avatar2.png" alt="Avatar" class="avatar">
    </div>-->

    <div class="containerm">
      <label for="uname"><b>Username</b></label><br>
      <input type="text" placeholder="Enter Username" name="name" required>
<div style="clear:both;"></div>
      <label for="psw"><b>Password</b></label><br>
      <input type="password" placeholder="Enter Password" name="pwd" required>
        
        <div style="clear:both;"></div>
      <input name="doLogin" type="submit" class="button" value="Sign in">
      
      <div style="clear:both;"></div>
 <span class="psw"><a href="forgot.php" class="forgot">Forgot Password?</a></span>
 
 
  <div style="clear:both;"></div>
    </div>

  
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>



        <!-- JS includes -->

   <?php /*?>     <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <script src="assets/js/jquery.easing.1.3.js"></script>
        <script src="assets/css/slick/slick.js"></script>
        <script src="assets/css/slick/slick.min.js"></script>
        <script src="assets/js/jquery.collapse.js"></script>
        <script src="assets/js/bootsnav.js"></script><?php */?>



 <?php /*?>       <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b445eaa6d961556373d9099/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script><?php */?>
<!--End of Tawk.to Script-->
    </body>
</html>
