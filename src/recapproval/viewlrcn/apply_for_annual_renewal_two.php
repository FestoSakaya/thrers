<ul id="countrytabs" class="shadetabs">
<li class="extra">Apply for Annual Renewal - Part 1</li>
<li><a href="#" rel="#default" class="selected">Part 11</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
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
if($_POST['doSaveSecond']=='Submit AmmendmentsS' and $_POST['Changes']){

	$Changes=$mysqli->real_escape_string($_POST['Changes']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	
	
/*$sqlprotocalSubSel="SELECT * FROM ".$prefix."ammendments where protocol_id='$protocol_id' and owner_id='$sasrmApplctID'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$totalstudy = $QprotocalSub2Sel->num_rows;
if(!$totalstudy){
	$sqlA2="insert into ".$prefix."ammendments (`owner_id`,`protocol_id`,`listchanges`,`TrachedChanges`,`CleanCopy`,`CoverLetter`,`created`,`status`) 

values('$asrmApplctID','$protocol_id','$Changes','$TrachedChanges2','$CleanCopy2','$CoverLetter2',now(),'Pending')";
$mysqli->query($sqlA2);
}*/


$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname added Ammendments");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenewalTwo&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."ammendments where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
<form action="" method="post" name="regForm" id="regForm" >
Specimens description (where applicable):
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="102" valign="top"><p>&nbsp;</p></td>
    <td width="194" valign="top"><p>Specimens</p></td>
    <td width="221" valign="top"><p>Number</p></td>
    <td width="531" valign="top"><p>Remarks*</p></td>
  </tr>
  <tr>
    <td width="102" valign="top">1. </td>
    <td width="194" valign="top"><p>Approved sample size</p></td>
    <td width="221" valign="top"><input type="text" name="Approvedsamplesize" id="Approvedsamplesize" class="form-control  required" value=""></td>
    <td width="531" valign="top"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td width="102" valign="top">2. </td>
    <td width="194" valign="top"><p>Samples analyzed </p></td>
    <td width="221" valign="top"><input type="text" name="Samplesanalyzed" id="Samplesanalyzed" class="form-control  required" value=""></td>
    <td width="531" valign="top"><input type="text" name="Samplesanalyzedc" id="Samplesanalyzedc" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="102" valign="top">3. </td>
    <td width="194" valign="top"><p>Withdrawn consent</p></td>
    <td width="221" valign="top"><input type="text" name="Withdrawnconsent" id="Withdrawnconsent" class="form-control  required" value=""></td>
    <td width="531" valign="top"><input type="text" name="Withdrawnconsentc" id="Withdrawnconsentc" class="form-control  required" value=""></td>
  </tr>
</table>
*Give relevant explanation where necessary
 
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Current Literature:</label>
                          If there have been any new publications in the area of study, including those from your study, provide a brief summary of these stating the implication they might have on continuation of your research. 
                          <input type="text" name="Protocolversion" id="Protocolversion" class="form-control  required" value="<?php echo $rstudy['Protocolversion'];?>">
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Summary of Adverse Events:</label>
                          Provide a summary of numbers of all the adverse events observed and their severity and types (use extra sheet if necessary). 
                          <input type="text" name="Protocolversion" id="Protocolversion" class="form-control  required" value="">
                       
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
  
                          <div class="form-group row">
                          <label class="col-sm-6 form-control-label"><strong>Summary of Protocol Deviations and Violations:

</strong><br />Provide a summary of any protocol deviations or violations during the reporting period. </label>
                        <textarea name="generalobjective" id="generalobjective" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-10 form-control-label"><strong>Summary of Site Activities:</strong></label>
                          Give a summary of other relevant activities carried out at the site including training of study staff and facilities upgraded and new changes in management of the study. 
                        <textarea name="StudyMethods" id="StudyMethods" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>
                  
                  
                  <div class="form-group row">
                          <label class="col-sm-10 form-control-label"><strong>Challenges:</strong></label>
                         Briefly state any challenges encountered during the reporting period, and steps taken to address them. 
                        <textarea name="StudyMethods" id="StudyMethods" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row">
                          <label class="col-sm-10 form-control-label"><strong>Future Plans/Activities:</strong></label>
                          What activities are planned during the coming year? Continued collection of data? Analysis of data? Completion of the protocol? Submission of a modification to the current protocol to expand on results? Any proposed modifications should be mentioned, but the request to modify the protocol should be submitted separately to the NARC secretariat. 
                        <textarea name="StudyMethods" id="StudyMethods" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doAmmendments" type="submit"  class="btn btn-primary" value="Submit"/>

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