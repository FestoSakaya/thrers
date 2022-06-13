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
if($_POST['doSaveFive'] and $_POST['asrmApplctID'] and $id){

	$bibliography=$mysqli->real_escape_string($_POST['bibliography']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);


//insert into education
for ($i=0; $i < count($_POST['rstug_educn_designation']); $i++) {
$rstug_educn_university=$_POST['rstug_educn_university'][$i];
$rstug_educn_designation=$_POST['rstug_educn_designation'][$i];
$rstug_educn_year=$_POST['rstug_educn_year'][$i];
$rstug_educn_period=$_POST['rstug_educn_period'][$i];
$completionyeareduc=$_POST['completionyeareduc'][$i];

$sqlEduc="SELECT * FROM ".$prefix."education_history where `rstug_user_id`='$asrmApplctID' and teamMemberID='$id' and rstug_educn_university='$rstug_educn_university' and  rstug_educn_designation='$rstug_educn_designation' and  rstug_educn_year='$rstug_educn_year' order by rstug_educn_id desc limit 0,1";
$QueryEduc = $mysqli->query($sqlEduc);
$totalEduc = $QueryEduc->num_rows;

if(strlen($_POST['rstug_educn_designation'][$i])>=5 and !$totalEduc){
$Insert_QR2="insert into ".$prefix."education_history (`rstug_user_id`,`rstug_educn_university`,`rstug_educn_designation`,`rstug_educn_year`,`completionyear`,`rstug_educn_period`,`rstug_ammend`,`rstug_Synched`,`teamMemberID`) values ('$asrmApplctID','$rstug_educn_university','$rstug_educn_designation','$rstug_educn_year','$completionyeareduc','$rstug_educn_period','0','0','$id')";
$mysqli->query($Insert_QR2);
$record_id1 = $mysqli->insert_id;
}

if($record_id1){
$sqlA2Protocolamm="update ".$prefix."team  set `education`='1' where owner_id='$asrmApplctID' and id='$id'";
$mysqli->query($sqlA2Protocolamm);}

}
/////////////////////Begin


for ($i=0; $i < count($_POST['rstug_institution'][$i]); $i++) {
	$current_yearm = date('Y');
$institution=$_POST['rstug_institution'][$i];
$designation=$_POST['designation'][$i];
$year=$_POST['year'][$ii];
$completionyear=$_POST['completionyear'][$i];
//$period=$_POST['period'][$i];
$period=($current_yearm-$year);
$sqlEmploy="SELECT * FROM ".$prefix."employment_details where `rstug_user_id`='$asrmApplctID' and teamMemberID='$id' and rstug_institution='$institution' and rstug_designation='$designation' and rstug_year='$year' order by rstug_employment_id desc limit 0,1";
$QueryEmploy = $mysqli->query($sqlEmploy);
$totalEmploy = $QueryEmploy->num_rows;


if(strlen($_POST['rstug_institution'][$i])>=5 and !$totalEmploy){
$Insert_QR2="insert into ".$prefix."employment_details (`rstug_user_id`,`rstug_institution`,`rstug_designation`,`rstug_year`,`completionyear`,`rstug_period`,`rstug_ammend`,`teamMemberID`) values ('$asrmApplctID','$institution','$designation','$year','$completionyear','$period','0','$id')";
$inseted=$mysqli->query($Insert_QR2);
$record_id2 = $mysqli->insert_id;
}
//////////////update
if($record_id2){
$sqlA2Protocola="update ".$prefix."team  set `employment`='1' where owner_id='$asrmApplctID' and id='$id'";
$mysqli->query($sqlA2Protocola);
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, close the page and continue with your submission.</p>';
logaction("$session_fullname updated protocol, Bibliography Information");

}
}


for ($i=0; $i < count($_POST['title'][$i]); $i++) {
$titledd=$_POST['title'][$i];
$citationdd=$_POST['citation'][$i];

$sqlCitations="SELECT * FROM ".$prefix."publications where `owner_id`='$asrmApplctID' and title='$titledd' and citation='$citationdd' order by id desc limit 0,1";
$QueryCitations = $mysqli->query($sqlCitations);
$totalCitatons = $QueryCitations->num_rows;


if(!$totalCitatons and strlen($titledd)>5){
$Insert_QR2ff="insert into ".$prefix."publications (`owner_id`,`protocol_id`,`title`,`citation`,`created`,`teamMemberID`) values ('$asrmApplctID','','$titledd','$citationdd',now(),'$id')";
$mysqli->query($Insert_QR2ff);
$record_id3 = $mysqli->insert_id;
}
//////////////update
if($record_id3){
$sqlA2ProtocolaSS="update ".$prefix."team  set `publications`='1' where owner_id='$asrmApplctID' and id='$id'";
$mysqli->query($sqlA2ProtocolaSS);

}
}



echo "
<script type=\"text/javascript\">
        alert('Infomation has been updated, please wait..');
        window.close();
</script>";


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
<table width="80%" border="0" id="POITable" class="thhdeaders">
        <tr>
            <th width="6%" style=" display:none;">&nbsp;</th>
            <th width="21%"><strong>Institution (in full)<span class="error3">*</span>
            </strong></th>
            <th width="28%"><strong>Designation <span class="error3">*</span></strong></th>
            <th width="14%"><strong>Start Year <span class="error3">*</span></strong></th>


            <th width="13%">End Year *</th>
            <th width="18%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
            
            <input type="text" name="rstug_institution[]" id="cvd" tabindex="8" class="requiremd" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;"/>
            

            </td>
            <td><input type="text" name="designation[]" id="customss2" tabindex="5" class="requiredm" style="border:1px solid #7F9DB9;width:200px;background:#ffffff;padding:5px;"/></td>
  
          
  
  
            <td><select name="year[]" id="ssss" class="requiredm" style="border:1px solid #7F9DB9;width:60px;background:#ffffff;padding:5px;"  onChange="getNextYear(this.value)">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1950);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select></td>
       
           
            <td>
            
            <div id="nextyeardiv"></div>
            
           
            
            
            
            <input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/>
            
            </td>
            <td>
             
            <input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
       </table>
       
       
       <?php
if($_GET['emdcon']=='del'){
$em=$_GET['em'];
$qRDel2="delete from ".$prefix."employment_details where rstug_user_id='$asrmApplctID' and rstug_employment_id='$em'";
$mysqli->query($qRDel2);
}
$qRPersoneld2="select * from ".$prefix."employment_details  where rstug_user_id='$asrmApplctID' and teamMemberID='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);

if($RPersoneld2->num_rows){?>
<table width="80%" border="0" id="customers2"> 

 <tr>
            <th width="27%">Institution (in full)</th>
            <th width="27%">Designation</th>
            <th width="15%">Start Year</th>
            <th width="16%">End Year</th>
            <th width="16%">Period (Years)</th>
            <th width="15%">&nbsp;</th>
        </tr>
 <?php
while ($rowRows2 = $RPersoneld2->fetch_array())
{ 
	?>

<tr>
            <td id="grid"><?php echo $rowRows2['rstug_institution'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_designation'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_year'];?> </td>
            <td id="grid"><?php echo $rowRows2['completionyear'];?></td>
            <td id="grid"><?php echo $rowRows2['rstug_period'];?> </td>
        
            <td><a href="<?php echo $base_url;?>biodata.php?id=<?php echo $id;?>&emdcon=del&em=<?php echo $rowRows2['rstug_employment_id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
        </tr><?php } ?> 
</table>
<?php } ?> 
   
    
    
    <br />
   
   <h3 style="font-size:14px;" class="defmf">Education <span class="error">*</span></h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

<table width="80%" border="0" id="POITable2" class="thhdeaders">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="17%"><strong>Institution (in full)<span class="error3">*</span></strong></th>
            <th width="20%"><strong>Qualification <span class="error3">*</span></strong></th>
            <th width="10%"><strong>Start Year <span class="error3">*</span></strong></th>
            <th width="15%">End Year *</th>
            <th width="19%"><strong>Field of  Specialization <span class="error3">*</span></strong></th>

            <th width="2%">&nbsp;</th>
            <th width="15%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="rstug_educn_university[]" id="vvv" tabindex="8" class="requiredm" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;"/>
            </td>
            <td><input type="text" name="rstug_educn_designation[]" id="customss2" class="requiredm" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;"/></td>
  
          
  
  
            <td><select name="rstug_educn_year[]" id="ssss" class="requiredm" style="border:1px solid #7F9DB9;width:60px;background:#ffffff;padding:5px;" onChange="getNextYearM(this.value)">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1950);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select></td>
            <td> <div id="nextyearmmdiv"></div></td>
              <td>
            <input type="text" name="rstug_educn_period[]" id="ddd" tabindex="5" class="requiredm" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;"/>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow2(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow2()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
        
        
             <?php
if($_GET['emdeduc']=='del'){
$em=$_GET['em'];
$qRDel="delete from ".$prefix."education_history where rstug_user_id='$asrmApplctID' and rstug_educn_id='$em'";
$mysqli->query($qRDel);
}
$qRPersoneld="select * from ".$prefix."education_history  where rstug_user_id='$asrmApplctID' and teamMemberID='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
if($RPersoneld->num_rows){?>
<table width="80%" border="0" id="customers2">
<tr>
            <th width="24%">Institution (in full)</th>
            <th width="26%">Qualification </th>
            <th width="11%">Start Year </th>
            <th width="28%">End Year</th>
            <th width="28%">Field of  Specialization </th>

            <th width="11%">&nbsp;</th>

        </tr>
<?php
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>
<tr>
            <td><?php echo $rowRows['rstug_educn_university'];?> </td>
            <td><?php echo $rowRows['rstug_educn_designation'];?> </td>
            <td><?php echo $rowRows['rstug_educn_year'];?> </td>
            <td><?php echo $rowRows['completionyear'];?> </td>
            <td><?php echo $rowRows['rstug_educn_period'];?> 
            
            </td>
                 <td><a href="<?php echo $base_url;?>biodata.php?id=<?php echo $id;?>&emdeduc=del&em=<?php echo $rowRows['rstug_educn_id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
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
                        
                       
                         <div class="form-group row">
                          <?php /*?><label class="col-sm-2 form-control-label">Contact Person:</label>
                         
                            <input type="text" name="sscientific_contact" id="sscientific_contact" class="form-control  required" value="<?php echo $rstudy['sscientific_contact'];?>"><?php */?>
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
                        
                         <?php /*?> <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Prior Ethical Approval:</label>

                          <input name="prior_ethical_approval" type="radio" value="1" class="required"  onChange="getState(this.value)"/> Yes &nbsp;<input name="prior_ethical_approval" type="radio" value="0" class="required" onChange="getState(this.value)"/> No
  
                          
                          
                        </div>
                        <div id="statediv"></div><?php */?>
                        <div class="line"></div>
                        
                       
                       
                       
                       
                                               
   <h3 style="font-size:14px;" class="defmf">Recent Publications </h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

<table width="80%" border="0" id="POITable3" class="thhdeaders">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="22%"><strong>Title<span class="error3">*</span></strong></th>
            <th width="26%"><strong>Citation <span class="error3">*</span></strong></th>
            <th width="1%">&nbsp;</th>
            <th width="14%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
 <input type="hidden" name="ssss[]" id="vvv" tabindex="8" class="requiredm" minlength="5"/>   
             <textarea name="title[]" id="MyTextBox333" cols="" rows="5" class="form-control"><?php echo $rstudy['title'];?></textarea>



            </td>
            <td> 
            
         <input type="hidden" name="titleee[]" id="vvv" tabindex="8" class="requiredm" minlength="5"/>   
             <textarea name="citation[]" id="MyTextBox333" cols="" rows="5" class="form-control"><?php echo $rstudy['citation'];?></textarea></td>
  
          
  
  
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow3(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow3()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
        
        
             <?php
if($_GET['emdcitation']=='del'){
$em=$_GET['em'];
$qRDel="delete from ".$prefix."publications where owner_id='$asrmApplctID' and id='$em'";
$mysqli->query($qRDel);
}
$qRPersoneld="select * from ".$prefix."publications  where owner_id='$asrmApplctID' and teamMemberID='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
if($RPersoneld->num_rows){?>
<table width="80%" border="0" id="customers2">
<tr>
            <th width="24%">Title</th>
            <th width="26%">Citation </th>
<th width="11%">&nbsp;</th>
            <th width="11%">&nbsp;</th>

        </tr>
<?php
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>
<tr>
            <td><?php echo $rowRows['title'];?> </td>
            <td><?php echo $rowRows['citation'];?> </td>

  
                 <td colspan="2"><a href="<?php echo $base_url;?>biodata.php?id=<?php echo $id;?>&emdcitation=del&em=<?php echo $rowRows['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
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