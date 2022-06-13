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

         <h2 class="no-margin-bottom">Study Description</h2>
 
            </div>
          </header>


          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
         
         
     

<script>
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}
function deleteRow2(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable2').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}
function deleteRow3(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable3').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}
function insRow()
{
    console.log( 'hi');
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
	
    /*
	
	var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';
	
	var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
    inp4.id += len;
    inp4.value = '';
	
	new_row.cells[5].getElementsByTagName('input')[0].removeAttribute('style');	
	
	
	var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';*/
	
     new_row.cells[4].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}

function insRow2()
{
    console.log( 'hi');
    var x=document.getElementById('POITable2');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');*/

     new_row.cells[5].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}

function insRow3()
{
    console.log( 'hi');
    var x=document.getElementById('POITable3');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
	
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');*/

    new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}

</script>
<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$pid=$_GET['pid'];

if($_POST['doSaveFive']=='Save and Next'){
$gender_id=$mysqli->real_escape_string($_POST['gender_id']);
$MinimumAge=$mysqli->real_escape_string($_POST['MinimumAge']);
$MaximumAge=$mysqli->real_escape_string($_POST['MaximumAge']);
$Duration=$mysqli->real_escape_string($_POST['Duration']);
$quantity=$mysqli->real_escape_string($_POST['quantity']);

$Insert_QR2="update ".$prefix."study_description_age set  `gender`='$gender_id',`MinimumAge`='$MinimumAge',`MaximumAge`='$MaximumAge',`Duration`='$Duration',`quantity`='$quantity' where owner_id='$asrmApplctID' and protocol_id='$pid' and id='$id'";
$mysqli->query($Insert_QR2);

echo "
<script type=\"text/javascript\">
        alert('Infomation has been updated, please wait..');
        window.close();
</script>";
}

?>

<?php 

if(isset($message)){echo $message;}
?>


<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data" autocomplete="off">
    
                        
                        <div class="form-group row">


<h3 style="font-size:14px;" class="defmf">Update <span class="error">*</span></h3><hr />

       
 <table width="80%" border="0" id="POITable" class="htheadersm">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="20%"><strong>Sex:<span class="error">*</span></strong>
            </th>
            <th width="10%"><strong>Quantity:  <span class="error">*</span></strong></th>
            <th width="20%"><strong>Minimum Age:</strong></th>
            <th width="20%"><strong>Maximum Age:  <span class="error">*</span></strong></th>
            <th width="10%"><strong>Duration:  <span class="error">*</span></strong></th>

        </tr>
      
      <?php
$qRPersoneld2="select * from ".$prefix."study_description_age  where owner_id='$asrmApplctID' and protocol_id='$pid' and id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);  
while ($rowRows2 = $RPersoneld2->fetch_array())
{
	

	
	
	$gender=$rowRows2['gender'];
	
$sqlGender2 = "select * FROM ".$prefix."list_gender where id='$gender'";//and conceptm_status='new' 
$resultGender2 = $mysqli->query($sqlGender2);
$rGender2=$resultGender2->fetch_array();
	
	 ?>  
        <tr>
            <td style=" display:none;">1</td>
            <td>



   <select name="gender_id" id="gender_id" class="form-control" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;">
    <option value="">------</option>
<?php
$sqlGender = "select * FROM ".$prefix."list_gender  where display='Yes' order by status asc";//and conceptm_status='new' 
$resultGender = $mysqli->query($sqlGender);
while($rGender=$resultGender->fetch_array()){
?>
<option value="<?php echo $rGender['id'];?>" <?php if($rowRows2['gender']==$rGender['id']){?>selected="selected"<?php }?>><?php echo $rGender['name'];?></option>
<?php }?>
</select>


            </td>
             <td><input type="text" name="quantity" id="quantity" class="form-control number" value="<?php echo $rowRows2['quantity'];?>"  autocomplete="off"> </td>
            <td><input type="text" name="MinimumAge" id="MinimumAge" class="form-control number" value="<?php echo $rowRows2['MinimumAge'];?>" autocomplete="off"></td>
            
            <td><input type="text" name="MaximumAge" id="MaximumAge" class="form-control number" value="<?php echo $rowRows2['MaximumAge'];?>"  autocomplete="off">
            
            </td>

           <td>

           <select name="Duration" id="maximum_age_period" class="form-control">
    <option value="">------</option>
    <option value="Days" <?php if($rowRows2['Duration']=='Days'){?>selected="selected"<?php }?>>Days</option>
<option value="Months" <?php if($rowRows2['Duration']=='Months'){?>selected="selected"<?php }?>>Months</option>
<option value="Years" <?php if($rowRows2['Duration']=='Years'){?>selected="selected"<?php }?>>Years</option>
</select>
            
            </td>
            
     
        </tr>
      <?php }?>
      
        
        </table>

    

    </div>
                        
   
                       
                       
                       
                       
                       
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFive" type="submit"  class="btn btn-primary" value="Save and Next"/>

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