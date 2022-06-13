<ul id="countrytabs" class="shadetabs">
<li class="extra">Reviewer Comments</li>
<li><a href="#" rel="#default" class="selected">Review</a></li>
<li class="extra">End Review</li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];
$code="REC.00.$protocol_idwe.01";

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$protocol_idwe' and owner_id='$owner_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
if(!$rprotocalSub2Sel['code']){
$sqlUpdateProtocl="update ".$prefix."protocol set code='$code' where id='$protocol_idwe' and owner_id='$owner_id'";
//$mysqli->query($sqlUpdateProtocl);
}

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doSendMeeting']=='Save and Proceed'){

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$meeting_id=$mysqli->real_escape_string($_POST['meeting']);

$sqlA2="update ".$prefix."protocol set `meeting_id`='$meeting_id',`main_submission_id`='$protocol_idmm' where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=EndReview&id='.$id.'">';
	
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
<button class="accordion">Submission, click to review</button>
  <div class="panel">
  <?php
  $sqlprotocalSub="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSub = $mysqli->query($sqlprotocalSub);
$rprotocalSub = $QprotocalSub->fetch_array();
$protocol_id=$rprotocalSub['protocol_id'];
$iowner_id=$rprotocalSub['owner_id'];

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

  
  
  
  
  
  
  </div>
  
  <button class="accordion">Protocol Information, click to review</button>
  <div class="panel">
  <?php
  $sqlprotocalSubrr="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSubrr = $mysqli->query($sqlprotocalSubrr);
$rprotocalSubrr = $QprotocalSubrr->fetch_array();
$protocol_idrr=$rprotocalSubrr['protocol_id'];
$iowner_idrr=$rprotocalSubrr['owner_id'];
?>
  <label class="form-control-label"><strong style="font-weight:bold;">Summary:</strong><br /> <?php echo $rprotocalSubrr['abstract'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Keywords:</strong><br /><?php echo $rprotocalSubrr['keywords'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Introduction:</strong><br /><?php echo $rprotocalSubrr['introduction'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Justification:</strong><br /><?php echo $rprotocalSubrr['justification'];?></label><br />
 <label class="form-control-label"><strong style="font-weight:bold;">Objectives:</strong><br /></label><br />
<h5>Main Objective</h5>
  
   <?php
  $count1=0;
$qRPersoneld="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_idwe' and objectivetype='Main Objective' order by objectivetype asc";
$RPersoneld=$mysqli->query($qRPersoneld);
while ($rowRows = $RPersoneld->fetch_array())
{ $count1++;
///Display data for education history
	?> 
    
<label class="form-control-label">
<?php echo $count1.'. '.$rowRows['objective'];?></label><br />
<?php
}
?> 
<hr />
<h5>Specific Objectives</h5>
  
  <?php
   $count2=0;
$qRPersoneld4="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_idwe' and objectivetype='Specific Objective' order by objectivetype asc";
$RPersoneld4=$mysqli->query($qRPersoneld4);
while ($rowRows4 = $RPersoneld4->fetch_array())
{ $count2++;
///Display data for education history
	?> 
    
<label class="form-control-label">
<?php echo $count2.'. '.$rowRows4['objective'];?></label><br />
<?php
}
?> 
  
  
  
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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."team where owner_id='$owner_id' and protocol_id='$protocol_idwe' order by id desc LIMIT 0,10";//and conceptm_status='new' 
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
                             <input id="go" type="button" value="View Details" onclick="window.open('<?php echo $base_url;?>viewbiodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" >
                             <?php }?>
                             
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  
  </div>




<button class="accordion">Budget Information, click to review</button>
  <div class="panel">
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Cost description</th>
                            <th>Unit cost</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Created</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_cost where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	?>
                          <tr>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['description'];?>" style="font-weight:bold;" target="_blank"><?php echo $rInvestigator['description'];?></a></td>
                            <td><?php echo $rInvestigator['quantity'];?></td>
                            <td><?php echo $rInvestigator['unit_cost'];?></td>
                            <td><?php echo number_format(round($rInvestigator['quantity']*$rInvestigator['unit_cost']),2);?></td>
                            <td><?php echo $rInvestigator['created'];?></td>
                          </tr>
   <?php }///////////end function
   
 $sqlstudyff="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudyff = $mysqli->query($sqlstudyff);
$rstudyff = $Querystudyff->fetch_array();  
   
    ?>                 
                        </tbody>
                      </table>
                      

<label class="form-control-label"><strong style="font-weight:bold;">Primary Sponsor:</strong> <?php echo $rstudyff['primary_sponsor'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Secondary Sponsor:</strong> <?php echo $rstudyff['secondary_sponsor'];?></label>                 
                      
                      
  </div>
  


<button class="accordion">Clinical Study, click to review</button>
  <div class="panel">
  
  <h3>Recruitment Recruitment Area(s):</h3>
  
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Parish</th>
                            <th>Total No of participants</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
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
                            <td><?php echo $rInvestigator['participants'];?></td>
                          </tr>
       <?php 
   if($rInvestigator['participants'] and $rInvestigator['participants']!="N/A"){$Totalparticipants=($rInvestigator['participants']+$Totalparticipants);}
   }///////////end function ?> 
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
$qRPersoneld2="select * from ".$prefix."study_description_age  where owner_id='$owner_id' and protocol_id='$protocol_idwe'";
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
              
<hr />
   <?php 
   
 $sqlstudyDD="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$QuerystudyDD = $mysqli->query($sqlstudyDD);
$rstudyDD = $QuerystudyDD->fetch_array();  
   
    ?>             

<label class="form-control-label"><strong style="font-weight:bold;">Study design:</strong> <?php echo $rstudyDD['funding_source'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Health Condition or Problem Studied:</strong> <?php echo nl2br($rstudyDD['health_condition']);?></label>

<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
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


<label class="form-control-label"><strong style="font-weight:bold;">Secondary Registry:</strong> <?php echo $rstudyDD['clinical_trial_secondary'];?></label>

<hr />
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

  </div>

  
  <button class="accordion">Methodology, click to review</button>
  <div class="panel">
  <?php
   $sqlstudyDDw2="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$QuerystudyDDw2 = $mysqli->query($sqlstudyDDw2);
$rstudyDDw2 = $QuerystudyDDw2->fetch_array();  
?>
<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?>

<label class="form-control-label"><strong style="font-weight:bold;">General Procedures:</strong> <?php echo nl2br($rstudymethodology['general_procedures']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Analysis Plan:</strong> <?php echo nl2br($rstudymethodology['analysis_plan']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Ethical Considerations:</strong> <?php echo nl2br($rstudymethodology['ethical_considerations']);?></label>

  </div>
  
  
 <button class="accordion">Study Work Plan, click to review</button>
  <div class="panel">
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
                            <td><a href="./files/uploads/<?php echo $rInvestigator['description'];?>" style="font-weight:bold;" target="_blank"><?php echo $rInvestigator['description'];?></a></td>
                          

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  </div> 



  <button class="accordion">Attachments, click to review</button>
  <div class="panel">
  
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>File name</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,150";//and conceptm_status='new' 
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
                            <td><?php if($rInvestigator['othername']){echo $rInvestigator['othername'];}else{echo $rfile['name'];}?></td>
                            <td><?php echo $rInvestigator['Language'];?></td>
                            <td><?php echo $rInvestigator['Version'];?> </td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  
  
  
  
  </div>
  
  
<!--  <button class="accordion">History, click to review</button>
  <div class="panel">Ngssss  snsnsnsn</div>-->
  
  
  <button class="accordion">Comments, click to review </button>
  <div class="panel">
  
     <?php
if($_POST['doAddReviewers']=='Save'){

	$reviwer=$mysqli->real_escape_string($_POST['reviwer']);
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."reviewers where `protocol_id`='$protocol_idmm' and user_id='$asrmApplctID_user' and reviewer_id='$reviwer'";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."reviewers (`owner_id`,`protocol_id`,`reviewer_id`,`created`) 

values('$asrmApplctID_user','$protocol_idmm','$reviwer',now())";
$mysqli->query($sqlA2);
		}
	
}?>
     <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Message</th>
 
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where protocol_id='$protocol_idwe' order by id desc LIMIT 0,10";//and conceptm_status='new'

$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['reviewer_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
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

<h4 class="success">Reviewers</h4>
<div style="height:300px; overflow:scroll;">
<table class="table table-striped table-sm">
                  <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution</th>
                            <th>E-mail</th>
                            <th>Review Date</th>
   
                           <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select * FROM ".$prefix."submission_review_sr where owner_id='$owner_id' and protocol_id='$id' order by id desc LIMIT 0,20";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	
$reviewer_id=$rInvestigator['reviewer_id'];
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$reviewer_id'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
///
	?>
                          <tr>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rUsers['institution'];?></td>
                            <td><?php echo $rUsers['email'];?></td>
                            <td><?php echo $rInvestigator['reviewDate'];?></td>
                            <td><?php echo $rInvestigator['recstatus'];?></td>
          
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
                      </div>

 <!--includedon_approval-->
 <h4 style="padding: 15px;
position: relative;
display: block;
margin: 5px 0;
border-radius: 3px;
color: #ffffff;
font-weight: bold;
background-color:#C30 !important;
font-size: 16px;">Documents to be included on Decision letter</h4>
 <hr />
 <?php
if($_POST['doUpdateDocuments']=='Update Documents'){

for ($i=0; $i < count($_POST['includedon_approval']); $i++) {
	
//foreach($_POST['includedon_approval'] as $cfn_includedon_approval) {
//$cfn_includedon_approval= $cfn_includedon_approval;
$cfn_includedon_approval= $mysqli->real_escape_string($_POST['includedon_approval'][$i]);

$includedm= $mysqli->real_escape_string($_POST['includedm'][$i]);
$sqlA2rr="update ".$prefix."submission_upload set includedon_approval='$includedm' where user_id='$owner_id' and submission_id='$protocol_idwe' and id='$cfn_includedon_approval'";
$mysqli->query($sqlA2rr);


}
}
?>
 <form action="" method="post" name="regForm" id="regForm" autocomplte="off" enctype="multipart/form-data">
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                          <th>&nbsp;</th>
                            <th>File name</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,150";//and conceptm_status='new' 
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
                          <td style="background:#F00;" align="center"> <input name="includedon_approval[]" type="hidden" value="<?php echo $rInvestigator['id'];?>" class="required" />
                          <select name="includedm[]" class="required">
                          <option value="No" <?php if($rInvestigator['includedon_approval']=='No'){?>selected="selected"<?php }?>>No</option>
                          <option value="Yes" <?php if($rInvestigator['includedon_approval']=='Yes'){?>selected="selected"<?php }?>>Yes</option>
                          </select>
                          
                          
                          </td>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['filename'];?>" target="_blank">View File</a></td>
                            <td><?php if($rInvestigator['othername']){echo $rInvestigator['othername'];}else{echo $rfile['name'];}?></td>
                            <td><?php echo $rInvestigator['Language'];?></td>
                            <td><?php echo $rInvestigator['Version'];?> </td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
                      
<div class="form-group row" style="float:left; padding-right:20%; margin-bottom:15px;">
<div class="col-sm-4 offset-sm-3">
<input name="doUpdateDocuments" type="submit"  class="btn btn-primary" value="Update Documents"/>

</div>
</div>
   
   </form>
 
 <?php
 //Make sure button comes after checking documents
$sqlDpocs = "select * FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' and includedon_approval='Yes' order by id desc";//and conceptm_status='new' 
$resultDocs = $mysqli->query($sqlDpocs);
$rTotalDOcs=$resultDocs->num_rows;
if($rTotalDOcs>=1){
?>  
   
 <form action="" method="post" name="regForm" id="regForm" autocomplte="off" enctype="multipart/form-data">     

<div class="form-group row">

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
</div>
<div class="line"></div>

<div class="form-group row">
<div class="col-sm-4 offset-sm-3">
<input name="doSendMeeting" type="submit"  class="btn btn-primary" value="Save and Proceed" onclick="return confirm('Are you sure you want to Proceed? Make sure you have ticked proper attachements.');"/>

</div>
</div>
</form><?php } //end $rTotalDOcs?>
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>