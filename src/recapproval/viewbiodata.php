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
            <?php
$sqlInvestigatorsT33="SELECT * FROM ".$prefix."team where `id`='$id'";
$QueryInvestigatorsTr22 = $mysqli->query($sqlInvestigatorsT33);
$Data = $QueryInvestigatorsTr22->fetch_array();
?>
         <h2 class="no-margin-bottom"><?php echo $Data['name'];?></h2>
 
            </div>
          </header>


          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
         
         
       <?php
//doSaveFive
if($_POST['doSaveFive']){


echo "<script>window.close();</script>";
/*echo "
<script type=\"text/javascript\">
        alert('Infomation has been updated, please wait..');
        window.close();
</script>";*/


}//end post



$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>

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
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' and protocol_id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
?>

<?php 

if(isset($message)){echo $message;}
?>

<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data" autocomplete="off">
    
                        
                        <div class="form-group row">
                        
                        <table width="100%">
                <tr>
<td colspan="2">

<h3 style="font-size:14px;" class="defmf">Employment <span class="error">*</span></h3><hr />
       
       
       <?php
$qRPersoneld2="select * from ".$prefix."employment_details  where teamMemberID='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);

if($RPersoneld2->num_rows){?>
<table width="80%" border="0" id="customers2"> 

 <tr>
            <th width="27%">Institution (in full)</th>
            <th width="27%">Designation</th>
            <th width="15%">Year</th>
            <th width="16%">Period (Years)</th>
            </tr>
 <?php
while ($rowRows2 = $RPersoneld2->fetch_array())
{ 
	?>

<tr>
            <td id="grid"><?php echo $rowRows2['rstug_institution'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_designation'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_year'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_period'];?> </td>
            </tr><?php } ?> 
</table>
<?php } ?> 
   
    
    
    <br />
   
   <h3 style="font-size:14px;" class="defmf">Education <span class="error">*</span></h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

        
        
             <?php
$qRPersoneld="select * from ".$prefix."education_history  where teamMemberID='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
if($RPersoneld->num_rows){?>
<table width="80%" border="0" id="customers2">
<tr>
            <th width="24%">Institution (in full)</th>
            <th width="26%">Qualification </th>
            <th width="11%">Year </th>
            <th width="28%">Field of  Specialization </th>

            </tr>
<?php
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>
<tr>
            <td><?php echo $rowRows['rstug_educn_university'];?> </td>
            <td><?php echo $rowRows['rstug_educn_designation'];?> </td>
            <td><?php echo $rowRows['rstug_educn_year'];?> </td>
            <td><?php echo $rowRows['rstug_educn_period'];?> 
              
            </td>
                 </tr>

<?php
}

?> 
        
        
    </table><?php }//end totas?> 
    
    
    
    </td>
    </tr>
    

                
              </table>
    
    
    
    
    
    </td>
    </tr>

                
              </table>
    </div>
                        
                        
                        

                        <div class="line"></div>
                        
                       
                       
                       
                       
                                               
   <h3 style="font-size:14px;" class="defmf">Recent Publications </h3> <hr />

        
        
             <?php
$qRPersoneld="select * from ".$prefix."publications  where owner_id='$asrmApplctID' and teamMemberID='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
if($RPersoneld->num_rows){?>
<table width="80%" border="0" id="customers2">
<tr>
            <th width="24%">Title</th>
            <th width="26%">Citation </th>
</tr>
<?php
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>
<tr>
            <td><?php echo $rowRows['title'];?> </td>
            <td><?php echo $rowRows['citation'];?> </td>
                </tr>

<?php
}

?> 
        
        
    </table><?php }//end totas?> 
    
    
    
    </td>
    </tr>
    

                
              </table>
    
    
    
    
    
    </td>
    </tr>

                
              </table>

      
                       
                       
                       
                       
                       
                       
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFive" type="submit"  class="btn btn-warning" value="Click to Close File"/>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./data/'" />-->
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