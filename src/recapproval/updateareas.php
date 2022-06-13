 <?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
timeout($timeout);
if(!$mysqli->real_escape_string($_SESSION['username']) and !$mysqli->real_escape_string($_SESSION['asrmApplctID']))
{
echo '<meta http-equiv="REFRESH" content="0;url=$base_url">';
	
die;
}
?><!DOCTYPE html>
<html>
  <head>
  <base href="<?php echo $base_url;?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $sitename;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">-->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <!--<script src="https://use.fontawesome.com/99347ac47f.js"></script>-->
    <!-- Font Icons CSS-->
    <!--<link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 <link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>

   <!--Begin Word count-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.inputlimiter.1.3.1.min.js"></script>
	<script type="text/javascript" src="js/word-count.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery.inputlimiter.1.0.css" />
    <!--End Word count-->

<!--<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>
 <!-- <script type='text/javascript'>
window.onunload = function(){
window.opener.location.reload();}
</script>-->
  <link rel="stylesheet" type="text/css" href="css/tcal.css" />
	<script type="text/javascript" src="js/tcal.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    
   <script type="text/javascript">
        function refreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        //call the refresh page on closing the window
        window.onunload = refreshParent;
    </script>

    

    <!--End Word count-->
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <!--<div class="logogrid"></div>-->
              <div class="navbar-header">
              
              <div class="logogrid"></div>
              

<?php /*?>   <?php if($session_privillage=='investigator'){?>Welcome, <?php echo $session_fullname;?><?php }else{?><div class="logogrid"></div><?php }?><?php */?>          
              </div>
              <!-- Navbar Menu -->
              
              <div class="dropdown">
  <button class="dropbtn">Welcome, <?php echo $session_fullname;?> </button>

</div>
              
    
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->

        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
  
         <h2 class="no-margin-bottom">Recruitment Area(s):</h2>
 
            </div>
          </header>


          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
         
         
       <?php
if($_POST['doCountry']=='Save' and $_POST['countryid'] and $_POST['asrmApplctID'] and $_POST['participants'] and $id){

	$countryid=$mysqli->real_escape_string($_POST['countryid']);
	$district_id=$mysqli->real_escape_string($_POST['district_id']);
	$participants=$mysqli->real_escape_string($_POST['participants']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	
	$Duration=$mysqli->real_escape_string($_POST['Duration']);
	$Durationperiod=$mysqli->real_escape_string($_POST['Durationperiod']);
	$Parish=$mysqli->real_escape_string($_POST['Parish']);
	$SubCounty=$mysqli->real_escape_string($_POST['SubCounty']);
	$Municipality=$mysqli->real_escape_string($_POST['Municipality']);
	
	$gender_idm=$_POST['gender_id'];
$minimum_agem=$_POST['minimum_age'];
$maximum_agem=$_POST['maximum_age'];
	
	
$sqlA2="update ".$prefix."submission_country set  `country_id`='$countryid',`district_id`='$district_id',`participants`='$participants',`Municipality`='$Municipality',`SubCounty`='$SubCounty',`Parish`='$Parish',`Duration`='$Duration',`Durationperiod`='$Durationperiod',`gender`='$gender_idm',`MinimumAge`='$minimum_agem',`MaximumAge`='$maximum_agem' where id='$id'";
$mysqli->query($sqlA2);
	


echo "<script>window.close();</script>";
echo "
<script type=\"text/javascript\">
        alert('Infomation has been updated, please wait..');
        window.close();
</script>";


}//end post


?>


<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
$rInvestigator=$result->fetch_array();
$countryid=$rInvestigator['country_id'];
$districtm_id=$rInvestigator['district_id'];
$Municipality=$rInvestigator['Municipality'];
$municipalitityID=$rInvestigator['Municipality'];

$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();

$sqlDistrict = "select * FROM ".$prefix."districts where districtm_id='$districtm_id'";//and conceptm_status='new' 
$resultDistrict = $mysqli->query($sqlDistrict);
$rDistrict=$resultDistrict->fetch_array();
////municipalities
$sqlmunicipalities = "select * FROM ".$prefix."municipalities where municipalitityID='$municipalitityID'";//and conceptm_status='new' 
$resultmunicipalities = $mysqli->query($sqlmunicipalities);
$rmunicipalities=$resultmunicipalities->fetch_array();
?>

<?php 

if(isset($message)){echo $message;}
?>

<form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required"  onChange="getRecruitCountry(this.value)">
<option value="">Please Select Country</option>

<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>" <?php if($rCountrycv['id']==$countryid){?>selected<?php }?>><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
</div>
</div> 



<div id="ifuganda"><!--Begin if Uganda-->

 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">District:</label>
<div class="col-sm-10">

<select name="district_id" id="district_id" class="form-control  required"  onChange="getMunicipality(this.value)">
<?php
$sqlDistrictv = "select * FROM ".$prefix."list_districts order by name asc";//and conceptm_status='new' 
$resultDistrictcv = $mysqli->query($sqlDistrictv);
while($rDistrictcv=$resultDistrictcv->fetch_array()){
?>
<option value="<?php echo $rDistrictcv['id'];?>" <?php if($rDistrictcv['id']==$districtm_id){?>selected<?php }?>><?php echo $rDistrictcv['name'];?></option>
<?php }?>
</select>
</div></div>
</div><!--End if Uganda-->



 <div id="municipalitydiv">
 
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">County/ Municipality:</label>
<div class="col-sm-10">

<select name="Municipality" id="recAffiliated_id" class="form-control  required"  onchange="getSubcounty(<?php echo $country;?>,this.value)">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."municipalities order by municipalitityName asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['municipalitityID'];?>" <?php if($rClinicalcv2['municipalitityID']==$Municipality){?>selected<?php }?>><?php echo $rClinicalcv2['municipalitityName'];?></option>
<?php }?>
</select>
</div></div>
 
 
 
 
 </div>
 
 <div id="subcountydivs">
 
 
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Sub County:</label>
<div class="col-sm-10">
<input type="text" name="SubCounty" id="recAffiliated_id" class="form-control  required" value="<?php echo $rInvestigator['SubCounty'];?>" required>
</div></div>
 
 
  <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Parish:</label>
<div class="col-sm-10">
<input type="text" name="Parish" id="participants" class="form-control  required" value="<?php echo $rInvestigator['Parish'];?>" required>
</div></div>
 
 
 
 
 
 </div>

<!--<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Sub County:</label>
<div class="col-sm-10">
<input type="text" name="SubCounty" id="participants" class="form-control  required" value="" required>

</div>
</div>-->



<div class="form-group row">

<label class="col-sm-2 form-control-label">Duration:</label>
<div class="col-sm-4">
<input name="Duration" type="text" id="Duration"  class="form-control  required" value="<?php echo $rInvestigator['Duration'];?>"/>
</div>
 
<label class="col-sm-2 form-control-label">Period:</label>
<div class="col-sm-4">
<select name="Durationperiod" id="Durationperiod" class="form-control  required">
    <option value="">------</option>
    <option value="Days" <?php if($rInvestigator['Durationperiod']=='Days'){?>selected <?php }?>>Days</option>
<option value="Months" <?php if($rInvestigator['Durationperiod']=='Months'){?>selected <?php }?>>Months</option>
<option value="Years" <?php if($rInvestigator['Durationperiod']=='Years'){?>selected <?php }?>>Years</option>
</select>
</div>





</div>

 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">No of Participants:</label>
<div class="col-sm-10">
<input type="number" name="participants" id="participants" class="form-control  required" value="<?php echo $rInvestigator['participants'];?>" required>
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>
</div>


 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Sex:</label>
<div class="col-sm-10">
  <select name="gender_id" id="gender_id" class="form-control" required>
    <option value="">Please select Sex</option>
<?php
$sqlGender = "select * FROM ".$prefix."list_gender  where display='Yes' order by status asc";//and conceptm_status='new' 
$resultGender = $mysqli->query($sqlGender);
while($rGender=$resultGender->fetch_array()){
?>
<option value="<?php echo $rGender['id'];?>" <?php if($rGender['id']==$rInvestigator['gender']){?>selected="selected"<?php }?>><?php echo $rGender['name'];?></option>
<?php }?>
</select>
</div>


</div>


<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Minimum Age:</label>
<div class="col-sm-10">
<input type="text" name="minimum_age" id="minimum_age" class="form-control number" value="<?php echo $rInvestigator['MinimumAge'];?>" autocomplete="off" required>
</div>


</div>

<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Maximum Age:</label>
<div class="col-sm-10">
<input type="text" name="maximum_age" id="maximum_age" class="form-control number" value="<?php echo $rInvestigator['MaximumAge'];?>"  autocomplete="off" required>
</div>


</div>
                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doCountry" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>             
     

   
                                     
</div>













<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>
         
         
            </div>
          </section>
          <!-- Client Section-->

          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-10">
                  <p>&copy; Uganda National Council for Science and Technology - UNCST, <?php echo date("Y");?>. All rights reserved</p>
                </div>
            
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
<?php /*?> <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"> </script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/charts-home.js"></script><?php */?>
    <script src="js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
    
    <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


  </body>
</html>