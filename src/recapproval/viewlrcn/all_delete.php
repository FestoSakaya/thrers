<?php

if($category=='submissionDeletem' and $id and $_GET['ownerid'] and $session_privillage=='administrator'){
	$owneridwm=$_GET['ownerid'];
	//Remove this submission
	$sqlUsers="SELECT * FROM ".$prefix."submission where `owner_id`='$owneridwm' and recAffiliated_id='$id' and id='$act'";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
	if($totalUsers and $id and $act){
	$sqlA2Protocol2="delete from ".$prefix."submission where owner_id='$owneridwm' and id='$act'";
	$mysqli->query($sqlA2Protocol2);
	//////////////////////////////////////////////
	$sqlA2Protocol3="delete from ".$prefix."protocol where owner_id='$owneridwm' and id='$act'";
	$mysqli->query($sqlA2Protocol3);
	
	//////////////////////////////////////////////
	$sqlA2Protocol4="delete from ".$prefix."team where owner_id='$owneridwm' and protocol_id='$act'";
	$mysqli->query($sqlA2Protocol4);
	
	//////////////////////////////////////////////
	$sqlA2Protocol5="delete from ".$prefix."submission_country where owner_id='$owneridwm' and submission_id='$act'";
	$mysqli->query($sqlA2Protocol5);
	
	//////////////////////////////////////////////
	$sqlA2Protocol6="delete from ".$prefix."research_project_expenditure where rstug_user_id='$owneridwm' and rstug_rsch_project_id='$act'";
	$mysqli->query($sqlA2Protocol6);
	
	//////////////////////////////////////////////
	$sqlA2Protocol7="delete from ".$prefix."research_project_expenditure_local where rstug_user_id='$owneridwm' and rstug_rsch_project_id='$act'";
	$mysqli->query($sqlA2Protocol7);
	
		//////////////////////////////////////////////
	$sqlA2Protocol8="delete from ".$prefix."submission_task where owner_id='$owneridwm' and submission_id='$act'";
	$mysqli->query($sqlA2Protocol8);
	
	//////////////////////////////////////////////
	$sqlA2Protocol8="delete from ".$prefix."submission_upload where user_id='$owneridwm' and submission_id='$act'";
	$mysqli->query($sqlA2Protocol8);
	
	//////////////////////////////////////////////
	$sqlA2Protocol9="delete from ".$prefix."collaborating_institutions where owner_id='$owneridwm' and protocol_id='$act'";
	$mysqli->query($sqlA2Protocol9);
	
	//////////////////////////////////////////////
	$sqlA2Protocol10="delete from ".$prefix."submission_stages where owner_id='$owneridwm' and protocol_id='$act'";
	$mysqli->query($sqlA2Protocol10);
	
	//////////////////////////////////////////////
	$sqlA2Protocol11="delete from ".$prefix."study_population where owner_id='$owneridwm' and protocol_id='$act'";
	$mysqli->query($sqlA2Protocol11);
	
	
	echo $message='<p class="failed">Dear '.$session_fullname.', protocol has been deleted.</p>';

	}
	
	}?><div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols</h3>
</div>
                    <div class="card-body">
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Protocol Title</th>
                            <th>Type</th>
                            <th>REC</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where recAffiliated_id='$id' order by id desc";//and conceptm_status='new'
$result = $mysqli->query($sql);

while($rProjects=$result->fetch_array()){
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$recAffiliated_id=$rProjects['recAffiliated_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$main_submission_id'  and meetingFor='protocol' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();
$newcode=$sqprotocol['code'];
$shtname=$sqUserdd['name'];

if(!$rProjects['code']){
$sqlprotocol = "update ".$prefix."submission set code='$newcode',shtname='$shtname' where id='$main_submission_id'";
//$mysqli->query($sqlprotocol);	
}
////Get REC
$recAffiliated_id=$rProjects['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$rProjects['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();

$sqlpReviewr = "select * from ".$prefix."submission_review_sr where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultReviewr = $mysqli->query($sqlpReviewr);
$sqprotocolReviewr = $resultReviewr->fetch_array();

$sqlpRevisions = "select * from ".$prefix."submission_archive where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultRevisions = $mysqli->query($sqlpRevisions);
$TotalRevisions = $resultRevisions->num_rows;
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small><br />
                            
                            
<?php if($TotalRevisions){?> <a href="<?php echo $base_url;?>main.php?option=RECRevisions&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Revisions [<?php echo $TotalRevisions;?>]</span></a>   <?php }?>                
                            </td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td>
							
<?php if($rProjects['meeting_status']=='Meeting Scheduled' || $rProjects['meeting_status']=='Pending'){?><?php echo $rProjects['assignedto'];}else{?><?php //echo $rProjects['status'];?>
                            
<?php if($rProjects['status']=='Approved'){echo "<b style='color:#796AEE;'>Approved</b>";}else{echo '<b style="color:#796AEE;">'.$rProjects['status'].'</b>';}  }?>
                                            
                           
                           
                            </td>
                            <td>
  
  <a href="./main.php?option=viewsubmissionrec&id=<?php echo $rProjects['id'];?>"><span class="label label-sec">View Submission</span></a>
<div style="margin-bottom:6px;"></div>
 <a href="./main.php?option=viewcomments&id=<?php echo $rProjects['id'];?>"><span class="label label-sec">View Comments</span></a>                        
   <div style="margin-bottom:6px;"></div>                         


<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-sec3">+ PRINT</span></a><br />

<a href="./main.php?option=submissionDeletem&id=<?php echo $recAffiliated_id;?>&act=<?php echo $rProjects['id'];?>&ownerid=<?php echo $owner_id;?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">+ Delete Submission</a>	
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
                    </div>

