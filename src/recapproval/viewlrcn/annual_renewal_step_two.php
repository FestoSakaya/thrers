<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
//submission_stages
$sqlstudy="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."annual_stages where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();


if($_POST['doSaveFirst']=='Save and Next' and $_POST['Approvedsamplesize_Number'] and $id>1){

	$Approvedsamplesize_Number=$mysqli->real_escape_string($_POST['Approvedsamplesize_Number']);
	$Approvedsamplesize_Remarks=$mysqli->real_escape_string($_POST['Approvedsamplesize_Remarks']);
	$Screened_Number=$mysqli->real_escape_string($_POST['Screened_Number']);
	$Screened_Remarks=$mysqli->real_escape_string($_POST['Screened_Remarks']);
	$Enrolled_Number=$mysqli->real_escape_string($_POST['Enrolled_Number']);
	$Enrolled_Remarks=$mysqli->real_escape_string($_POST['Enrolled_Remarks']);
	$Withdrawn_Number=$mysqli->real_escape_string($_POST['Withdrawn_Number']);
	$Withdrawn_Remarks=$mysqli->real_escape_string($_POST['Withdrawn_Remarks']);
	$Terminated_Number=$mysqli->real_escape_string($_POST['Terminated_Number']);
	$Terminated_Remarks=$mysqli->real_escape_string($_POST['Terminated_Remarks']);
	$Losttofollowup_Number=$mysqli->real_escape_string($_POST['Losttofollowup_Number']);
	$Losttofollowup_Remarks=$mysqli->real_escape_string($_POST['Losttofollowup_Remarks']);
	$Died_Number=$mysqli->real_escape_string($_POST['Died_Number']);
	$Died_Remarks=$mysqli->real_escape_string($_POST['Died_Remarks']);
	$ApprovedSampleSizeSpecimens_Number=$mysqli->real_escape_string($_POST['ApprovedSampleSizeSpecimens_Number']);
	$ApprovedSampleSizeSpecimens_Remarks=$mysqli->real_escape_string($_POST['ApprovedSampleSizeSpecimens_Remarks']);
	$SamplesAnalyzed_Number=$mysqli->real_escape_string($_POST['SamplesAnalyzed_Number']);
	$SamplesAnalyzed_Remarks=$mysqli->real_escape_string($_POST['SamplesAnalyzed_Remarks']);
	$WithdrawnConsent_Number=$mysqli->real_escape_string($_POST['WithdrawnConsent_Number']);
	$WithdrawnConsent_Remarks=$mysqli->real_escape_string($_POST['WithdrawnConsent_Remarks']);
	
///Status of Participants Enrolled cant be more than screened



if($Enrolled_Number>$Screened_Number){
	$message='<p class="error2">Participants Enrolled cannot be more than Participants screened</p>';
}else{

$sqlA2Protocol="update ".$prefix."renewals  set `Approvedsamplesize_Number`='$Approvedsamplesize_Number',`Approvedsamplesize_Remarks`='$Approvedsamplesize_Remarks',`Screened_Number`='$Screened_Number',`Screened_Remarks`='$Screened_Remarks',`Enrolled_Number`='$Enrolled_Number',`Enrolled_Remarks`='$Enrolled_Remarks',`Withdrawn_Number`='$Withdrawn_Number',`Withdrawn_Remarks`='$Withdrawn_Remarks',`Terminated_Number`='$Terminated_Number',`Terminated_Remarks`='$Terminated_Remarks',`Losttofollowup_Number`='$Losttofollowup_Number',`Losttofollowup_Remarks`='$Losttofollowup_Remarks',`Died_Number`='$Died_Number',`Died_Remarks`='$Died_Remarks',`ApprovedSampleSizeSpecimens_Number`='$ApprovedSampleSizeSpecimens_Number',`ApprovedSampleSizeSpecimens_Remarks`='$ApprovedSampleSizeSpecimens_Remarks',`SamplesAnalyzed_Number`='$SamplesAnalyzed_Number',`SamplesAnalyzed_Remarks`='$SamplesAnalyzed_Remarks',`WithdrawnConsent_Number`='$WithdrawnConsent_Number',`WithdrawnConsent_Remarks`='$WithdrawnConsent_Remarks' where `owner_id`='$sessionasrmApplctID' and id='$id'";
$mysqli->query($sqlA2Protocol);
$record_id = $mysqli->insert_id;


//Insert into Submission Stages
$wm="select * from ".$prefix."annual_stages where  owner_id='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

if($totalStages){
$sqlASubmissionStages="update ".$prefix."annual_stages  set `status_of_participants`='1' where `owner_id`='$sessionasrmApplctID' and `status`='new' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages);
}



$message='<p class="success">Dear '.$session_fullname.', details have been submitted, save to continue</p>';
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenualThird&id='.$id.'">';

	}//end if	


}//end post


//Insert into Submission Stages
$sqlstudypp="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();

if($rstudypp['ammendType']=='online'){$link="AnnualRenual";}
if($rstudypp['ammendType']=='manual'){$link="AnnualRenualManual";}
?>

<ul id="countrytabs" class="shadetabs">




<?php if($totalstudy>=1){?><li><a href="./main.php?option=<?php echo $link;?>&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>


<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</a></li>



<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualFour&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Future Plans/Activities</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Future Plans/Activities</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenewalPayment&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</li><?php }?>

</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php

if(isset($message)){echo $message;}
?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="off">


<strong>Status of Participants       in the study</strong><br><br>

Provide the  status of participant enrollment.
<table width="100%" border="1" cellpadding="0" cellspacing="0" id="customers">
  <tr>
    <th width="4%" valign="top"></th>
    <th width="23%" valign="top"><strong>&nbsp;Participants</strong></th>
    <th width="29%" valign="top"><strong>&nbsp;Number</strong></th>
    <th width="44%" valign="top"><strong>&nbsp;Remarks</strong></th>
  </tr>
  <tr>
    <td valign="top">&nbsp;1.</td>
    <td valign="top">&nbsp;Approved sample size</td>
    <td valign="top">
    <input name="code" type="hidden" value="<?php echo $rstudypp['code'];?>"/>
    
    <input type="text" name="Approvedsamplesize_Number" value="<?php if($rstudypp['Approvedsamplesize_Number']){echo $rstudypp['Approvedsamplesize_Number'];}else{ echo $_POST['Approvedsamplesize_Number'];}?>"  class="form-control  required number"></td>
    
    <td valign="top"><input type="text" name="Approvedsamplesize_Remarks" id="Briefrationale" cols="" rows="5" class="form-control" value="<?php if($rstudypp['Approvedsamplesize_Remarks']){echo $rstudypp['Approvedsamplesize_Remarks'];}else{ echo $_POST['Approvedsamplesize_Remarks'];}?>">
</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;2.</td>
    <td valign="top">&nbsp;Screened</td>
  <td valign="top"><input type="text" name="Screened_Number" value="<?php if($rstudypp['Screened_Number']){echo $rstudypp['Screened_Number'];}else{ echo $_POST['Screened_Number'];}?>"  class="form-control  required number"></td>
  
    <td valign="top"><input type="text" name="Screened_Remarks" id="Screened_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['Screened_Remarks']){echo $rstudypp['Screened_Remarks'];}else{ echo $_POST['Screened_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;3.&nbsp;</td>
    <td valign="top">&nbsp;Enrolled</td>
   <td valign="top">
 
   
   <input type="text" name="Enrolled_Number" id="Enrolled_Number" value="<?php if($rstudypp['Enrolled_Number']){echo $rstudypp['Enrolled_Number'];}else{ echo $_POST['Enrolled_Number'];}?>"  class="form-control  required number" placeholder="Enrolled should be less-than screened">
   
   
   
   
   
   
   
   </td>
    <td valign="top"><input type="text" name="Enrolled_Remarks" id="Enrolled_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['Enrolled_Remarks']){echo $rstudypp['Enrolled_Remarks'];}else{ echo $_POST['Enrolled_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;4.</td>
    <td valign="top">&nbsp;Withdrawn</td>
    <td valign="top"><input type="text" name="Withdrawn_Number" id="Withdrawn_Number" value="<?php if($rstudypp['Withdrawn_Number']){echo $rstudypp['Withdrawn_Number'];}else{ echo $_POST['Withdrawn_Number'];}?>"  class="form-control  required"></td>
    
    <td valign="top"><input type="text" name="Withdrawn_Remarks" id="Withdrawn_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['Withdrawn_Remarks']){echo $rstudypp['Withdrawn_Remarks'];}else{ echo $_POST['Withdrawn_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;5.</td>
    <td valign="top">&nbsp;Terminated</td>
    <td valign="top"><input type="text" name="Terminated_Number" id="Terminated_Number" value="<?php if($rstudypp['Terminated_Number']){echo $rstudypp['Terminated_Number'];}else{ echo $_POST['Terminated_Number'];}?>"  class="form-control  required"></td>
    
    <td valign="top"><input type="text" name="Terminated_Remarks" id="Terminated_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['Terminated_Remarks']){echo $rstudypp['Terminated_Remarks'];}else{ echo $_POST['Terminated_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;6.</td>
    <td valign="top">&nbsp;Lost to follow up</td>
    <td valign="top"><input type="text" name="Losttofollowup_Number" id="Losttofollowup_Number" value="<?php if($rstudypp['Losttofollowup_Number']){echo $rstudypp['Losttofollowup_Number'];}else{ echo $_POST['Losttofollowup_Number'];}?>"  class="form-control  required number"></td>
    
    <td valign="top"><input type="text" name="Losttofollowup_Remarks" id="Losttofollowup_Remarks" class="form-control" value="<?php if($rstudypp['Losttofollowup_Remarks']){echo $rstudypp['Losttofollowup_Remarks'];}else{ echo $_POST['Losttofollowup_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;7.</td>
    <td valign="top">&nbsp;Died</td>
   <td valign="top"><input type="text" name="Died_Number" id="Died_Number" value="<?php if($rstudypp['Died_Number']){echo $rstudypp['Died_Number'];}else{ echo $_POST['Died_Number'];}?>"  class="form-control  required number"></td>
   
    <td valign="top"><input type="text" name="Died_Remarks" id="Died_Remarks" class="form-control" value="<?php if($rstudypp['Died_Remarks']){echo $rstudypp['Died_Remarks'];}else{ echo $_POST['Died_Remarks'];}?>"></td>
  </tr>
</table>
*Give relevant  explanation where necessary<br><br>
<strong>Specimens description (where applicable):</strong>
<table width="100%" border="1" cellpadding="0" cellspacing="0"  id="customers">
  <tr>
    <td width="38" valign="top"></td>
    <td width="239" valign="top"><strong>&nbsp;Specimens</strong></td>
    <td width="257" valign="top"><strong>&nbsp;Number</strong></td>
    <td width="516" valign="top"><strong>&nbsp;Remarks</strong></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;1.&nbsp;</td>
    <td width="239" valign="top">&nbsp;Approved sample size</td>
    <td valign="top"><input type="text" name="ApprovedSampleSizeSpecimens_Number" id="ApprovedSampleSizeSpecimens_Number" value="<?php if($rstudypp['ApprovedSampleSizeSpecimens_Number']){echo $rstudypp['ApprovedSampleSizeSpecimens_Number'];}else{ echo $_POST['ApprovedSampleSizeSpecimens_Number'];}?>"  class="form-control  required number"></td>
    
    <td valign="top"><input type="text" name="ApprovedSampleSizeSpecimens_Remarks" id="ApprovedSampleSizeSpecimens_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['ApprovedSampleSizeSpecimens_Remarks']){echo $rstudypp['ApprovedSampleSizeSpecimens_Remarks'];}else{ echo $_POST['ApprovedSampleSizeSpecimens_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;2.</td>
    <td width="239" valign="top">&nbsp;Samples analyzed </td>
    <td valign="top"><input type="text" name="SamplesAnalyzed_Number" id="SamplesAnalyzed_Number" value="<?php if($rstudypp['SamplesAnalyzed_Number']){echo $rstudypp['SamplesAnalyzed_Number'];}else{ echo $_POST['SamplesAnalyzed_Number'];}?>"  class="form-control  required number"></td>
    
    <td valign="top"><input type="text" name="SamplesAnalyzed_Remarks" id="SamplesAnalyzed_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['SamplesAnalyzed_Remarks']){echo $rstudypp['SamplesAnalyzed_Remarks'];}else{ echo $_POST['SamplesAnalyzed_Remarks'];}?>"></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;3.&nbsp;</td>
    <td width="239" valign="top">&nbsp;Withdrawn consent</td>
<td valign="top"><input type="text" name="WithdrawnConsent_Number" id="WithdrawnConsent_Number" value="<?php if($rstudypp['WithdrawnConsent_Number']){echo $rstudypp['WithdrawnConsent_Number'];}else{ echo $_POST['WithdrawnConsent_Number'];}?>"  class="form-control  required number"></td>

    <td valign="top"><input type="text" name="WithdrawnConsent_Remarks" id="WithdrawnConsent_Remarks" cols="" rows="5" class="form-control" value="<?php if($rstudypp['WithdrawnConsent_Remarks']){echo $rstudypp['WithdrawnConsent_Remarks'];}else{ echo $_POST['WithdrawnConsent_Remarks'];}?>"></td>
  </tr>
</table>
*Give relevant  explanation where necessary


 
 
                        <div class="line"></div>
                 
                        
                        
                        
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFirst" type="submit"  class="btn btn-primary" value="Save and Next"/>

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