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
$protocol_idwe=$rstudym['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doAssignReviewes']=='Assign'){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

foreach($_POST['reviewer'] as $cfn_reviewer) {
$cfnreviewer= $cfn_reviewer;

$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$cfnreviewer'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
$assignedtoName=$sqReviewer['name'];
$usrm_email=$sqReviewer['email'];

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$subject=$mysqli->real_escape_string($_POST['subject'.$cfn_reviewer]);
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype'.$cfn_reviewer]);
	
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];

	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$queryConceptLogs="select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' and reviewer_id='$cfnreviewer'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;

if(!$rTotalConceptLogs and $subject){
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'Pending','stage1','$reviewtype','$subject')";
$mysqli->query($sqlA2rr); 

$update="update ".$prefix."submission set status='Scheduled for Review',assignedto='Assigned' where id='$id' and protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user'";
$mysqli->query($update);
///Now Send mail
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
$mail->addCc('mutumba.beth@yahoo.com',$recOriginalName);//
$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalName);//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email, $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($usrm_email, $assignedtoName); //Reply-To Address -- CHANGE --$usrm_email


$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$subject - Protocol for Review";
$body="
Dear $assignedtoName !<br><br>
<b>RE: $subject - $reviewtype</b><br><br>
A protocol, '<b>$public_title</b>' has been assigned to you for review. Please <a href='".$base_url."/'>Click here</a>  to access the protocol.<br>
$subject<br>
Do not hesitate to contact us on the adress below incase of any difficulties accessing the system.<br>

Thank you,
<br><br>

Best Regards<br>
$contacts

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

}
		}
$message='<p class="success">Thank you, protocol has been assigned.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=dashboard/" />';
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
<?php
$qRPersoneld="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_idwe' order by objectivetype asc";
$RPersoneld=$mysqli->query($qRPersoneld);
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows['objective'];?></label><br />
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
    <td width="184" align="left" valign="bottom"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_other_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_other_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year3'];?></td>
    
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_total'];?></td>
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
<?php
$year1=($rS['rstug_personnel_year1']+$rS['rstug_travel_year1']+$rS['rstug_materials_year1']+$rS['rstug_adminstration_year1']+$rS['rstug_results_year1']+$rS['rstug_other_year1']+$rS['rstug_contigency_year1']);

$year2=($rS['rstug_personnel_year2']+$rS['rstug_travel_year2']+$rS['rstug_materials_year2']+$rS['rstug_adminstration_year2']+$rS['rstug_results_year2']+$rS['rstug_other_year2']+$rS['rstug_contigency_year2']);

$year3=($rS['rstug_personnel_year3']+$rS['rstug_travel_year3']+$rS['rstug_materials_year3']+$rS['rstug_adminstration_year3']+$rS['rstug_results_year3']+$rS['rstug_other_year3']+$rS['rstug_contigency_year3']);

$year4=($rS['rstug_personnel_year4']+$rS['rstug_travel_year4']+$rS['rstug_materials_year4']+$rS['rstug_adminstration_year4']+$rS['rstug_results_year4']+$rS['rstug_other_year4']+$rS['rstug_contigency_year4']);

$year5=($rS['rstug_personnel_year5']+$rS['rstug_travel_year5']+$rS['rstug_materials_year5']+$rS['rstug_adminstration_year5']+$rS['rstug_results_year5']+$rS['rstug_other_year5']+$rS['rstug_contigency_year5']);
?>
 <tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="143" align="center" valign="bottom"><strong><?php echo $year1;?></strong></td>
    <td width="148" align="center" valign="bottom"><strong><?php echo $year2;?></strong></td>
    <td width="169" align="center" valign="bottom" ><strong><?php echo $year3;?></strong></td>
    <td width="151" align="center" valign="bottom" ><strong><?php echo $year4;?></strong></td>
    <td width="156" align="center" valign="bottom" ><strong><?php echo $year5;?></strong></td>
    <td width="115" align="center" valign="bottom" ><b><?php
	
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
    <td width="184" align="left" valign="bottom"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year3'];?></td>
    
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_total'];?></td>
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
  $sqlstudyff="SELECT * FROM ".$prefix."submission where id='$protocol_idwe' order by id desc limit 0,1";
$Querystudyff = $mysqli->query($sqlstudyff);
$rstudyff = $Querystudyff->fetch_array(); 
?>              

<label class="form-control-label"><strong style="font-weight:bold;">Primary Sponsor:</strong> <?php echo $rstudyff['primary_sponsor'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Secondary Sponsor:</strong> <?php echo $rstudyff['secondary_sponsor'];?></label>                 
                      
                      
  </div>
  


<button class="accordion">Study Description, click to review</button>
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
                            <th>Duration</th>
                            <th>Total No of participants</th>
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
                          </tr>
    <?php 
   $Totalparticipants=($rInvestigator['participants']+$Totalparticipants);
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


<label class="form-control-label"><strong style="font-weight:bold;">Inclusion criteria:</strong> <?php echo $rstudymethodology['inclusion_criteria'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Exclusion criteria:</strong> <?php echo $rstudymethodology['exclusion_criteria'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Estimated date of initial recruitment:</strong> <?php echo $rstudyDD['recruitment_init_date'];?></label> 
<hr />
<label class="form-control-label"><strong style="font-weight:bold;">Interventions:</strong> <?php echo $rstudymethodology['interventions'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Primary outcomes:</strong> <?php echo $rstudymethodology['primary_outcome'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Secondary outcomes:</strong> <?php echo $rstudymethodology['secondary_outcome'];?></label>

<hr />

<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?>




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
<label class="form-control-label col-sm-12"><strong>Population: Proposed inclusion criteria:</strong> <span class="error">*</span><br />
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
 echo $chop1.'<br>';
  echo $chop2.'<br>';
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
  


<button class="accordion">Bibliography, click to review</button>
  <div class="panel">
  <?php
   $sqlstudyDDw="SELECT * FROM ".$prefix."submission where id='$protocol_idwe' and owner_id='$owner_id' order by id desc limit 0,1";
$QuerystudyDDw = $mysqli->query($sqlstudyDDw);
$rstudyDDw = $QuerystudyDDw->fetch_array();  
?>
  <hr />



<h3 style="font-size:14px;">Employment</h3><hr />
<table width="100%" border="0" id="POITable">
        <tr>
            <td width="23%"><strong>Institution (in full)</strong></td>
            <td width="25%"><strong>Designation</strong></td>
            <td width="11%"><strong>Year</strong></td>
            <td width="24%"><strong>Period</strong></td>
        </tr>
        
               <?php
$qRPersoneld2="select * from ".$prefix."employment_details  where rstug_user_id='$owner_id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
while ($rowRows2 = $RPersoneld2->fetch_array())
{ 
	?>

<tr>
            <td id="grid"><?php echo $rowRows2['rstug_institution'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_designation'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_year'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_period'];?> </td>
        </tr>

<?php
}

?> 
   
    </table>
    
    <br />
   
   <h3 style="font-size:14px;">Education</h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

<table width="100%" border="0" id="POITable2">
        <tr>
            <td width="22%"><strong>Institution (in full)</strong></td>
            <td width="26%"><strong>Qualification</strong></td>
            <td width="11%"><strong>Year</strong></td>
            <td width="24%"><strong>Field of  Specialization</strong></td>
        </tr>
        
        
        
        
             <?php
$qRPersoneld="select * from ".$prefix."education_history  where rstug_user_id='$owner_id'";
$RPersoneld=$mysqli->query($qRPersoneld);
while ($rowRows = $RPersoneld->fetch_array())
{ 
	?>

<tr>
            <td id="grid"><?php echo $rowRows['rstug_educn_university'];?> </td>
            <td id="grid"><?php echo $rowRows['rstug_educn_designation'];?> </td>
            <td id="grid"><?php echo $rowRows['rstug_educn_year'];?> </td>
            <td id="grid"><?php echo $rowRows['rstug_educn_period'];?> </td>
        </tr>

<?php
}

?> 
        
        
    </table>
    </td>
    </tr>
    

                
</table>
  
  </div>
  
  <button class="accordion">Methodology, click to review</button>
  <div class="panel">
  <?php
   $sqlstudyDDw2="SELECT * FROM ".$prefix."submission where id='$protocol_idwe' and owner_id='$owner_id' order by id desc limit 0,1";
$QuerystudyDDw2 = $mysqli->query($sqlstudyDDw2);
$rstudyDDw2 = $QuerystudyDDw2->fetch_array();  
?>
<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?>

<label class="form-control-label"><strong style="font-weight:bold;">General Procedures:</strong> <?php echo $rstudymethodology['general_procedures'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Analysis Plan:</strong> <?php echo $rstudymethodology['analysis_plan'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Ethical Considerations:</strong> <?php echo $rstudymethodology['ethical_considerations'];?></label>

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
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,10";//and conceptm_status='new' 
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
<?php
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Please select Reviewer (s)</h4>
<?php echo $message;?>
<table width="100%" border="0" class="success">
<tr>
    <td align="left">Reviewer</td>
    <td align="left">Choose Type</td>
    <td align="left">Choose Meeting</td>
  </tr>
<?php
$sqlReviewer="SELECT * FROM ".$prefix."user  where privillage='recreviewer' and recAffiliated_id='$recAffiliated_id'";
$QueryReviewer=$mysqli->query($sqlReviewer);
while($sqReviewer = $QueryReviewer->fetch_array()){
?>

  
  <tr>
    <td width="30%" align="left" class="defmf2"><div style="width:100%; padding-bottom:8px;"><input name="reviewer[]" type="checkbox" value="<?php echo $sqReviewer['asrmApplctID'];?>"  class="required"/>&nbsp;<?php echo $sqReviewer['name'];?></div></td>
    
    
    <td width="22%" align="left" style="padding-bottom:20px;" class="defmf2"> <input name="reviewtype<?php echo $sqReviewer['asrmApplctID'];?>" type="radio" value="Primary Reviewer" class="required" /> Primary Reviewer<br />
    <input name="reviewtype<?php echo $sqReviewer['asrmApplctID'];?>" type="radio" value="Secondary Reviewer"  class="required" /> Secondary Reviewer<br />
    <input name="reviewtype<?php echo $sqReviewer['asrmApplctID'];?>" type="radio" value="Tertiary Reviewer"  class="required"/> Tertiary Reviewer
    
    </td>
    <td width="48%" align="left" class="defmf2">
    
    <?php
$sqlMeeting="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$id'";
$QueryMeeting=$mysqli->query($sqlMeeting);
$protocolMeeting = $QueryMeeting->num_rows;

if(!$protocolMeeting){echo "<span  style='color:#F00;'>Please Add meeting, Protocol will not be assigned without creating a meeting</span>";}

while($sqMeeting = $QueryMeeting->fetch_array()){?>
<input name="subject<?php echo $sqReviewer['asrmApplctID'];?>" type="radio" value="<?php echo $sqMeeting['subject'];?>"  class="required"/> <?php echo $sqMeeting['subject'];?><br /><?php 
}?></td>
  </tr>



<?php }?>
</table>
<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">

 <?php
 $sqlReviewermm="SELECT * FROM ".$prefix."user  where privillage='recreviewer' and recAffiliated_id='$recAffiliated_id'";
$QueryReviewermm=$mysqli->query($sqlReviewermm);
$totalUserReviewer = $QueryReviewermm->num_rows;
if($totalUserReviewer and $protocolMeeting){
?><input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Assign"/><?php }
if(!$totalUserReviewer){?><p style="color:#F00;">Please add reviewers to the system</p><?php }?>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
                          </div>
                        </div>

         </form>
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>