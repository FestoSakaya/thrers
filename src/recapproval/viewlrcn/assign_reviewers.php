<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Assign Reviewers</a></li>

</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$public_title=$rstudym['public_title'];
$ProtoclRefNo=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$recAffiliated_idREC=$rstudym['recAffiliated_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();



if($_POST['doAssignReviewes']=='Save Details'){///Add reviewers to this protccol

//foreach($_POST['cfnreviewer'] as $cfnreviewer) {$cfnreviewer= $cfnreviewer;
for ($i=0; $i < count($_POST['cfnreviewer']); $i++) {
$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer'][$i]);
$reviewtype=$mysqli->real_escape_string($_POST['reviewtype'.$cfnreviewer]);

$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	
	if($_POST['Meetingsubject']){
	$subject=$mysqli->real_escape_string($_POST['Meetingsubject']);	
	}
	if(!$_POST['Meetingsubject']){
	$subject=$mysqli->real_escape_string("Expedited Review");	
	}
	
	if($reviewtype){
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype'.$cfnreviewer]);
	}
	if(!$reviewtype){
	$reviewtype=$mysqli->real_escape_string("REC Member");
	}
	
	//$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' and reviewer_id='$cfnreviewer' and recstatus='new'  and reviewFor='protocol' order by id desc";//reviewStatus='Pending'
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if(!$rTotalConceptLogs){//$subject and 
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'new','stage1','$reviewtype','$subject','$recAffiliated_c','protocol','none')";
$mysqli->query($sqlA2rr);
$message='<p class="success">Thank you, reviewer has been included on this protocol.</p>';
}
}//end Loop

if($rTotalConceptLogs){
	$message='<p class="error2">Reviewer details were already submitted.</p>';
}


}

if($_POST['doAssignReviewesConfirm']=='Assign Now'){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

foreach($_POST['reviewer'] as $cfn_reviewer) {
$cfnreviewer= $cfn_reviewer;
//First get details about this submission
$queryConceptLogs="select * from ".$prefix."submission_review_sr where id='$cfnreviewer'";

$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;
$sqSubmission = $rsConceptLogs->fetch_array();
    $assignedTo=$sqSubmission['asrmApplctID'];
	$reviewerID.= $sqSubmission['asrmApplctID'].'|';
	$asrmApplctID_user=$mysqli->real_escape_string($sqSubmission['owner_id']);
	$protocol_idmm=$mysqli->real_escape_string($sqSubmission['protocol_id']);
	$recAffiliated_c=$mysqli->real_escape_string($sqSubmission['recAffiliated_c']);
	$subject=$mysqli->real_escape_string($sqSubmission['subject']);
	$reviewtype=$mysqli->real_escape_string($sqSubmission['reviewtype']);
	


///Get All Teartiary reviewers under this REC
	
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_c'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];

	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



if($rTotalConceptLogs){// and $subject
$sqlA2rr="update ".$prefix."submission_review_sr set recstatus='Pending' where reviewer_id='$cfnreviewer'";
$mysqli->query($sqlA2rr); 

$update="update ".$prefix."submission set status='Scheduled for Review',assignedto='Assigned' where id='$id' and protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user'";
$mysqli->query($update);

$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$assignedTo'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
$assignedtoName=$sqReviewer['name'];
$usrm_email=$sqReviewer['email'];


///Now Send mail
//require_once("viewlrcn/mail_template_assign_reviewers.php");
$mail = new PHPMailer(true); //important
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Port = "587"; // SMTP Port
$mail->CharSet =  "utf-8";
$mail->Host = "$usmtpHost"; // specify SMTP server//nemesis.eahd.or.ug mailhost02.cfi.co.ug
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 0;


$mail->Username = "uncstuncstapps@gmail.com"; // SMTP username -- CHANGE --
$mail->Password = "lpupvbvillxraaey"; // SMTP password -- CHANGE --
$mail->setFrom("uncstuncstapps@gmail.com", "Admin");
/////////////////////////////Begin Mail Body
//$mail->addCc('mutumba.beth@yahoo.com',$recOriginalName);//
//$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalName);//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email, $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($usrm_email, $assignedtoName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$subject - Protocol for Review";
$body="<div style='background-color:#F6F9FC;color:#525f7f; width:100%;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Ubuntu,sans-serif;font-size:16px;line-height:24px; margin:0;outline:none;padding:15px;'>
    <table border='0' cellpadding='0' cellspacing='0' height='100%' style='table-layout:fixed' width='100%'>
        <tbody>
            <tr>
                <td align='center' valign='top'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout:fixed;max-width:900px;'>
                        <tbody>    
                            <tr>
                                <td align='center' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='background-color:#0C5CBE;color:#ffffff;border-radius:5px 5px 0 0;table-layout:fixed'>
                                        <tbody>
                                            <tr>
                                                <td align='center' style='padding-bottom:15px;text-transform:uppercase;padding-top:30px' valign='middle'>
                                                    <h1 style='color:white;text-align:center;font-size:24px;line-height:1.2em;max-width:100%;vertical-align:middle;word-wrap:break-word'>
                                                     Protocol for Review</h1>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>  
                            <tr>
                                <td align='center' style='background-color:#ffffff;border-radius:0 0 5px 5px;' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' style='table-layout:fixed' width='85%'>
                                        <tbody>
                                            <tr>
                                                <td align='left' valign='top' style='padding-bottom:30px;padding-top:40px;color: #525f7f;font-weight:400;'>

Dear $assignedtoName !<br><br>
<b>RE: $subject - $reviewtype</b><br><br>
A protocol, '<b>$public_title</b>' has been assigned to you for review as <b>$reviewtype</b>. Please <a href='".$base_url."/'>Click here</a>  to access the protocol.<br><br>
$subject<br>
Do not hesitate to contact us on the adress below incase of any difficulties accessing the system.<br>

Thank you,
<br><br>

Best Regards<br>
$contacts
                                                </td>
                                            </tr>          
                                              
                                         
                                        </tbody>
                                    </table>    
                                </td>
                            </tr>
                            <tr>
                                <td align='left' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' style='table-layout:fixed' width='100%'>
                                        <tbody>
                                            <tr>
                                                <td align='center' valign='top'>
                                                    <table border='0' cellpadding='0' cellspacing='0' style='padding-top:15px;padding-bottom:30px;table-layout:fixed' width='100%'>
                                                        <tbody>
                                                            <tr>
                                                                <td align='center' colspan='3' style='font-size:12px;line-height:1.5;padding-top:20px'>
                                                                    Copyright © $year Uganda National Concil for Science and Technology -UNCST. <span>All rights reserved.</span>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	//echo "Mailer Error: " . $mail->ErrorInfo;
}///end


}



}///End Post

if($rstudym['type_of_review']!='Expedited Review'){
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
//require_once("assign_protocol_to_tertiary_reviews.php"); ///Since August 25 2020, ignore assign to Tertiary until reviewed and commented out again on 04/10/2021
}

$message='<p class="success">Thank you, protocol has been assigned.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
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
<button class="accordion">Protocol Information, click to review</button>
  <div class="panel">
  <?php
  $sqlprotocalSub="SELECT * FROM ".$prefix."submission where  id='$protocol_idwe' order by id desc limit 0,1";
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
    <td><strong>Type of Research</strong></td>
    <td><strong>Protocol No</strong></td>
    <td><strong>Protocol Type</strong></td>
    <td><strong>Status</strong></td>
  </tr>
  <tr>
    <td><?php echo $rprotocalSub['protocol_academic'];?>: <strong><?php echo $rprotocalSub['protocol_academic_type'];?></strong> </td>
    <td><?php echo $rprotocalSub2['code'];?></td>
    <td><?php if($rprotocalSub['is_clinical_trial']==1){?>Clinical Trial<br />
	
	<?php }?>
  <?php if($rprotocalSub['is_clinical_trial']==0){
$clinical_trial_type=$rprotocalSub['clinical_trial_type'];
$qRCat="select * from apvr_categories where rstug_categoryID='$clinical_trial_type' and publish='Yes' order by rstug_categoryName asc";
$RCat = $mysqli->query($qRCat);
$TCat = $RCat->fetch_array();
?><?php echo $TCat['rstug_categoryName'];?><?php }?>
  
 
  
  </td>
    <td><?php echo $rprotocalSub['status'];?></td>
  </tr>
  <tr>
    <td style="padding-top:20px;"><strong>Type of Review</strong></td>
    <td><strong>Updated</strong></td>
    <td><strong>Decision</strong></td>
    <td><strong>Finished</strong></td>
  </tr>
  <tr>
    <td><?php echo $rprotocalSub['type_of_review'];?></td>
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
  
  
<button class="accordion">Protocol Details, click to review</button>
  <div class="panel">
  <?php
$sqlprotocalSubrr="SELECT * FROM ".$prefix."submission where  id='$protocol_idwe' and owner_id='$owner_id' order by id desc limit 0,1";
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


  
  </div>




<button class="accordion">Budget Information, click to review</button>
  <div class="panel">
   <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$owner_id' and rstug_rsch_project_id='$protocol_idwe' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

 $Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$owner_id' and rstug_rsch_project_id='$protocol_idwe' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

 <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$owner_id' and rstug_rsch_project_id='$protocol_idwe' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

$Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$owner_id' and rstug_rsch_project_id='$protocol_idwe' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

<h4> International Expenditure - Research Expenses to be covered outside Uganda</h4>
 

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
    <td width="187" align="center" valign="bottom"><?php if($rS['rstug_personnel_year1']){echo $rS['rstug_personnel_year1'];}else{ echo "0";}?></td>
    <td width="152" align="center" valign="bottom"><?php if($rS['rstug_personnel_year2']){echo $rS['rstug_personnel_year2'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year3']){echo $rS['rstug_personnel_year3'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year4']){echo $rS['rstug_personnel_year4'];}else{ echo "0";}?></td>
     <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year5']){echo $rS['rstug_personnel_year5'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_total']){echo $rS['rstug_personnel_total'];}else{ echo "0";}?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Travel <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><?php if($rS['rstug_travel_year1']){echo $rS['rstug_travel_year1'];}else{ echo "0";}?></td>
    <td width="152" align="center" valign="bottom"><?php if($rS['rstug_travel_year2']){echo $rS['rstug_travel_year2'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year3']){echo $rS['rstug_travel_year3'];}else{ echo "0";}?></td>
   
   
   <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year4']){echo $rS['rstug_travel_year4'];}else{ echo "0";}?></td>
   
   <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year5']){echo $rS['rstug_travel_year5'];}else{ echo "0";}?></td>
   
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_total']){echo $rS['rstug_travel_total'];}else{ echo "0";}?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Materials and Supplies</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_materials_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_materials_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year3'];?></td>
    
    
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Administration</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year3'];?></td>
    
    
 <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year4'];?></td>
  <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year5'];?></td>
  
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Results dissemination</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_results_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_results_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year3'];?></td>
    
     <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year4'];?></td>
      <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_total'];?></td>
  </tr>
 
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_contigency_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_contigency_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_total'];?></td>
  </tr>
  
  
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Reimbursement and Time Compensations </strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_reimbursement_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_reimbursement_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_total'];?></td>
  </tr>
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_other_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_other_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year3'];?></td>
    
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_total'];?></td>
  </tr>
<?php
$year1=($rS['rstug_personnel_year1']+$rS['rstug_travel_year1']+$rS['rstug_materials_year1']+$rS['rstug_adminstration_year1']+$rS['rstug_results_year1']+$rS['rstug_other_year1']+$rS['rstug_contigency_year1']+$rS['rstug_reimbursement_year1']);

$year2=($rS['rstug_personnel_year2']+$rS['rstug_travel_year2']+$rS['rstug_materials_year2']+$rS['rstug_adminstration_year2']+$rS['rstug_results_year2']+$rS['rstug_other_year2']+$rS['rstug_contigency_year2']+$rS['rstug_reimbursement_year2']);

$year3=($rS['rstug_personnel_year3']+$rS['rstug_travel_year3']+$rS['rstug_materials_year3']+$rS['rstug_adminstration_year3']+$rS['rstug_results_year3']+$rS['rstug_other_year3']+$rS['rstug_contigency_year3']+$rS['rstug_reimbursement_year3']);

$year4=($rS['rstug_personnel_year4']+$rS['rstug_travel_year4']+$rS['rstug_materials_year4']+$rS['rstug_adminstration_year4']+$rS['rstug_results_year4']+$rS['rstug_other_year4']+$rS['rstug_contigency_year4']+$rS['rstug_reimbursement_year4']);

$year5=($rS['rstug_personnel_year5']+$rS['rstug_travel_year5']+$rS['rstug_materials_year5']+$rS['rstug_adminstration_year5']+$rS['rstug_results_year5']+$rS['rstug_other_year5']+$rS['rstug_contigency_year5']+$rS['rstug_reimbursement_year5']);
?>
 <tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="143" align="center" valign="bottom"><strong><?php echo $year1;?></strong></td>
    <td width="148" align="center" valign="bottom"><strong><?php echo $year2;?></strong></td>
    <td width="169" align="center" valign="bottom" ><strong><?php echo $year3;?></strong></td>
    <td width="151" align="center" valign="bottom" ><strong><?php echo $year4;?></strong></td>
    <td width="156" align="center" valign="bottom" ><strong><?php echo $year5;?></strong></td>
    <td width="115" align="center" valign="bottom" ><b><?php
	
	$grandTotal=($rS['rstug_personnel_total']+$rS['rstug_travel_total']+$rS['rstug_materials_total']+$rS['rstug_adminstration_total']+$rS['rstug_results_total']+$rS['rstug_other_total']+$rS['rstug_contigency_total']+$rS['rstug_reimbursement_total']);
	
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
	
	$grandTotal2=($rSLocal['rstug_personnel_total']+$rSLocal['rstug_travel_total']+$rSLocal['rstug_materials_total']+$rSLocal['rstug_adminstration_total']+$rSLocal['rstug_results_total']+$rSLocal['rstug_other_total']+$rSLocal['rstug_contigency_total']+$rSLocal['rstug_reimbursement_total']);
	
	 echo $grandTotal2;$grandTotal2="";?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>
 <?php
  $sqlstudyff="SELECT * FROM ".$prefix."submission where id='$protocol_idwe' order by id desc limit 0,1";
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

    <td width="187"  valign="bottom"> <label class="form-control-label"><strong>Secondary Sponsor:</strong></label>
       <?php echo $rstudyff['secondary_sponsor'];?></td>
       
    <td width="152"  valign="bottom"><label class="form-control-label"><strong>Country:</strong></label>

<?php
$SecondarySponsorCountry=$rstudyff['SecondarySponsorCountry'];
$sqlCountrycv2 = "select * FROM ".$prefix."list_country where id='$SecondarySponsorCountry' order by name asc";//and conceptm_status='new' 
$resultCountrycv2 = $mysqli->query($sqlCountrycv2);
$rCountrycv2=$resultCountrycv2->fetch_array();
?>
<?php echo $rCountrycv2['name'];?></td>


  
    <td valign="bottom"><label class="form-control-label"><strong>Institution:</strong></label>
       <?php echo $rstudyff['SecondarySponsorInstitution'];?></td>
  </tr>
</table>
                
                      
  </div>
  


<button class="accordion">Study Description, click to review</button>
  <div class="panel">
  
 <h3>Recruitment Recruitment Area(s):</h3>
  
  <table id="customers">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Parish</th>
                            <th>Duration</th>
                            <th>Total No of participants</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where submission_id='$protocol_idwe' and owner_id='$owner_id' order by id desc LIMIT 0,10";//and conceptm_status='new' $owner_id
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
                            <td><input id="go" type="button" value="View details" onclick="window.open('<?php echo $base_url;?>viewdateareas.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" ></td>
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
                            <td>&nbsp;</td>
                          </tr>
                                          
                        </tbody>
                      </table>
                      

<?php
$qRPersoneld2="select * from ".$prefix."study_description_age  where owner_id='$owner_id' and protocol_id='$protocol_idwe'";
$RPersoneld2=$mysqli->query($qRPersoneld2); 
if($RPersoneld2->num_rows){
?>
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
      <td id="grid"><?php echo $rowRows2['Duration'];?></td>
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
    <?php }?>       
<hr />
   <?php
 $sqlstudyDD="SELECT * FROM ".$prefix."submission where id='$protocol_idwe' and owner_id='$owner_id' order by id desc limit 0,1";
$QuerystudyDD = $mysqli->query($sqlstudyDD);
$rstudyDD = $QuerystudyDD->fetch_array();  
   
    ?>          

<label class="form-control-label"><strong style="font-weight:bold;">Study design:</strong> <?php echo $rstudyDD['funding_source'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Health Condition or Problem Studied:</strong> <?php echo $rstudyDD['health_condition'];?></label>





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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_clinical_trial where submission_id='$protocol_idwe' and owner_id='$owner_id'order by id desc LIMIT 0,10";//and conceptm_status='new' 
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


<button class="accordion">Study Population, click to review</button>
 <div class="panel">
  
  
  
  
  
  
  
  
  
  <div class="form-group row success">
<label class="form-control-label col-sm-12"><!--<strong>Population: Proposed inclusion criteria:</strong> <span class="error">*</span><br />-->
  <?php 
$sqlstudyPop="SELECT * FROM ".$prefix."study_population where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc";
$QuerystudyPop = $mysqli->query($sqlstudyPop);// and owner_id='$owner_id'
$rstudyP = $QuerystudyPop->fetch_array();
  
  
$shcategoryID1=$rstudyP['ProposedInclusionCriteria'];
$categoryChunks1 = explode(".", $shcategoryID1);

$chop1="$categoryChunks1[0]";
$chop2="$categoryChunks1[1]";
  ?>                      
<?php
 //echo $chop1.'<br>';
  //echo $chop2.'<br>';
 ?></label>
</div>
<div class="line"></div>
                        
                        
    <div class="form-group row success">
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
   
                         
                     <div class="form-group row success">

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
                     <div class="form-group row success">
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

<div class="form-group row success">
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

                          
                       </label>
        
                       
    </div> 
    
                        
<div class="line"></div>
<div class="form-group row success">
<label class="form-control-label col-sm-12"><strong  style="font-weight:bold;">Community Engagement plan</strong> : <span class="error">*</span><br />
<?php echo $rstudyP['CommunityEngagementplan'];?>
</label>
               
    </div>                  
                            <div class="line"></div>   
                     <div class="form-group row">
                      <label class="form-control-label col-sm-12"><strong>Determination of Risk (Check all that applies)</strong> : <span class="error">*</span></label>
                      <?php
$sqlstudyPop2="SELECT * FROM ".$prefix."determination_of_risk where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc";
$QuerystudyPop2 = $mysqli->query($sqlstudyPop2);
$rstudyP2 = $QuerystudyPop2->fetch_array();?>
  <table border="1" cellspacing="0" cellpadding="0" class="newtable">
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

  
  
  
  
  
  
  
  
  
  
  
  </div><!--End-->
  



  
  <button class="accordion">Methodology, click to review</button>
  <div class="panel">
  <?php
   $sqlstudyDDw2="SELECT * FROM ".$prefix."submission where id='$protocol_idwe' and owner_id='$owner_id' order by id desc limit 0,1";
$QuerystudyDDw2 = $mysqli->query($sqlstudyDDw2);
$rstudyDDw2 = $QuerystudyDDw2->fetch_array();  

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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_task where submission_id='$protocol_idwe' and owner_id='$owner_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
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
$totalfiles = $resultfile->num_rows;
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
   <?php }///////////end function
   
   $sqlstudyff="SELECT *,DATE_FORMAT(`updated`,'%d/%m/%Y %H:%s:%i') AS updated FROM ".$prefix."submission where id='$protocol_idwe' order by id desc limit 0,1";
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
                             <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $rUsers2['name'];?></td>
                            <td><?php echo $rstudyff['updated'];?></td>

                          </tr>
                                        
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

<script>
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(-1);
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

    x.appendChild( new_row );
}
</script> 
<?php
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();

if($category=='AssignReviewersDel' and $id and $_GET['sid']){
    $sid=$_GET['sid'];
	$sqlA2Protocol2="delete from ".$prefix."submission_review_sr where protocol_id='$id' and id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	$message='<p class="error2">Reviewer has been removed.</p>';
	}

?>

<button id="myBtn">Click to Add Reviewers to this Protocol</button>   
<div style="clear:both;"></div>

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">

<?php echo $message;?>
<h4>Assigned Reviewer (s)</h4>
<table width="100%" border="0" class="success">
<tr>
    <td align="left">Reviewer</td>
    <td align="left">Type</td>
    <td align="left">Meeting</td>
    <td align="left"></td>
  </tr>
<?php

$sqlProtocols="SELECT * FROM ".$prefix."submission_review_sr  where protocol_id='$id' and recstatus='new' order by id desc";
$QueryProtocols=$mysqli->query($sqlProtocols);
$rTotalAnyAssigned=$QueryProtocols->num_rows;
while($sqProtocols = $QueryProtocols->fetch_array()){
	//Get Reviewer
$masrmApplctID=$sqProtocols['asrmApplctID'];
$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$masrmApplctID'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
?>

  
  <tr>
    <td width="30%" align="left" class="defmf2">
	<input name="reviewer[]" type="checkbox" value="<?php echo $sqProtocols['id'];?>"  class="required" checked="checked"/>
	<?php echo $sqReviewer['name'];?>
    <input name="submittedprotocol_id" type="hidden" value="<?php echo $protocol_idwe;?>"/>
    <input name="applicantID" type="hidden" value="<?php echo $sqProtocols['asrmApplctID'];?>"/>
    <input name="subjectCall" type="hidden" value="<?php echo $sqProtocols['subject'];?>"/>
    <input name="MainrecAffiliated_c" type="hidden" value="<?php echo $sqProtocols['recAffiliated_c'];?>"/>
    <input name="public_title_main" type="hidden" value="<?php echo $public_title;?>"/>
    </td>
    
    
    <td width="22%" align="left" style="padding-bottom:20px;" class="defmf2"><?php echo $sqProtocols['reviewtype'];?> </td>
    <td width="48%" align="left" class="defmf2"><?php echo $sqProtocols['subject'];?></td>
    <td width="48%" align="left" class="defmf2"><a href="main.php?option=AssignReviewersDel&id=<?php echo $id;?>&sid=<?php echo $sqProtocols['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
  </tr>



<?php }?>
</table>
<?php if($rTotalAnyAssigned){?><input name="doAssignReviewesConfirm" type="submit"  class="btn btn-primary" value="Assign Now"/><?php }?>
         </form>
        
        
        
 <!--Modal Popup-->       
        
   <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:50px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
     
    </div>
    <div class="modal-body" style="height:400px; overflow:scroll;">
   

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Add Reviewers: <span class="error">*</span></label>
<div class="col-sm-10">
<script language="JavaScript">
function toggle(source) {
    var checkbox = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i] != source)
            checkbox[i].checked = source.checked;
    }
}
</script>

<table width="100%" border="0" align="left">
 <tr>
  <td><strong><input type="checkbox" onclick="toggle(this);" /> Select All</strong></td>
  <td><strong>Reviewers</strong></td>
  <td><strong>Role</strong></td>
  </tr>


<?php
$sqlReviewer="SELECT * FROM ".$prefix."user  where (privillage='recreviewer' || privillage='secretary' || privillage='expert' || privillage='rechairperson' || privillage='revicechairperson' || privillage='communityrepresentative') and recAffiliated_id='$recAffiliated_id' order by name asc";
$QueryReviewer=$mysqli->query($sqlReviewer);
while($sqReviewer = $QueryReviewer->fetch_array()){
?>
 <tr>
  <td><input name="cfnreviewer[]" type="checkbox" value="<?php echo $sqReviewer['asrmApplctID'];?>" class="form-control  required"/></td>
    <td><?php echo $sqReviewer['name'];?></td>
    
    <td>
    
<select name="reviewtype<?php echo $sqReviewer['asrmApplctID'];?>" id="rvte" class="form-control  required">
<option value="">Please Select</option>
<option value="Primary Reviewer">Primary Reviewer</option>
<option value="Secondary Reviewer">Secondary Reviewer</option>
<option value="REC Member">REC Member</option>
<!--<option value="Expert Reviewer">Expert Reviewer</option>
<option value="Committee Members">Committee Members</option>-->
</select>

</td>
  </tr>





<?php }?>
</table>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>

</div>
</div> 


                        
 <?php /*?> <div class="form-group row">
<label class="col-sm-3 form-control-label">Choose Type: <span class="error">*</span></label>
<div class="col-sm-8">


<select name="reviewtype" id="reviewtype" class="form-control  required" required>
<option value="">Please Select</option>
<option value="Primary Reviewer">Primary Reviewer</option>
<option value="Secondary Reviewer">Secondary Reviewer</option>
<option value="Expert Reviewer">Expert Reviewer</option>
<option value="Committee Members">Committee Members</option>
</select>


</div>
</div> <?php */?>

<?php if($rstudym['type_of_review']!='Expedited Review'){// and $rstudym['type_of_review']!='Fast Track' and $rstudym['type_of_review']!='Exempt'?>
  <div class="form-group row">
  <label class="col-sm-3 form-control-label">Meeting Subject: <span class="error">*</span></label>
  <div class="col-sm-8">

  <select name="Meetingsubject" id="Meetingsubject" class="form-control">
  <option value="">Please Select</option>
<?php
$sqlMeeting="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$id' and meetingFor='protocol'";
$QueryMeeting=$mysqli->query($sqlMeeting);
while($sqMeeting = $QueryMeeting->fetch_array()){?>
<option value="<?php echo $sqMeeting['subject'];?>"><?php echo $sqMeeting['subject'];?></option>
<?php }?>
</select>

</div>
</div>

<?php }?> 

       <div class="form-group row">
   <div class="col-sm-8 offset-sm-3sss">
   <?php
   
$sqlMeeting2="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$id'";
$QueryMeeting2=$mysqli->query($sqlMeeting2);
$protocolMeeting2 = $QueryMeeting2->num_rows;

$sqlMeetingAlready="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and protocol_id='$id'";
$QueryMeetingAlready=$mysqli->query($sqlMeetingAlready);
$protocolMeetingAlready = $QueryMeetingAlready->num_rows;


$rstudym['type_of_review'];
if(!$protocolMeeting2 and $rstudym['type_of_review']!='Expedited Review' and $rstudym['type_of_review']!='Fast Track' and $rstudym['type_of_review']!='Exempt' and !$protocolMeetingAlready){echo "<span  style='color:#F00;'>Please Add meeting, Protocol will not be assigned without creating a meeting</span>";}


if($protocolMeeting2 and $rstudym['type_of_review']!='Expedited Review'){// and $rstudym['type_of_review']!='Fast Track'
?>
<input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Save Details" style="float:right;"/>
<?php }


// || $rstudym['type_of_review']=='Fast Track' || $rstudym['type_of_review']=='Exempt'
if($rstudym['type_of_review']=='Expedited Review' and $rstudym['type_of_review']!='Fast Track' and $rstudym['type_of_review']!='Exempt'){
?>
<input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Save Details" style="float:right;"/>
<?php }

if($protocolMeetingAlready>=1 and !$protocolMeeting2){
?>
<input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Save Details" style="float:right;"/>
<?php }


?>
                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->   
        
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>