<?php
//doSaveFive

if($_POST['doFinalSave'] and $id and $_FILES['attachpayment']['name']){

$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
$type_of_payment=$mysqli->real_escape_string($_POST['type_of_payment']);
$submission_id=$mysqli->real_escape_string($_POST['submission_id']);

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$submission_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];
//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();
$public_title=$rstudyProtocol['public_title'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Numbers
if($_FILES['attachpayment']['name']){
$attachpayment = preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']);
$attachpayment2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachpayment']['tmp_name']), $targetw1);
/////update slip
$sqlA2Protocol="update ".$prefix."submission  set `paymentStatus`='Not Confirmed',`paymentProof`='$attachpayment2', `type_of_payment`='$type_of_payment' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);


$wm="select * from ".$prefix."submission_stages where  owner_id='$asrmApplctID' and protocol_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `payments`='1' where `owner_id`='$asrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}



}
if(!$_FILES['attachethicalapproval']['name']){
$sqlA2Protocol="update ".$prefix."submission  set `paymentStatus`='Not Paid' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);



//update edited table...
$sqlURevisions="SELECT * FROM ".$prefix."updated_sections where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='pending' order by id desc limit 0,1";
$QueryUserRevions = $mysqli->query($sqlURevisions);
$totalUsersRevions = $QueryUserRevions->num_rows;
if(!$totalUsersRevions){
$sqlAREvisedSections="insert into ".$prefix."updated_sections (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`attachments`,`payments`,`study_population`,`dateupdated`,`status`) 

values('$asrmApplctID','$id','','','','','','','','','','','1','',now(),'pending')";
$mysqli->query($sqlAREvisedSections);
}
if($totalUsersRevions){

$sqlAREvisedSections_update="update ".$prefix."updated_sections  set `payments`='1' where owner_id='$asrmApplctID' and protocol_id='$id' and status='pending'";
$mysqli->query($sqlAREvisedSections_update);	
}/////////////////end updated sections

}


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();

$submission_id=$rstudy['protocol_id'];
$protocol_id=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>


<?php 


$wmPopulation="select * from ".$prefix."study_population where  owner_id='$asrmApplctID' and protocol_id='$submission_id'";
$cmdwbPopulation = $mysqli->query($wmPopulation);
$totalStagesPopulation = $cmdwbPopulation->num_rows;
?>


<?php include("viewlrcn/final_button.php");?>

<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionCheck&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecondUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThirdUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulationUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFourUp&id=<?php echo $rstudy['id'];?>"  <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudgetUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionScheduleUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSixUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li>



</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'  order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$recAffiliated_id=$rstudym['recAffiliated_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

if($category=='submissionFinishDelUp' and $id){

$sqlA2Protocol2="update ".$prefix."submission set `paymentProof`='', `type_of_payment`='' where id='$submission_id' and owner_id='$asrmApplctID'";
	$mysqli->query($sqlA2Protocol2);
	
	$sqlASubmissionStages="update ".$prefix."submission_stages  set `payments`='0' where `owner_id`='$asrmApplctID' and `protocol_id`='$submission_id'";
$mysqli->query($sqlASubmissionStages);
	}
	

?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rstudym['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     
          <?php include("viewlrcn/status_log_resubmit.php");?>


                    </div>
                  </div>
                </div>
              </div>

<!--<h3>Status</h3>-->


 <table class="table table-striped table-sm">
<tr>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
 </tr>

</table>
     
  <div style="clear:both;"></div> 
   <?php /* ?><a href="<?php echo $base_url;?>invoice.php?id=<?php echo base64_encode($submission_id);?>" target="_blank" style="color:#F00;"><img src="images/pdf.png" /> PRINT MY INVOICE</a><?php */?>
 <?php 
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();?>   
  
   <!-- Trigger/Open The Modal -->
<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
<table class="table table-striped table-sm" id="customers">
<?php if($rstudym['paymentProof']){?>

<thead>
                          <tr>
                            <th>Type of Payment</th>
                            <th>Proof of Payment</th>
                         <th>&nbsp;</th>
                          </tr>
                        </thead>
                        
 <tbody>
 <tr>
    <td width="29%"> <?php echo $rstudym['type_of_payment'];?></td>

    <td width="32%">
    
<?php if($today<=$rstudym['created']){?>
<a href="./cfxdownload.php?n=<?php echo $rstudym['id'];?>" target="_blank">Proof of Payment Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?n=<?php echo $rstudym['id'];?>" target="_blank">Proof of Payment Attachment</a>
<?php }?> 
    
    </td>
    
    
    <td width="32%"><a href="./main.php?option=submissionFinishDel&id=<?php echo $rstudym['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
    
  </tr>
  <?php }//end if proof of payment?>
    <tr>
    <td colspan="3"><strong style="color:#F00; font-size:12px;">NOTE: Undergraduate students may attach proof of payment of research fees to the University.</strong></td>
    </tr>
   </tbody>
   
</table>








<?php if($rstudym['paymentProof']){?>

<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">

<?php }//end if proof of payment?>
  
<div style="clear:both;"></div>
             
   
   </form>
   <button id="myBtn">Click to add/update Payment Attachment </button>   
   
 <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add Payment Attachment</strong></h3>
    </div>
  <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Type of Payment:</label>
<div class="col-sm-10">
<select name="type_of_payment" id="upload_type_id" class="form-control  required" required>

<option value="Wire Transfer" <?php if($rstudym['type_of_payment']=='Wire Transfer'){?>selected="selected"<?php }?>> Wire Transfer</option>
<option value="Cash Deposit" <?php if($rstudym['type_of_payment']=='Cash Deposit'){?>selected="selected"<?php }?>> Cash Deposit</option>
<option value="Mobile Money" <?php if($rstudym['type_of_payment']=='Mobile Money'){?>selected="selected"<?php }?>> Mobile Money</option>

</select>

<input name="submission_id" type="hidden" value="<?php echo $rstudy['protocol_id'];?>"/>
</div>
</div> 



 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Proof of Payment:</label>
<div class="col-sm-10">
<input name="attachpayment" type="file" id="attachpayment" class="required"style="width: 90px"/>

<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
</div>
</div>
                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doFinalSave" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>