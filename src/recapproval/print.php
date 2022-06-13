<?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php'); 
timeout($timeout);
if(!$mysqli->real_escape_string($_SESSION['username']) and !$mysqli->real_escape_string($_SESSION['asrmApplctID']))
{
header("location: $base_url");
//header("location:".$base_url);
	
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
   <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">-->
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
   <!-- <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 <link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>

<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>
  <link rel="stylesheet" type="text/css" href="css/tcal.css" />
	<script type="text/javascript" src="js/tcal.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    

    <!--End Word count-->
  </head>
  <body>
    <div class="page home-pagess">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
         
         
        </nav>
      </header>
      <div class="page-contentss d-flex align-items-stretchsss">
        <!-- Side Navbar -->
    
        <div class="content-innerss">
          <!-- Page Header-->

          <!-- Projects Section-->
          
            <div class="container-fluidss" style="border:1px solid #ccc; width:90%; margin:0 auto; padding:5px;">
<?php $id=$_GET['pr'];?>
<button class="accordion">Protocol Information</button>

  <?php
  $sqlprotocalSub="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSub = $mysqli->query($sqlprotocalSub);
$rprotocalSub = $QprotocalSub->fetch_array();
$protocol_id=$rprotocalSub['protocol_id'];
$iowner_id=$rprotocalSub['owner_id'];
$owner_id=$rprotocalSub['owner_id'];
$sqlprotocalSub2="SELECT * FROM ".$prefix."protocol where  id='$protocol_id'";
$QprotocalSub2 = $mysqli->query($sqlprotocalSub2);
$rprotocalSub2 = $QprotocalSub2->fetch_array();

$sqlclinical="SELECT * FROM ".$prefix."submission_clinical_trial where  owner_id='$iowner_id' and submission_id='$protocol_id'";
$QClinical = $mysqli->query($sqlclinical);
$rClinical = $QClinical->fetch_array();
$clinical_trial_name_id2=$rClinical['id'];

$sqlclinical2="SELECT * FROM ".$prefix."list_clinical_trial_name where  id='$clinical_trial_name_id2'";
$QClinical2 = $mysqli->query($sqlclinical2);
$rClinical2 = $QClinical2->fetch_array();
?>
<h3><?php echo $rprotocalSub['public_title'];?></h3>
  <table width="100%" border="0">
  <tr>
    <td><strong>Identification</strong></td>
    <td><strong>Protocol</strong></td>
    <td><strong>Protocol Type</strong></td>
    <td><strong>Status</strong></td>
  </tr>
  <tr>
    <td>0000<?php echo $rprotocalSub['protocol_id'];?></td>
    <td><?php echo $rprotocalSub2['code'];?></td>
    <td><?php if($rprotocalSub['is_clinical_trial']==1){?>Clinical Trial<?php }?>
  <?php if($rprotocalSub['is_clinical_trial']==0){?>Research<?php }?></td>
    <td><?php echo $rprotocalSub['status'];?></td>
  </tr>
  <tr>
    <td style="padding-top:20px;"><strong>Institution</strong></td>
    <td><strong>Updated</strong></td>
    <td><strong>Decision</strong></td>
    <td><strong>Finished</strong></td>
  </tr>
  <tr>
    <td><?php echo $rClinical2['name'];?></td>
    <td><?php echo $rprotocalSub['updated'];?></td>
    <td>&nbsp;</td>
    <td><?php echo $rprotocalSub['updated'];?></td>
  </tr>

 <!--  <tr>
    <td style="padding-top:20px;"><strong>Recruiting</strong></td>
    <td><strong>Monitoring</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
  
  
</table>

  
    <hr />
  <h3 style="font-size:14px; background:#ADCEE2; color:#000000; padding:10px;">Team Members </h3> 
  
 <table id="customers">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution</th>
                            <th>Email</th>
                            <th>Country</th>
                       <th>HSP/GCP Training </th>
                       <th>Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."team where owner_id='$owner_id' and protocol_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['countryid'];
$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rInvestigator['name'];?></td>
                            <td><?php echo $rInvestigator['institution'];?></td>
                            <td><?php echo $rInvestigator['email'];?></td>
                            <td><?php echo $rCountry['name'];?></td>
                           <td>
                           
                          
<?php if($rInvestigator['GCPtraining']){?><a href="./files/uploads/<?php echo $rInvestigator['GCPtraining'];?>" style="color:#06F; font-weight:bold; font-size:12px;" target="_blank">View File</a><?php }?>
                           
                            </td>
                            
                             <td>
                             
                           <?php if($rInvestigator['employment']==1){?>   
                             <input id="go" type="button" value="View Details" onclick="window.open('<?php echo $base_url;?>recapproval/viewbiodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" >
                             <?php }?>
                             
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
                      
                      <br><br>
  

  




<button class="accordion">Protocol Details</button>

  <?php
  $sqlprotocalSubrr="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSubrr = $mysqli->query($sqlprotocalSubrr);
$rprotocalSubrr = $QprotocalSubrr->fetch_array();
$protocol_idrr=$rprotocalSubrr['protocol_id'];
$iowner_idrr=$rprotocalSubrr['owner_id'];
?>
  <label class="form-control-label"><strong style="font-weight:bold;">Summary:</strong> <?php echo $rprotocalSubrr['abstract'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Keywords:</strong> <?php echo $rprotocalSubrr['keywords'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Introduction:</strong> <?php echo $rprotocalSubrr['introduction'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Justification:</strong> <?php echo $rprotocalSubrr['justification'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Objectives:</strong></label><br />

<?php
$qRPersoneld="select * from ".$prefix."other_objectives  where  protocol_id='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows['objective'];?></label><br />
<?php
}
?> 



<button class="accordion">Budget Information</button>

   <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$owner_id' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

 $Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$owner_id' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

 <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$owner_id' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

$Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$owner_id' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

<h4> International Expenditure - Research Expenses to be covered outside Uganda</h4>
 

<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table">
  <tr>
    <td width="363" align="center" valign="bottom">&nbsp;</td>
    <td width="187" align="center" valign="bottom"><strong>Year 1<br />
      (US $)</strong></td>
    <td width="152" align="center" valign="bottom"><strong>Year 2<br />
      (US $)</strong></td>
    <td width="169" align="center" valign="bottom"><strong>Year 3<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 4<br />
       (US $)</strong></td>
    <td width="156" align="center" valign="bottom"><strong>Year 5<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>TOTAL</strong></td>
  </tr>
  <tr>
    <td width="363" align="left" valign="bottom"><strong>Personnel</strong></td>
    <td width="187" align="center" valign="bottom"><?php if($rS['rstug_personnel_year1']){echo $rS['rstug_personnel_year1'];}else{ echo "0";}?></td>
    <td width="152" align="center" valign="bottom"><?php if($rS['rstug_personnel_year2']){echo $rS['rstug_personnel_year2'];}else{ echo "0";}?></td>
    <td width="169" align="center" valign="bottom"><?php if($rS['rstug_personnel_year3']){echo $rS['rstug_personnel_year3'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year4']){echo $rS['rstug_personnel_year4'];}else{ echo "0";}?></td>
     <td width="156" align="center" valign="bottom"><?php if($rS['rstug_personnel_year5']){echo $rS['rstug_personnel_year5'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_total']){echo $rS['rstug_personnel_total'];}else{ echo "0";}?></td>
  </tr>
  <tr>
    <td width="363" align="left" valign="bottom"><strong>Travel <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><?php if($rS['rstug_travel_year1']){echo $rS['rstug_travel_year1'];}else{ echo "0";}?></td>
    <td width="152" align="center" valign="bottom"><?php if($rS['rstug_travel_year2']){echo $rS['rstug_travel_year2'];}else{ echo "0";}?></td>
    <td width="169" align="center" valign="bottom"><?php if($rS['rstug_travel_year3']){echo $rS['rstug_travel_year3'];}else{ echo "0";}?></td>
   
   
   <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year4']){echo $rS['rstug_travel_year4'];}else{ echo "0";}?></td>
   
   <td width="156" align="center" valign="bottom"><?php if($rS['rstug_travel_year5']){echo $rS['rstug_travel_year5'];}else{ echo "0";}?></td>
   
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_total']){echo $rS['rstug_travel_total'];}else{ echo "0";}?></td>
  </tr>
  <tr>
    <td width="363" align="left" valign="bottom"><strong>Materials and Supplies</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_materials_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_materials_year2'];?></td>
    <td width="169" align="center" valign="bottom"><?php echo $rS['rstug_materials_year3'];?></td>
    
    
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year4'];?></td>
<td width="156" align="center" valign="bottom"><?php echo $rS['rstug_materials_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_total'];?></td>
  </tr>
  <tr>
    <td width="363" align="left" valign="bottom"><strong>Administration</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year2'];?></td>
    <td width="169" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year3'];?></td>
    
    
 <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year4'];?></td>
  <td width="156" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year5'];?></td>
  
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_total'];?></td>
  </tr>
  <tr>
    <td width="363" align="left" valign="bottom"><strong>Results dissemination</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_results_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_results_year2'];?></td>
    <td width="169" align="center" valign="bottom"><?php echo $rS['rstug_results_year3'];?></td>
    
     <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year4'];?></td>
      <td width="156" align="center" valign="bottom"><?php echo $rS['rstug_results_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_total'];?></td>
  </tr>
 
  <tr>
    <td width="363" align="left" valign="bottom"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_contigency_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_contigency_year2'];?></td>
    <td width="169" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year4'];?></td>
    <td width="156" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_total'];?></td>
  </tr> 
  
   <tr>
     <td width="363" align="left" valign="bottom"><strong>Reimbursement and Time Compensations </strong></td>
     <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_reimbursement_year1'];?></td>
     <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_reimbursement_year2'];?></td>
     <td width="169" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year3'];?></td>
     
     
     <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year4'];?></td>
     <td width="156" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year5'];?></td>
     
     
     <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_total'];?></td>
   </tr>
   <tr>
     <td width="363" align="left" valign="bottom"><strong>Other</strong></td>
     <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_other_year1'];?></td>
     <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_other_year2'];?></td>
     <td width="169" align="center" valign="bottom"><?php echo $rS['rstug_other_year3'];?></td>
     
  <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year4'];?></td>
  <td width="156" align="center" valign="bottom"><?php echo $rS['rstug_other_year5'];?></td>
     
     <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_total'];?></td>
   </tr>
<?php
$year1=($rS['rstug_personnel_year1']+$rS['rstug_travel_year1']+$rS['rstug_materials_year1']+$rS['rstug_adminstration_year1']+$rS['rstug_results_year1']+$rS['rstug_other_year1']+$rS['rstug_contigency_year1']);

$year2=($rS['rstug_personnel_year2']+$rS['rstug_travel_year2']+$rS['rstug_materials_year2']+$rS['rstug_adminstration_year2']+$rS['rstug_results_year2']+$rS['rstug_other_year2']+$rS['rstug_contigency_year2']);

$year3=($rS['rstug_personnel_year3']+$rS['rstug_travel_year3']+$rS['rstug_materials_year3']+$rS['rstug_adminstration_year3']+$rS['rstug_results_year3']+$rS['rstug_other_year3']+$rS['rstug_contigency_year3']);

$year4=($rS['rstug_personnel_year4']+$rS['rstug_travel_year4']+$rS['rstug_materials_year4']+$rS['rstug_adminstration_year4']+$rS['rstug_results_year4']+$rS['rstug_other_year4']+$rS['rstug_contigency_year4']);

$year5=($rS['rstug_personnel_year5']+$rS['rstug_travel_year5']+$rS['rstug_materials_year5']+$rS['rstug_adminstration_year5']+$rS['rstug_results_year5']+$rS['rstug_other_year5']+$rS['rstug_contigency_year5']);
?>
 <tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="187" align="center" valign="bottom"><strong><?php echo $year1;?></strong></td>
    <td width="152" align="center" valign="bottom"><strong><?php echo $year2;?></strong></td>
    <td width="169" align="center" valign="bottom" ><strong><?php echo $year3;?></strong></td>
    <td width="154" align="center" valign="bottom" ><strong><?php echo $year4;?></strong></td>
    <td width="156" align="center" valign="bottom" ><strong><?php echo $year5;?></strong></td>
    <td width="154" align="center" valign="bottom" ><b><?php
	
	$grandTotal=($rS['rstug_personnel_total']+$rS['rstug_travel_total']+$rS['rstug_materials_total']+$rS['rstug_adminstration_total']+$rS['rstug_results_total']+$rS['rstug_other_total']+$rS['rstug_contigency_total']);
	
	 echo $grandTotal;$grandTotal="";?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>









<div class="class" style="clear:both;"></div>
<h4> Local Expenditure - Research Expenses to be covered in Uganda</h4>


<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table">
  <tr>
    <td width="184" align="center" valign="bottom">&nbsp;</td>
    <td width="187" align="center" valign="bottom"><strong>Year 1<br />
      (US $)</strong></td>
    <td width="152" align="center" valign="bottom"><strong>Year 2<br />
      (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 3<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 4<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 5<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>TOTAL</strong></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Personnel</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year1'];?>
    </td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year3'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year4'];?></td>
     <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year5'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Travel <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year3'];?></td>
   
   
   <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year4'];?></td>
   
   <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year5'];?></td>
   
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Materials and Supplies</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year3'];?></td>
    
    
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Administration</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year3'];?></td>
    
    
 <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year4'];?></td>
  <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year5'];?></td>
  
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Results dissemination</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year3'];?></td>
    
     <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year4'];?></td>
      <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_total'];?></td>
  </tr>
 
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_contigency_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_contigency_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_total'];?></td>
  </tr>
  
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Reimbursement and Time Compensations </strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_reimbursement_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_reimbursement_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_total'];?></td>
  </tr>

  
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year3'];?></td>
    
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_total'];?></td>
  </tr>
<?php
$year11=($rSLocal['rstug_personnel_year1']+$rSLocal['rstug_travel_year1']+$rSLocal['rstug_materials_year1']+$rSLocal['rstug_adminstration_year1']+$rSLocal['rstug_results_year1']+$rSLocal['rstug_other_year1']+$rSLocal['rstug_contigency_year1']);

$year22=($rSLocal['rstug_personnel_year2']+$rSLocal['rstug_travel_year2']+$rSLocal['rstug_materials_year2']+$rSLocal['rstug_adminstration_year2']+$rSLocal['rstug_results_year2']+$rSLocal['rstug_other_year2']+$rSLocal['rstug_contigency_year2']);

$year33=($rSLocal['rstug_personnel_year3']+$rSLocal['rstug_travel_year3']+$rSLocal['rstug_materials_year3']+$rSLocal['rstug_adminstration_year3']+$rSLocal['rstug_results_year3']+$rSLocal['rstug_other_year3']+$rSLocal['rstug_contigency_year3']);

$year44=($rSLocal['rstug_personnel_year4']+$rSLocal['rstug_travel_year4']+$rSLocal['rstug_materials_year4']+$rSLocal['rstug_adminstration_year4']+$rSLocal['rstug_results_year4']+$rSLocal['rstug_other_year4']+$rSLocal['rstug_contigency_year4']);

$year55=($rSLocal['rstug_personnel_year5']+$rSLocal['rstug_travel_year5']+$rSLocal['rstug_materials_year5']+$rSLocal['rstug_adminstration_year5']+$rSLocal['rstug_results_year5']+$rSLocal['rstug_other_year5']+$rSLocal['rstug_contigency_year5']);
?>
 <tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="143" align="center" valign="bottom"><strong><?php echo $year11;?></strong></td>
    <td width="148" align="center" valign="bottom"><strong><?php echo $year22;?></strong></td>
    <td width="169" align="center" valign="bottom" ><strong><?php echo $year33;?></strong></td>
    <td width="151" align="center" valign="bottom" ><strong><?php echo $year44;?></strong></td>
    <td width="156" align="center" valign="bottom" ><strong><?php echo $year55;?></strong></td>
    <td width="115" align="center" valign="bottom" ><b><?php
	
	$grandTotal2=($rSLocal['rstug_personnel_total']+$rSLocal['rstug_travel_total']+$rSLocal['rstug_materials_total']+$rSLocal['rstug_adminstration_total']+$rSLocal['rstug_results_total']+$rSLocal['rstug_other_total']+$rSLocal['rstug_contigency_total']);
	
	 echo $grandTotal2;$grandTotal2="";?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>
 <?php
  $sqlstudyff="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudyff = $mysqli->query($sqlstudyff);
$rstudyff = $Querystudyff->fetch_array(); 
?>              
               
                 
<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table">

  <tr>
    <td width="363" align="left" valign="bottom"><strong>Primary Sponsor:</strong> <?php echo $rstudyff['primary_sponsor'];?>
    
    </td>
    <td width="187"  valign="bottom">  
    <strong>Country: </strong>
    <?php
$PrimarySponsorCountry=$rstudyff['PrimarySponsorCountry'];
$sqlCountrycv = "select * FROM ".$prefix."list_country where id='$PrimarySponsorCountry' order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
$rCountrycv=$resultCountrycv->fetch_array();
echo $rCountrycv['name'];?>
    </td>
    <td width="152"  valign="bottom"><strong>Institution:</strong> <?php echo $rstudyff['PrimarySponsorInstitution'];?></td>
  </tr>
  
  
  
  <tr>

    <td width="187"  valign="bottom"> <strong>Secondary Sponsor:</strong>
       <?php echo $rstudyff['secondary_sponsor'];?></td>
       
    <td width="152"  valign="bottom"><strong>Country:</strong>

<?php
$SecondarySponsorCountry=$rstudyff['SecondarySponsorCountry'];
$sqlCountrycv2 = "select * FROM ".$prefix."list_country where id='$SecondarySponsorCountry' order by name asc";//and conceptm_status='new' 
$resultCountrycv2 = $mysqli->query($sqlCountrycv2);
$rCountrycv2=$resultCountrycv2->fetch_array();
?>
<?php echo $rCountrycv2['name'];?></td>


  
    <td valign="bottom"><strong>Institution:</strong>
       <?php echo $rstudyff['SecondarySponsorInstitution'];?></td>
  </tr>
</table>
                



<button class="accordion">Study Description</button>

  
  <h3>Recruitment Countries & Districts:</h3>
  
 <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Parish</th>
                            <th>Duration</th>
                            <th>Total No of participants</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' $owner_id
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
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
                          <tr>
                            <td><?php echo $rCountry['name'];?></td>
                            <td><?php echo $rDistrict['districtm_name'];?></td>
                            <td><?php echo $rmunicipalities['municipalitityName'];?></td>
                            <td><?php echo $rInvestigator['SubCounty'];?></td>
                            <td><?php echo $rInvestigator['Parish'];?></td>
                            <td><?php echo $rInvestigator['Duration'];?> <?php echo $rInvestigator['Durationperiod'];?></td>
                            <td><?php echo $rInvestigator['participants'];?></td>
                          </tr>
   <?php 
   $Totalparticipants=($rInvestigator['participants']+$Totalparticipants);}///////////end function ?>  
   
    <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $Totalparticipants;?></td>
                          </tr>                
                        </tbody>
                      </table>
   
   <table width="80%" border="0" id="POITable" class="htheadersm">
        <tr>
            <th width="20%"><strong>Gender:</strong>
            </th>
            <th width="20%"><strong>Minimum Age:</strong></th>
            <th width="20%"><strong>Maximum Age:</strong></th>
<th width="10%"><strong>Quantity:</strong></th>
<th width="10%"><strong>Duration:</strong></th>
        </tr>
        

   <?php 
$qRPersoneld2="select * from ".$prefix."study_description_age  where  protocol_id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);  
while ($rowRows2 = $RPersoneld2->fetch_array())
{$gender=$rowRows2['gender'];
	
$sqlGender2 = "select * FROM ".$prefix."list_gender where id='$gender'";//and conceptm_status='new' 
$resultGender2 = $mysqli->query($sqlGender2);
$rGender2=$resultGender2->fetch_array();
	
	 ?>
<tr>
            <td id="grid"><?php echo $rGender2['name'];?> </td>
            <td id="grid"><?php echo $rowRows2['MinimumAge'];?> </td>
            <td id="grid"><?php echo $rowRows2['MaximumAge'];?> </td>
            <td id="grid"><?php echo $rowRows2['quantity'];?> </td>
            <td id="grid"><?php echo $rowRows2['Duration'];?> </td>
                </tr>

<?php
$Qty=($rowRows2['quantity']+$Qty);
}

?> 
<tr>
            <td id="grid">&nbsp;</td>
            <td id="grid">&nbsp;</td>
            <td id="grid">&nbsp; </td>
            <td id="grid"><?php echo $Qty;?> </td>
            <td id="grid">&nbsp;</td>
                </tr>
    </table>                     
              
   <?php
   
 $sqlstudyDD="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$QuerystudyDD = $mysqli->query($sqlstudyDD);
$rstudyDD = $QuerystudyDD->fetch_array();  
   
    ?>         

<label class="form-control-label"><strong style="font-weight:bold;">Study design:</strong> <?php echo $rstudyDD['funding_source'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Health Condition or Problem Studied:</strong> <?php echo nl2br($rstudyDD['health_condition']);?></label>

 


<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where protocol_id='$id' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?>



<label class="form-control-label"><strong style="font-weight:bold;">Inclusion criteria:</strong> <?php echo nl2br($rstudymethodology['inclusion_criteria']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Exclusion criteria:</strong> <?php echo nl2br($rstudymethodology['exclusion_criteria']);?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Estimated date of initial recruitment:</strong> <?php echo $rstudyDD['recruitment_init_date'];?></label> 
<hr />
<label class="form-control-label"><strong style="font-weight:bold;">Interventions:</strong> <?php echo nl2br($rstudymethodology['interventions']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Primary outcomes:</strong> <?php echo nl2br($rstudymethodology['primary_outcome']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Secondary outcomes:</strong> <?php echo nl2br($rstudymethodology['secondary_outcome']);?></label>

<hr />


<label class="form-control-label"><strong style="font-weight:bold;">General Procedures:</strong> <?php echo nl2br($rstudymethodology['general_procedures']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Analysis Plan:</strong> <?php echo nl2br($rstudymethodology['analysis_plan']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Ethical Considerations:</strong> <?php echo nl2br($rstudymethodology['ethical_considerations']);?></label><br />



<label class="form-control-label"><strong style="font-weight:bold;">Secondary Registry:</strong> <?php echo $rstudyDD['clinical_trial_secondary'];?></label>
 <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Registry Name</th>
                            <th>Registry Number</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_clinical_trial where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$clinical_trial_name_id=$rInvestigator['clinical_trial_name_id'];
$sqlCountry = "select * FROM ".$prefix."list_clinical_trial_name where id='$clinical_trial_name_id' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
	?>
                          <tr>
                            <td><?php if($rInvestigator['NewClinicalRegistry']){echo $rInvestigator['NewClinicalRegistry'];}else{echo $rCountry['name'];}?></td>
                            <td><?php echo $rInvestigator['number'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>


<button class="accordion">Study Population, click to review</button>

  <div class="form-group row ">
<label class="form-control-label col-sm-12"><strong>Population: Proposed inclusion criteria:</strong> <span class="error">*</span><br />
  <?php 
$sqlstudyPop="SELECT * FROM ".$prefix."study_population where `owner_id`='$owner_id' and protocol_id='$id' order by id desc";
$QuerystudyPop = $mysqli->query($sqlstudyPop);// and owner_id='$owner_id'
$rstudyP = $QuerystudyPop->fetch_array();
  
  
$shcategoryID1=$rstudyP['ProposedInclusionCriteria'];
$categoryChunks1 = explode(".", $shcategoryID1);

$chop1="$categoryChunks1[0]";
$chop2="$categoryChunks1[1]";
  ?>                      
<?php
 echo $chop1.'<br>';
  echo $chop2.'<br>';
 ?></label>
</div>
<div class="line"></div>
                        
                        
    <div class="form-group row ">
    <?php
	$shcategoryID2=$rstudyP['VulnerableGroups'];
$categoryChunks2 = explode(".", $shcategoryID2);

?>
<label class="form-control-label col-sm-12"><strong style="font-weight:bold;">Vulnerable Groups</strong>: <span class="error">*</span><br />
 <?php 

$chop3="$categoryChunks2[0]";
$chop4="$categoryChunks2[1]";
$chop5="$categoryChunks2[2]";
$chop6="$categoryChunks2[3]";
$chop7="$categoryChunks2[4]";
$chop8="$categoryChunks2[5]";
$chop9="$categoryChunks2[6]";
$chop10="$categoryChunks2[7]";
$chop11="$categoryChunks2[8]";
$chop12="$categoryChunks2[9]";
$rstudyP['getValunalableGroups'];

if($chop3 and $chop3!='Other'){echo $chop3="$categoryChunks2[0]".'<br>';}
if($chop4 and $chop4!='Other'){echo $chop4="$categoryChunks2[1]".'<br>';}
if($chop5 and $chop5!='Other'){echo $chop5="$categoryChunks2[2]".'<br>';}
if($chop6 and $chop6!='Other'){echo $chop6="$categoryChunks2[3]".'<br>';}
if($chop7 and $chop7!='Other'){echo $chop7="$categoryChunks2[4]".'<br>';}
if($chop8 and $chop8!='Other'){echo $chop8="$categoryChunks2[5]".'<br>';}
if($chop9 and $chop9!='Other'){echo $chop9="$categoryChunks2[6]".'<br>';}
if($chop10 and $chop10!='Other'){echo $chop10="$categoryChunks2[7]".'<br>';}
if($chop11 and $chop11!='Other'){echo $chop11="$categoryChunks2[8]".'<br>';}
if($chop12 and $chop12!='Other'){echo $chop12="$categoryChunks2[9]".'<br>';}
if($chop3|| $chop4 || $chop5 || $chop6 || $chop7 || $chop8 || $chop9 || $chop10 || $chop11 || $chop12 and $rstudyP['getValunalableGroups']){echo $rstudyP['getValunalableGroups'];}?>
                     
</label>
                       
                        </div>
                       <div class="line"></div> 
   
                         
                     <div class="form-group row ">

   <?php
	$shcategoryID3=$rstudyP['TypeofStudy'];
$categoryChunks3 = explode(".", $shcategoryID3);
?>
<label class="form-control-label col-sm-12 "><strong style="font-weight:bold;">Type of study (check all that applies)</strong><br />
 <?php
$chopTS1="$categoryChunks3[0]";
$chopTS2="$categoryChunks3[1]";
$chopTS3="$categoryChunks3[2]";
$chopTS4="$categoryChunks3[3]";
$chopTS5="$categoryChunks3[4]";
$chopTS6="$categoryChunks3[5]";
$chopTS7="$categoryChunks3[6]";
$chopTS8="$categoryChunks3[7]";
$chopTS9="$categoryChunks3[8]";

if($chopTS1 and $chopTS1!='Other'){echo $chopTS1="$categoryChunks3[0]".'<br>';}
if($chopTS2 and $chopTS2!='Other'){echo $chopTS2="$categoryChunks3[1]".'<br>';}
if($chopTS3 and $chopTS3!='Other'){echo $chopTS3="$categoryChunks3[2]".'<br>';}
if($chopTS4 and $chopTS4!='Other'){echo $chopTS4="$categoryChunks3[3]".'<br>';}
if($chopTS5 and $chopTS5!='Other'){echo $chopTS5="$categoryChunks3[4]".'<br>';}
if($chopTS6 and $chopTS6!='Other'){echo $chopTS6="$categoryChunks3[5]".'<br>';}
if($chopTS7 and $chopTS7!='Other'){echo $chopTS7="$categoryChunks3[6]".'<br>';}
if($chopTS8 and $chopTS8!='Other'){echo $chopTS8="$categoryChunks3[7]".'<br>';}
if($chopTS1 || $chopTS2 || $chopTS3 || $chopTS4 || $chopTS5 || $chopTS6 || $chopTS7 || $chopTS8 and $rstudyP['getTypeofStudy']){echo $rstudyP['getTypeofStudy'];}

?>
</label>
  
                       
    </div>
                        
                 <div class="line"></div>   
                     <div class="form-group row ">
                      <label class="form-control-label col-sm-12"><strong style="font-weight:bold;">Consent Process</strong> : <span class="error">*</span><br />
 <?php
	$shcategoryID3=$rstudyP['ConsentProcess'];
$categoryChunks3 = explode(".", $shcategoryID3);




?>   

<?php

$chopCP1="$categoryChunks3[0]";
$chopCP2="$categoryChunks3[1]";
$chopCP3="$categoryChunks3[2]";
$chopCP4="$categoryChunks3[3]";
$chopCP5="$categoryChunks3[4]";
$rstudyP['getConsentProcess'];


if($chopCP1 and $chopCP1!='Other'){echo $chopCP1="$categoryChunks3[0]".'<br>';}
if($chopCP2 and $chopCP2!='Other'){echo $chopCP2="$categoryChunks3[1]".'<br>';}
if($chopCP3 and $chopCP3!='Other'){echo $chopCP3="$categoryChunks3[2]".'<br>';}
if($chopCP4 and $chopCP4!='Other'){echo $chopCP4="$categoryChunks3[3]".'<br>';}
if($chopCP5 and $chopCP5!='Other'){echo $chopCP5="$categoryChunks3[4]".'<br>';}
if($chopCP1 || $chopCP2 || $chopCP3 || $chopCP4 || $chopCP5 and $rstudyP['getConsentProcess']){echo $rstudyP['getConsentProcess'];}

?>

  </label>      
                       
    </div> 
                     
              
                             
                         <div class="line"></div>   

<div class="form-group row ">
 <?php
	$shcategoryID4=$rstudyP['Readinglevel'];
$categoryChunks4 = explode(".", $shcategoryID4);
?>

<label class="form-control-label col-sm-12"><strong  style="font-weight:bold;">Reading level of consent document</strong> : <span class="error">*</span><br />
<?php

$chopRL1="$categoryChunks4[0]";
$chopRL2="$categoryChunks4[1]";
$chopRL3="$categoryChunks4[2]";
$chopRL4="$categoryChunks4[3]";
$chopRL5="$categoryChunks4[4]";
$rstudyP['getReadingLevel'];

if($chopRL1 and $chopRL1!='Other'){echo $chopRL1="$categoryChunks4[0]".'<br>';}
if($chopRL2 and $chopRL2!='Other'){echo $chopRL2="$categoryChunks4[1]".'<br>';}
if($chopRL3 and $chopRL3!='Other'){echo $chopRL3="$categoryChunks4[2]".'<br>';}
if($chopRL4 and $chopRL4!='Other'){echo $chopRL4="$categoryChunks4[3]".'<br>';}
if($chopRL5 and $chopRL5!='Other'){echo $chopRL5="$categoryChunks4[4]".'<br>';}
if($chopRL1 || $chopRL2 || $chopRL3 || $chopRL4 || $chopRL5 and $rstudyP['getReadingLevel']){echo $rstudyP['getReadingLevel'];}
?>

<br /><label><strong  style="font-weight:bold;">Community Engagement plan</strong> : <span class="error">*</span><br />
<?php echo $rstudyP['CommunityEngagementplan'];?>                         
                       </label>
        
                       
    </div> 
                             
                    
                        
                        
                            <div class="line"></div>   
                     <div class="form-group row">
                      <label class="form-control-label col-sm-12"><strong>Determination of Risk (Check all that applies)</strong> : <span class="error">*</span></label>
                      <?php
$sqlstudyPop2="SELECT * FROM ".$prefix."determination_of_risk where `owner_id`='$owner_id' and protocol_id='$id' order by id desc";
$QuerystudyPop2 = $mysqli->query($sqlstudyPop2);
$rstudyP2 = $QuerystudyPop2->fetch_array();?>
  <table border="1" cellspacing="0" cellpadding="0" class="newtable3" width="98%" style="margin-left:15px;">
  <tr>
    <td width="625" valign="top"><p><strong>Does the research involve any of the    following</strong></p></td>
    <td width="54" valign="top"><p><strong>YES</strong></p></td>
    <td width="55" valign="top"><p><strong>NO</strong></p></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Human exposure to ionizing radiation</p></td>
    <td width="54" valign="top"><input name="Humanexposure" type="radio" value="Yes" <?php if($rstudyP2['Humanexposure']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Humanexposure" type="radio" value="No" <?php if($rstudyP2['Humanexposure']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Human genetics</p></td>
    <td width="54" valign="top"><input name="Humangenetics" type="radio" value="Yes" <?php if($rstudyP2['Humangenetics']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Humangenetics" type="radio" value="No" <?php if($rstudyP2['Humangenetics']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Stem Cells</p></td>
    <td width="54" valign="top">
    <input name="StemCells" type="radio" value="Yes" <?php if($rstudyP2['StemCells']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="StemCells" type="radio" value="No" <?php if($rstudyP2['StemCells']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Fetal    tissue or abortus</p></td>
    <td width="54" valign="top"><input name="Fetaltissue" type="radio" value="Yes" <?php if($rstudyP2['Fetaltissue']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Fetaltissue" type="radio" value="No" <?php if($rstudyP2['Fetaltissue']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Investigational    new drug</p></td>
    <td width="54" valign="top"><input name="Investigationalnewdrug" type="radio" value="Yes" <?php if($rstudyP2['Investigationalnewdrug']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Investigationalnewdrug" type="radio" value="No" <?php if($rstudyP2['Investigationalnewdrug']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Investigational    new device or technique (e.g. therapeutic, diagnostic)</p></td>
    
    <td width="54" valign="top"><input name="Investigationalnewdevice" type="radio" value="Yes" <?php if($rstudyP2['Investigationalnewdevice']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Investigationalnewdevice" type="radio" value="No" <?php if($rstudyP2['Investigationalnewdevice']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Existing    data available via public archives/sources</p></td>
    <td width="54" valign="top"><input name="Existingdataavailable" type="radio" value="Yes" <?php if($rstudyP2['Existingdataavailable']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Existingdataavailable" type="radio" value="No" <?php if($rstudyP2['Existingdataavailable']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Existing    data not available via public archives</p></td>
    <td width="54" valign="top"><input name="ExistingdataNotavailable" type="radio" value="Yes" <?php if($rstudyP2['ExistingdataNotavailable']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="ExistingdataNotavailable" type="radio" value="No" <?php if($rstudyP2['ExistingdataNotavailable']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Will    the research involve the use of stored samples/patient data</p></td>
    
    <td width="54" valign="top"><input name="storedsamples" type="radio" value="Yes" <?php if($rstudyP2['storedsamples']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="storedsamples" type="radio" value="No" <?php if($rstudyP2['storedsamples']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Will the research involve shipping/transfer of specimen</p></td>
     <td width="54" valign="top"><input name="transferofspecimen" type="radio" value="Yes" <?php if($rstudyP2['transferofspecimen']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="transferofspecimen" type="radio" value="No" <?php if($rstudyP2['transferofspecimen']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Observation    of public behaviour</p></td>
    <td width="54" valign="top"><input name="Observation" type="radio" value="Yes" <?php if($rstudyP2['Observation']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="Observation" type="radio" value="No"<?php if($rstudyP2['Observation']=='No'){?>checked="checked"<?php }?> /></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Is the    information going to be recorded in such a way that subjects can be    identified</p></td>    <td width="54" valign="top"><input name="recordedInfo" type="radio" value="Yes" <?php if($rstudyP2['recordedInfo']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="recordedInfo" type="radio" value="No" <?php if($rstudyP2['recordedInfo']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Does    the research deal with sensitive aspects of the subjects behaviour, sexual    behavior, alcohol use or illegal conduct such as drug use</p></td>
    <td width="54" valign="top"><input name="sensitiveaspects" type="radio" value="Yes" <?php if($rstudyP2['sensitiveaspects']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="sensitiveaspects" type="radio" value="No" <?php if($rstudyP2['sensitiveaspects']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Could the information recorded    about the individual if it became known outside of the research, place the    subject at risk of criminal prosecution or civil liability</p></td>
    <td width="54" valign="top"><input name="recordedInfobeRecorded" type="radio" value="Yes" <?php if($rstudyP2['recordedInfobeRecorded']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="recordedInfobeRecorded" type="radio" value="No" <?php if($rstudyP2['recordedInfobeRecorded']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p>Could    the information recorded about the individual if it became known outside of    the research, damage the subjects financial standing, reputation and    employability?</p></td>
    <td width="54" valign="top"><input name="recordedaboutindividual" type="radio" value="Yes" <?php if($rstudyP2['recordedaboutindividual']=='Yes'){?>checked="checked"<?php }?>/></td>
    <td width="55" valign="top"><input name="recordedaboutindividual" type="radio" value="No" <?php if($rstudyP2['recordedaboutindividual']=='No'){?>checked="checked"<?php }?>/></td>
  </tr>
</table>

  

                          
                          </label>
        
                       
    </div> 




  
  <button class="accordion">Methodology, click to review</button>

  <?php
   $sqlstudyDDw2="SELECT * FROM ".$prefix."clinical_study_methodology where protocol_id='$id' order by id desc limit 0,1";
$QuerystudyDDw2 = $mysqli->query($sqlstudyDDw2);
$rstudyDDw2 = $QuerystudyDDw2->fetch_array();  
?>

<label class="form-control-label"><strong style="font-weight:bold;">General Procedures:</strong> <?php echo nl2br($rstudyDDw2['general_procedures']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Analysis Plan:</strong> <?php echo nl2br($rstudyDDw2['analysis_plan']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Ethical Considerations:</strong> <?php echo nl2br($rstudyDDw2['ethical_considerations']);?></label>


  
 <button class="accordion">Study Work Plan</button>

  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Activity</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_task where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	?>
                          <tr>
                            <td><?php echo $rInvestigator['description'];?></td>
                     

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
 
  

  <button class="accordion">Attachments</button>

  
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>File name</th>
                            <th>Type</th>
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['user_id'];

$filem = "select * FROM ".$prefix."upload_type where id='$upload_type_id'";//and conceptm_status='new' 
$resultfile = $mysqli->query($filem);
$rfile=$resultfile->fetch_array();
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['filename'];?>" target="_blank">View File</a></td>
                            <td><?php echo $rfile['name'];?></td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function 
   $sqlstudyff="SELECT *,DATE_FORMAT(`updated`,'%d/%m/%Y %H:%s:%i') AS updated FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudyff = $mysqli->query($sqlstudyff);
$rstudyff = $Querystudyff->fetch_array(); 
$submittedBy=$rstudyff['owner_id'];
//user
$sqlUserup2 = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser2 = $mysqli->query($sqlUserup2);
$rUsers2=$resultUser2->fetch_array();
 ?>  
   
     <tr>
                            <td><a href="./files/uploads/<?php echo $rstudyff['paymentProof'];?>" >View File</a></td>
                            <td>Payment</td>
                            <td><?php echo $rUsers2['name'];?></td>
                            <td><?php echo $rstudyff['updated'];?></td>

                          </tr>                 
                        </tbody>
                      </table>
  
  
  
  
  
 <button class="accordion">Comments </button>

    <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Date & Time</th>
                            <th>Reviewer/Author</th>
                            <th>Message</th>
 
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$reviewer_session_id=$_SESSION['asrmApplctID'];
//if no page var is given, set start to 0
if($session_privillage=='investigator'){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where user_id='$owner_id' and protocol_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new'
}
//'investigator','secretary','membercommittee','memberadhoc','administrator','recadmin','recreviewer','rechairperson','superadmin','UHNRO','monitoring'
if($session_privillage=='recadmin'){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where protocol_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
}
if($session_privillage=='rechairperson' || $session_privillage=='superadmin' || $session_privillage=='administrator'){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where protocol_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
}

if($session_privillage=='recreviewer'){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where reviewer_id='$reviewer_session_id' and protocol_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
}
 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['user_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where (asrmApplctID='$submittedBy' OR asrmApplctID='$reviewer_session_id')";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
               <tr>
                            <td><?php echo $rInvestigator['created'];?></td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['screening'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
					  

  
  

  
 


            </div>
        
          <!-- Client Section-->

        </div>
      </div>
    </div>

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
 
  </body>
</html>