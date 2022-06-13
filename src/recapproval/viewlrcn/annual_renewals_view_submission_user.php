<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Annual Renewal View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."renewals where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];


$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
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
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rprotocalSub2Sel['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     
                     
                     <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    100% Complete
  </div>
</div> 


                    </div>
                  </div>
                </div>
              </div>
              
                                
</div>

  <?php
  $sqlstudypp="SELECT * FROM ".$prefix."renewals where id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();
?> 
<button class="accordion">Protocol Information, click to review</button>
  <div class="panel">
 
  <label><strong>Brief rationale for the Study:</strong> <?php echo $rstudypp['Briefrationale'];?></label><br /><br />

<label><strong>General Research Objective:</strong> <?php echo $rstudypp['GeneralResearchObjective'];?></label><br /><br />

<label><strong>Brief description of the study design, study sites, study population, sample size, and study duration:</strong> <?php echo $rstudypp['StudyMethods'];?></label><br />

  </div>
  
  
<button class="accordion">Status of Participants & Specimens, click to review</button>
  <div class="panel">
            
    <strong>Status of Participants       in the study</strong><br><br>

Provide the  status of participant enrollment.
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="4%" valign="top"></td>
    <td width="23%" valign="top"><strong>&nbsp;Participants</strong></td>
    <td width="24%" valign="top"><strong>&nbsp;Number</strong></td>
    <td width="49%" valign="top"><strong>&nbsp;Remarks*</strong></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;1.</td>
    <td valign="top">&nbsp;Approved sample size</td>
    <td valign="top"><input type="text" name="Approvedsamplesize_Number" value="<?php echo $rstudypp['Approvedsamplesize_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Approvedsamplesize_Remarks" id="Briefrationale" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Approvedsamplesize_Remarks'];?>">
</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;2.</td>
    <td valign="top">&nbsp;Screened</td>
  <td valign="top"><input type="text" name="Screened_Number" value="<?php echo $rstudypp['Screened_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Screened_Remarks" id="Screened_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Screened_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;3.&nbsp;</td>
    <td valign="top">&nbsp;Enrolled</td>
   <td valign="top"><input type="text" name="Enrolled_Number" id="Enrolled_Number" value="<?php echo $rstudypp['Enrolled_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Enrolled_Remarks" id="Enrolled_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Enrolled_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;4.</td>
    <td valign="top">&nbsp;Withdrawn</td>
    <td valign="top"><input type="text" name="Withdrawn_Number" id="Withdrawn_Number" value="<?php echo $rstudypp['Withdrawn_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Withdrawn_Remarks" id="Withdrawn_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Withdrawn_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;5.</td>
    <td valign="top">&nbsp;Terminated</td>
    <td valign="top"><input type="text" name="Terminated_Number" id="Terminated_Number" value="<?php echo $rstudypp['Terminated_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Terminated_Remarks" id="Terminated_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Terminated_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;6.</td>
    <td valign="top">&nbsp;Lost to follow up</td>
    <td valign="top"><input type="text" name="Losttofollowup_Number" id="Losttofollowup_Number" value="<?php echo $rstudypp['Losttofollowup_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Losttofollowup_Remarks" id="Losttofollowup_Remarks" class="form-control  required" value="<?php echo $rstudypp['Losttofollowup_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;7.</td>
    <td valign="top">&nbsp;Died</td>
   <td valign="top"><input type="text" name="Died_Number" id="Died_Number" value="<?php echo $rstudypp['Died_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Died_Remarks" id="Died_Remarks" class="form-control  required" value="<?php echo $rstudypp['Died_Remarks'];?>"></td>
  </tr>
</table>
*Give relevant  explanation where necessary<br><br>
<strong>Specimens description (where applicable):</strong>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="38" valign="top"></td>
    <td width="239" valign="top"><strong>&nbsp;Specimens</strong></td>
    <td width="257" valign="top"><strong>&nbsp;Number</strong></td>
    <td width="516" valign="top"><strong>&nbsp;Remarks*</strong></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;1.&nbsp;</td>
    <td width="239" valign="top">&nbsp;Approved sample size</td>
    <td valign="top"><input type="text" name="ApprovedSampleSizeSpecimens_Number" id="ApprovedSampleSizeSpecimens_Number" value="<?php echo $rstudypp['ApprovedSampleSizeSpecimens_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="ApprovedSampleSizeSpecimens_Remarks" id="ApprovedSampleSizeSpecimens_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['ApprovedSampleSizeSpecimens_Remarks'];?>"></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;2.</td>
    <td width="239" valign="top">&nbsp;Samples analyzed </td>
    <td valign="top"><input type="text" name="SamplesAnalyzed_Number" id="SamplesAnalyzed_Number" value="<?php echo $rstudypp['SamplesAnalyzed_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="SamplesAnalyzed_Remarks" id="SamplesAnalyzed_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['SamplesAnalyzed_Remarks'];?>"></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;3.&nbsp;</td>
    <td width="239" valign="top">&nbsp;Withdrawn consent</td>
<td valign="top"><input type="text" name="WithdrawnConsent_Number" id="WithdrawnConsent_Number" value="<?php echo $rstudypp['WithdrawnConsent_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="WithdrawnConsent_Remarks" id="WithdrawnConsent_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['WithdrawnConsent_Remarks'];?>"></td>
  </tr>
</table>
*Give relevant  explanation where necessary                  
  </div>
  

  <?php
  $sqlstudyppt="SELECT * FROM ".$prefix."renewals_summary where annual_id='$id' order by id desc limit 0,1";
$Querystudyppt = $mysqli->query($sqlstudyppt);
$totalstudyppt = $Querystudyppt->num_rows;
$rstudyppt = $Querystudyppt->fetch_array();

$sqlUsersLit1="SELECT * FROM ".$prefix."renewals_literature where annual_id='$id' order by id desc limit 0,20";
$QueryUsersLit1 = $mysqli->query($sqlUsersLit1);
?>

<button class="accordion">Literature & Challanges, click to review</button>
  <div class="panel">
  


 <label>If there have been any new publications in the area of study, including those from your study, provide a brief summary of these stating the implication they might have on continuation of your research.</label> <br /><br />

<table width="80%" border="0" id="customers2">
        <tr>
            <th><strong>Source</strong></th>
            <th><strong>Brief description</strong></th>

            <th><strong>Implication on your research</strong></th>

        </tr>
     <?php  while($rstudyppLIT = $QueryUsersLit1->fetch_array()){?>
        <tr>
            <td><?php echo $rstudyppLIT['source'];?>
            </td>
            <td><?php echo $rstudyppLIT['BriefDescription'];?></td>
            
              <td><?php echo $rstudyppLIT['Implicationonresearch'];?>
            </td>
        
        </tr> <?php }?>
    </table>


<label><strong>Summary of Adverse Events:</strong></label><br />


<label><strong>Provide a summary of numbers of all the adverse events observed and their severity and types (use extra sheet if necessary).</strong> <?php echo $rstudyppt['AdverseEvents'];?></label><br /><br />


<label><strong>Summary of Protocol Deviations and Violations:</strong></label><br />


<label><strong>Provide a summary of any protocol deviations or violations during the reporting period.</strong> <?php echo $rstudyppt['summaryProtocolDeviations'];?></label><br /><br />


<label><strong>Summary of Site Activities:</strong></label><br />
<label><strong>Give a summary of other relevant activities carried out at the site including training of study staff and facilities upgraded and new changes in management of the study.</strong> <?php echo $rstudyppt['SummarySiteActivities'];?></label><br /><br />


<label><strong>Challenges:</strong></label><br />
<label><strong>Briefly state any challenges encountered during the reporting period, and steps taken to address them.</strong> <?php echo $rstudyppt['Challenges'];?></label><br /><br />



  </div>


<button class="accordion">Future Plans/Activities</button>
  <div class="panel">
  <?php echo $rstudyppt['FuturePlans'];?>
  </div>
  
  
<button class="accordion">Attachments</button>
  <div class="panel">
 <table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                            <th>Attachment</th>
                            <th>File name</th>
            
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

						
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`attachment_date`,'%d/%m/%Y %H:%s:%i') AS attachment_date,DATE_FORMAT(`attachment_date`,'%d/%m/%Y') AS created FROM ".$prefix."renewals_attachments where  renewal_id='$id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	
$submittedBy=$rInvestigator['user_id'];
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td><?php if($today<$rInvestigator['created']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            
                            </td>
                            <td><?php echo $rInvestigator['filename'];?></td>
                         
                            <td><?php echo $rInvestigator['attachment_date'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  </div>
  
    

    <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("activem");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script> 

                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>