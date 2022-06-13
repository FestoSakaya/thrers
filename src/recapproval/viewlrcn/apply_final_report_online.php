<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Apply for Close Out Report</a></li>
<li class="extra">Attachments</li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];


$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$sessionasrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
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
        


                    </div>
                  </div>
                </div>
              </div>

<?php

if($_POST['doFilesProceed']=='Save to Proceed' and $_POST['project_id'] and $_POST['recAffiliated_id']){

$Changes=$mysqli->real_escape_string($_POST['Changes']);
$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$protocol_id=$mysqli->real_escape_string($_POST['project_id']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);

$wmRenewals="select * from ".$prefix."submission where  id='$protocol_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();
$protocol_title=$mysqli->real_escape_string($rRenewals['public_title']);

$sqlprotocalSubSelCAll="SELECT * FROM ".$prefix."final_reports order by id desc limit 0,1";
$QprotocalSub2SelCall = $mysqli->query($sqlprotocalSubSelCAll);
$rstudyCall = $QprotocalSub2SelCall->fetch_array();

$code=$rstudyCall['id']+1;



	
$sqlprotocalSubSel3="SELECT * FROM ".$prefix."final_reports where owner_id='$sessionasrmApplctID'  and ammendType='online' and id='$id'";
$QprotocalSub2Sel3 = $mysqli->query($sqlprotocalSubSel3);
$totalstudy3 = $QprotocalSub2Sel3->num_rows;

if(!$totalstudy3 and $protocol_title and $recAffiliated_id){
$sqlA22="insert into ".$prefix."final_reports (`owner_id`,`protocol_id`,`recAffiliated_id`,`fileAttachment`,`created`,`status`,`assignedto`,`ammendType`,`protocol_title`,`CompletenessCheck`,`is_sent`,`code`) 

values('$sessionasrmApplctID','$protocol_id','$recAffiliated_id','$fileattachment',now(),'Pending','Not Assigned','online','$protocol_title','Pending','0','$code')";
$mysqli->query($sqlA22);
$message='<div class="success">Changes have saved</div>';

$record_id = $mysqli->insert_id;
if($record_id){
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=OnlineFinalReportProceed&id=$record_id&rec='.$recAffiliated_id.'">';
}
}

if($totalstudy3){	
$sqlA2="update ".$prefix."final_reports set `recAffiliated_id`='$recAffiliated_id',`protocol_id`='$protocol_id' where owner_id='$sessionasrmApplctID' and id='$id'";
$mysqli->query($sqlA2);
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=OnlineFinalReportProceed&id=$record_id&rec='.$recAffiliated_id.'">';


$message='<div class="success">Close Out Report has been saved</div>';
}
	
}


$sqlstudy="SELECT * FROM ".$prefix."final_reports where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,100";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rNotification= $Querystudy->fetch_array();
$rNotification['protocol_id'];

if(isset($message)){echo $message;}
?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">  
   <div style="clear:both;"></div>
  <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose REC: <br /></label>

<select name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rNotification['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                  
                        </div>
                        <div class="line"></div> 
                        
<div class="form-group row success">
<label class="col-sm-10 form-control-label">Select Protocol you are submitting to: <span class="error">*</span></label>
<div class="col-sm-10">
<?php
$sqlSubmission = "select * FROM ".$prefix."submission where owner_id='$asrmApplctID' and status='Approved' order by id desc"; 
$QuerySubmission = $mysqli->query($sqlSubmission);
 $totalSubmission = $QuerySubmission->num_rows;
 if( $totalSubmission){
?>
<select name="project_id" id="project_id" class="form-control  required">

<option value="">Please Select Protocol</option>
<?php

while($resultSubmission=$QuerySubmission->fetch_array()){
?>
<option value="<?php echo $resultSubmission['id'];?>" <?php if($resultSubmission['id']==$rNotification['protocol_id']){?>selected="selected"<?php }?>><?php echo $resultSubmission['public_title'];?></option>

<?php }?>

</select>
<?php }else{?><div class="error2">You dont have any project nearing end</div><?php }?>
</div>
</div>
    
<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doFilesProceed" type="submit"  class="btn btn-primary" value="Save to Proceed"/>




                          </div>
                        </div>
                                          
     </form>  

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>