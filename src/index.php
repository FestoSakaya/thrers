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
    <base href="<?php echo $base_url;?>">
        <meta charset="utf-8">
        <title>National Research Information Management System : NRIMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<meta name="keywords" content="National Research Information Management System, NRIMS, CRIMS, CRIMS Uganda, Clinical Research Information Management System, Clinical Research Management, Non Clinical Research Management , Clinical Trials Uganda" />
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
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">

<?php /*?>
        <!-- Preloader -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div><!--End off Preloader --><?php */?>


        <div class="culmn">
            <!--Home page style-->


            <nav class="navbar navbar-default bootsnav navbar-fixed">
                <div class="navbar-top bg-grey fix">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="navbar-callus text-left sm-text-center">
                                    <ul class="list-inline">
                                        <li style="color:#FFF;"><i class="fa fa-phone"></i> Call us: +256 414 705500</li>
                                        <li><a href="info[at]uncst.go.ug"><i class="fa fa-envelope-o"></i> Contact us: info@uncst.go.ug</a></li>
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
                     <li><a href="./">Home</a></li>
                     <li><a href="#about">About the Portal</a></li>
                     <li><a href="#HowtoApply">How to Apply</a></li>
                     <li><a href="register.php" style="color:#03F;">Register/Create Account</a></li>
                     <li><a href="#Home" style="color:#fe4641;width:auto;" onClick="document.getElementById('id01').style.display='block'" > Returning user/Login</a></li>
                     <li><a href="faqs.php">FAQs</a></li>
                        </ul>
                        
                    </div><!-- /.navbar-collapse -->
					<?php if(isset($err2)){echo $err2;}?>
                </div> 

            </nav>

            <!--Home Sections-->

          





  <section id="home" class="home bg-black fix" style="height:500px;overflow:hidden;">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="col-md-12">
                                <div class="hello_slid">
                                
                                <?php include("configlrcn/slider.php");?>
                                    
                                    
                    
                    
                                </div>
                            </div>

                        </div>


                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->


<?php /*?>
            <!--Featured Section-->
            <section id="recapproval" class="recapproval">
                <div class="container">
                    <div class="row">
                        <div class="main_features fix roomy-70">
                        
                        <div class="welcome">Does your study involve human participants?</div> 
                      
                        </div>
                    </div><!-- End off row -->
                </div><!-- End off container -->
            </section><!-- End off Featured Section--><?php */?>
            
     
            
            <!--Business Section-->
            <section id="about" class="about bg-grey roomy-70">
                <div class="container">
                    <div class="row">
                        <div class="main_business">
                            <div class="col-md-6">
                            
                                 <div class="business_slid">
                                   <!-- <div class="slid_shap bg-grey"></div>-->
                                    <iframe width="553" height="350" src="https://www.youtube.com/embed/b5yaUcG3IAc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                   <?php /*?> <div class="business_items text-center">
                                       <div class="business_item">
                                            <div class="business_img">
                                                <img src="assets/images/main3.jpg" alt="" />
                                            </div>
                                        </div>
										
										<div class="business_item">
                                            <div class="business_img">
                                                <img src="assets/images/clintrial_2017.jpg" alt="" />
                                            </div>
                                        </div>
										 <div class="business_item">
                                            <div class="business_img">
                                                <img src="assets/images/main3.jpg" alt="" />
                                            </div>
                                        </div>
										
										

                                        

                                       
                                    </div><?php */?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="business_item sm-m-top-50">
                                <?php WelcomeAbout();?>
                                    

                                  <!--  <div class="business_btn">
                                        <a href="" class="btn btn-primary m-top-20">Read More</a>
                                    </div>-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End off Business section -->

<!--Brand Section-->
            <section id="HowtoApply" class="brand fix roomy-80" style="background:#F2F7FF;">
                <div class="container">
                    <div class="row">
                        <div class="main_brand text-center">
                          <h1 style="color:#4E5F83;">Simple steps</h1>
                   <img src="./assets/images/howto_apply.png">
                    
<div class="appyholder">
<p class="applypg"><strong>Step 1.</strong> If you are a new user, click register to create an account. <strong>For users with accounts on <a href="https://research.uncst.go.ug/" target="_blank">Research Application portal</a>, you dont need to register, procced to login.</strong> </p>
                    
                <p class="applypg"><strong>Step 2.</strong> After registration, an email with activation link will be sent to you. Activate your account.</strong> </p>
                
                <p class="applypg"><strong>Step 3.</strong> Log into the portal. <strong>Does the study involve Human participants?</strong><br>
                <br>a) If <strong>NO</strong> - You will be redirected to UNCST portal<br>
                b) If <strong>YES</strong> - Is it drug Related Clinical trial? (Approval has to be done by Research Ethics Committees Portal before National Drug Authority Portal) </p>
                
                
           <p class="applypg"><strong>Step 4.</strong> Start on application process. </p>  
     </div>
                          
                        </div>
                    </div>
                </div>
            </section><!-- End off Brand section -->

            <!--Brand Section-->
            <section id="brand" class="brand fix roomy-80">
                <div class="container">
                    <div class="row">
                        <div class="main_brand text-center">
                        <h1 style="color:#4E5F83;">Our Partners</h1>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <a href="https://uncst.go.ug/" target="_blank"><img src="assets/images/uncst-rec.jpg" alt=""  border="0"/></a>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <a href="https://www.nda.or.ug/" target="_blank"><img src="assets/images/crims.jpg" alt=""  border="0"/></a>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <a href="http://unhro.org.ug/" target="_blank"><img src="assets/images/unhro.jpg" alt="" border="0"/></a>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="brand_item sm-m-top-20">
                                    <a href="http://www.edctp.org/" target="_blank"><img src="assets/images/edctp.jpg" alt=""  border="0"/></a>
                                </div>
                            </div>
                         
                          
                        </div>
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
                                    <a href="" class="btn btn-default">NRIMS</a>
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
                            Copyright &copy; <?php echo date("Y");?> all rights reserved to Uganda National Council for Science and Technology (UNCST)  | <a href="https://www.uncst.go.ug/terms-and-conditions-of-use/" target="_blank"><strong>Terms and Conditions</strong></a> | <a href="https://www.uncst.go.ug/privacy-policy/" target="_blank"><strong>Privacy Policy</strong></a>
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
 <span class="psw"><b>New user?</b> <a href="register.php"><b>Register here</b></a> |  <a href="forgot.php" class="forgot">Forgot Password?</a></span>
 
 
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

        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <script src="assets/js/jquery.easing.1.3.js"></script>
        <script src="assets/css/slick/slick.js"></script>
        <script src="assets/css/slick/slick.min.js"></script>
        <script src="assets/js/jquery.collapse.js"></script>
        <script src="assets/js/bootsnav.js"></script>



        <script src="assets/js/plugins.js"></script>
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
</script>
<!--End of Tawk.to Script-->
    </body>
</html>
