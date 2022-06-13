<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Deviations View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."deviations where deviationID='$id' order by deviationID desc limit 0,1";
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

////Payment Proof
	if($_POST['doSaveCommentsDraft']=='Save Comments' and $asrmApplctID and $_POST['status']=='Approved' and $id){

	$AssessorComments=$_POST['AssessorComments'];
	$status=$_POST['status'];
	$newStatus=$_POST['status'];
	$amendment_id=$_POST['amendment_id'];
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	///Chck if there was no update
$qcommentDrafts1="select * from ".$prefix."completeness_check_comments_amendment where amendment_id='$id' and reviewer_id='$asrmApplctID'";
$rcommentDrafts1=$mysqli->query($qcommentDrafts1);//assessorComment
if($rcommentDrafts1->num_rows){
	/////////////////////////
$Insert_send="update ".$prefix."completeness_check_comments_amendment set `chcomments`='$AssessorComments',`status`='$status' where amendment_id='$id' and reviewer_id='$asrmApplctID'";
$mysqli->query($Insert_send);

}
if(!$rcommentDrafts1->num_rows){
/////////////////////////
$Insert_send="insert into ".$prefix."completeness_check_comments_amendment (`owner_id`,`protocol_id`,`reviewer_id`,`chcomments`,`chdate`,`status`,`amendment_id`) values ('$owner_id','$protocol_idwe','$asrmApplctID','$AssessorComments',now(),'$status','$id')";
$mysqli->query($Insert_send);

/////Send Email

}
$sqlupdateSm="update ".$prefix."deviations set assignedto='Not Assigned',is_sent='1',status='Scheduled for Review', CompletenessCheck='Approved' where deviationID='$id'";
$mysqli->query($sqlupdateSm);



require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 
require_once("viewlrcn/mail_template_completeness_check_deviations_approved.php");

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


$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
$mail->addCc($recchairEmail,$recOriginalNamem);//
//$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//
//$mail->addBcc('mawandammoses@gmail.com',$recOriginalNamem);//
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

echo $message="<p class='success'>Completeness Check for , '<b>$public_title</b> has been marked as <b>$status</b>.'</p>";
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=MyDeviationsREC">';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

}////////////////////////////End Approval




if($_POST['status']=='Rejected' and $_POST['AssessorComments'] and $_POST['public_title'] and $_POST['recAffiliated_id'] and $id){
	$AssessorComments=$_POST['AssessorComments'];
	$status=$_POST['status'];
	$newStatus=$_POST['status'];
	$amendment_id=$_POST['amendment_id'];
	$public_title=$mysqli->real_escape_string($_POST['public_title']);	
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$code=$mysqli->real_escape_string($_POST['code']);
	
$qcommentDrafts1="select * from ".$prefix."completeness_check_comments_amendment where amendment_id='$id' and reviewer_id='$asrmApplctID'";
$rcommentDrafts1=$mysqli->query($qcommentDrafts1);//assessorComment
if($rcommentDrafts1->num_rows){
	/////////////////////////
$Insert_send="update ".$prefix."completeness_check_comments_amendment set `chcomments`='$AssessorComments',`status`='$status' where amendment_id='$amendment_id' and reviewer_id='$asrmApplctID'";
$mysqli->query($Insert_send);

}
if(!$rcommentDrafts1->num_rows){
/////////////////////////
$Insert_send="insert into ".$prefix."completeness_check_comments_amendment (`owner_id`,`protocol_id`,`reviewer_id`,`chcomments`,`chdate`,`status`,`amendment_id`) values ('$owner_id','$protocol_idwe','$asrmApplctID','$AssessorComments',now(),'$status','$id')";
$mysqli->query($Insert_send);

/////Send Email

}
	/////Update submissions Table
	
	
$sqlupdateSm="update ".$prefix."deviations set assignedto='Not Assigned',is_sent='0',status='$newStatus', CompletenessCheck='Rejected' where deviationID='$id'";
$mysqli->query($sqlupdateSm);



$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$owner_id'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$accroname=$recNamew['accroname'];




require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 
require_once("viewlrcn/mail_template_completeness_check_deviations.php");

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


$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
$mail->addCc($recchairEmail,$recOriginalNamem);//
//$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//
//$mail->addBcc('mawandammoses@gmail.com',$recOriginalNamem);//
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



echo $message="<p class='success'>Completeness Check for , '<b>$public_title</b> has been marked as <b>$status</b>.'</p>";
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=MyDeviationsREC">';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
}//end template for rejection




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
$sqlstudy="SELECT * FROM ".$prefix."deviations where deviationID='$id' order by deviationID desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?> 

<button class="accordion">Protocol Details</button>
  <div class="panel">

   
   <div style="clear:both;"></div>

<?php 
if($rstudy['ammendType']=='manual'){?>
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Protocol Title: <br /></label>
<?php echo $rstudy['protocol_title'];?>
</div>
<div class="line"></div> 
<?php }?>

                                          

<?php if($rstudy['ammendType']=='online'){?>
<div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose REC: <br /></label>

<select name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rstudy['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?> 
</select>

</div>
<div class="line"></div> 
   <?php }?> 
   </div>



<button class="accordion">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</button>
  <div class="panel">
 <?php


$shcategoryID3=$rstudy['parta'];
$categoryChunks3 = explode("|", $shcategoryID3);

$chop1="$categoryChunks3[0]";
$chop2="$categoryChunks3[1]";
$chop3="$categoryChunks3[2]";
$chop4="$categoryChunks3[3]";
$chop5="$categoryChunks3[4]";
$chop6="$categoryChunks3[5]";
$chop7="$categoryChunks3[6]";
$chop8="$categoryChunks3[7]";
$chop9="$categoryChunks3[8]";
$chop10="$categoryChunks3[9]";
//////////////////////////////////////////
$shcategoryID4=$rstudy['partb'];
$categoryChunks4 = explode("|", $shcategoryID4);

$chei1="$categoryChunks4[0]";
$chei2="$categoryChunks4[1]";
$chei3="$categoryChunks4[2]";
$chei4="$categoryChunks4[3]";
$chei5="$categoryChunks4[4]";
$chei6="$categoryChunks4[5]";
$chei7="$categoryChunks4[6]";
$chei8="$categoryChunks4[7]";
$chei9="$categoryChunks4[8]";
$chei10="$categoryChunks4[9]";
?>
                    
                        
                                           
                       <div class="form-group row success">
                        <label class="form-control-label" style="font-weight:bold;">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</label>
                        </div>
                   
                   <div class="line"></div>
                        <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PDDateofoccurrence" id="PDDateofoccurrence" class="form-control  required" value="<?php echo $rstudy['PDDateofoccurrence'];?>" readonly="readonly">
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">2.	Description of deviation:</label>
                                                  
                   <textarea name="PDDescriptionofdeviation" id="MyTextBox3" cols="" rows="5" class="form-control  required"  readonly="readonly"><?php echo $rstudy['PDDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>         
                          
                          
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
    
                        </div>
                        <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">3.	Root cause of deviation:</label>
                                      
                          
                         <textarea name="Rootcauseofdeviation" id="MyTextBox4" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Rootcauseofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p> 
                          
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">4.	Corrective action taken:</label>
                          
                  <textarea name="Correctiveactiontaken" id="MyTextBox5" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Correctiveactiontaken'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>          
                          
                        </div>
                        <div class="line"></div>
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">5.	Measures to mitigate deviation:</label>
           
  <?php

$qRPersoneld="select * from ".$prefix."saes_measures_mitigate_dev  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

        </tr>

        </table>

   
<?php

while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows['Measurestomitigatedeviation'];?> </label><br />
<?php
}

?> 
                     
</div>



  </div><!--Panel A Ends-->


<!--Panel B Ends-->  
<button class="accordion">B)	Protocol violation (May pose high risk to participants and protocol implementation)</button>
  <div class="panel">
 
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PVDateofoccurrence" id="PVDateofoccurrence" class="form-control  required" value="<?php echo $rstudy['PVDateofoccurrence'];?>" readonly="readonly">
                        </div>
         
                        
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">2.	Description of violation :</label>
                  
                          
                          <textarea name="PVDescriptionofdeviation" id="MyTextBox" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['PVDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                          
                          
                        </div>
             
             
             
         
                        <h3>Part A;.</h3>
                          <div class="form-group row success">
                          <label class="col-sm-11 form-control-label">
          <input name="parta[]" type="checkbox" value="Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures" <?php if($chop1=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop2=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop3=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop4=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop5=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop6=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop7=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop8=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop9=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures'){?>checked="checked"<?php }?>> Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures <br>
          
          
          
              
<input name="parta[]" type="checkbox" value="Enrollment of a subject who did not meet all inclusion/exclusion criteria" <?php if($chop1=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop2=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop3=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop4=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop5=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop6=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop7=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop8=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop9=='Enrollment of a subject who did not meet all inclusion/exclusion criteria'){?>checked="checked"<?php }?>> Enrollment of a subject who did not meet all inclusion/exclusion criteria<br>

<input name="parta[]" type="checkbox" value="Performing study procedure not approved by the IRB/ modifications" <?php if($chop1=='Performing study procedure not approved by the IRB/ modifications' || $chop2=='Performing study procedure not approved by the IRB/ modifications' || $chop3=='Performing study procedure not approved by the IRB/ modifications' || $chop4=='Performing study procedure not approved by the IRB/ modifications' || $chop5=='Performing study procedure not approved by the IRB/ modifications' || $chop6=='Performing study procedure not approved by the IRB/ modifications' || $chop7=='Performing study procedure not approved by the IRB/ modifications' || $chop8=='Performing study procedure not approved by the IRB/ modifications' || $chop9=='Performing study procedure not approved by the IRB/ modifications'){?>checked="checked"<?php }?>> Performing study procedure not approved by the IRB/ modifications<br>

<input name="parta[]" type="checkbox" value="Screening procedure required by protocol not done" <?php if($chop1=='Screening procedure required by protocol not done' || $chop2=='Screening procedure required by protocol not done' || $chop3=='Screening procedure required by protocol not done' || $chop4=='Screening procedure required by protocol not done' || $chop5=='Screening procedure required by protocol not done' || $chop6=='Screening procedure required by protocol not done' || $chop7=='Screening procedure required by protocol not done' || $chop8=='Screening procedure required by protocol not done' || $chop9=='Screening procedure required by protocol not done'){?>checked="checked"<?php }?>> Screening procedure required by protocol not done<br>

<input name="parta[]" type="checkbox" value="Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB" <?php if($chop1=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop2=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop3=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop4=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop5=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop6=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop7=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop8=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop9=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB'){?>checked="checked"<?php }?>> Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB<strong></strong><br>


<input name="parta[]" type="checkbox" value="Failure to perform a required lab test that may affect  subject safety or data integrity" <?php if($chop1=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop2=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop3=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop4=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop5=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop6=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop7=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop8=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop9=='Failure to perform a required lab test that may affect  subject safety or data integrity'){?>checked="checked"<?php }?>> Failure to perform a required lab test that may affect  subject safety or data integrity<br>


<input name="parta[]" type="checkbox" value="Drug/study medication dispensing or dosing error"  <?php if($chop1=='Drug/study medication dispensing or dosing error' || $chop2=='Drug/study medication dispensing or dosing error' || $chop3=='Drug/study medication dispensing or dosing error' || $chop4=='Drug/study medication dispensing or dosing error' || $chop5=='Drug/study medication dispensing or dosing error' || $chop6=='Drug/study medication dispensing or dosing error' || $chop7=='Drug/study medication dispensing or dosing error' || $chop8=='Drug/study medication dispensing or dosing error' || $chop9=='Drug/study medication dispensing or dosing error'){?>checked="checked"<?php }?>> Drug/study medication dispensing or dosing error<strong></strong><br>


<input name="parta[]" type="checkbox" value="Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety"  <?php if($chop1=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop2=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop3=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop4=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop5=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop6=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop7=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop8=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop9=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety'){?>checked="checked"<?php }?>> Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety<br>


<input name="parta[]" type="checkbox" value="Failure to follow safety monitoring plan" <?php if($chop1=='Failure to follow safety monitoring plan' || $chop2=='Failure to follow safety monitoring plan' || $chop3=='Failure to follow safety monitoring plan' || $chop4=='Failure to follow safety monitoring plan' || $chop5=='Failure to follow safety monitoring plan' || $chop6=='Failure to follow safety monitoring plan' || $chop7=='Failure to follow safety monitoring plan' || $chop8=='Failure to follow safety monitoring plan' || $chop9=='Failure to follow safety monitoring plan'){?>checked="checked"<?php }?>> Failure to follow safety monitoring plan<br>


<input name="parta[]" type="checkbox" value="Other" onChange="getDeviationOther(this.value)" <?php if($chop1=='Other' || $chop2=='Other' || $chop3=='Other' || $chop4=='Other' || $chop5=='Other' || $chop6=='Other' || $chop7=='Other' || $chop8=='Other' || $chop9=='Other'){?>checked="checked"<?php }?>/> Others </label>            
 
 
 <div id="DeviationOtherdiv"><?php if($rstudy['partaOther']){?><textarea name="partaOther" id="partaOther" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['partaOther'];?></textarea><?php }?></div>
 
 
              
                        </div>
              
                        
                        
                 <h3>Part B:</h3>
                          <div class="form-group row success">
                          <label class="col-sm-6 form-control-label"></label>
<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Implementation of unapproved  recruitment procedures"  <?php if($chei1=='Implementation of unapproved  recruitment procedures' || $chei2=='Implementation of unapproved  recruitment procedures' || $chei3=='Implementation of unapproved  recruitment procedures' || $chei4=='Implementation of unapproved  recruitment procedures' || $chei5=='Implementation of unapproved  recruitment procedures' || $chei6=='Implementation of unapproved  recruitment procedures' || $chei7=='Implementation of unapproved  recruitment procedures' || $chei8=='Implementation of unapproved  recruitment procedures'){?>checked="checked"<?php }?>> Implementation of unapproved  recruitment procedures</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Missing original signed and dated consent form (only a photocopy available)" <?php if($chei1=='Missing original signed and dated consent form (only a photocopy available)' || $chei2=='Missing original signed and dated consent form (only a photocopy available)' || $chei3=='Missing original signed and dated consent form (only a photocopy available)' || $chei4=='Missing original signed and dated consent form (only a photocopy available)' || $chei5=='Missing original signed and dated consent form (only a photocopy available)' || $chei6=='Missing original signed and dated consent form (only a photocopy available)' || $chei7=='Missing original signed and dated consent form (only a photocopy available)' || $chei8=='Missing original signed and dated consent form (only a photocopy available)'){?>checked="checked"<?php }?>> Missing original signed and dated consent form (only a photocopy available)</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Missing pages of executed consent form" <?php if($chei1=='Missing pages of executed consent form' || $chei2=='Missing pages of executed consent form' || $chei3=='Missing pages of executed consent form' || $chei4=='Missing pages of executed consent form' || $chei5=='Missing pages of executed consent form' || $chei6=='Missing pages of executed consent form' || $chei7=='Missing pages of executed consent form' || $chei8=='Missing pages of executed consent form'){?>checked="checked"<?php }?>> Missing pages of executed consent form</label>

  
<label class="col-sm-11 form-control-label" style="padding-left:50px;">(Inappropriate documentation of informed consent, including: Missing subject signature, Missing investigator signature, Copy not given to the person signing the form, Someone other than the subject dated the consent form, Individual obtaining informed consent not listed on IRB approved study personnel  list)</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form" <?php if($chei1=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei2=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei3=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei4=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei5=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei6=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei7=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei8=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form'){?>checked="checked"<?php }?>> Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;" <?php if($chei1=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei2=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei3=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei4=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei5=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei6=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei7=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei8=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;'){?>checked="checked"<?php }?>> Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;</label>
  

<label class="col-sm-11 form-control-label" style="padding-left:50px;">(Study procedure conducted out of sequence, Omitting an approved portion of the protocol, Failure to perform a required lab test, Missing lab results, Enrollment of ineligible subject (e.g., subject's age was 6 months above age  limit), Study visit conducted outside of required timeframe) </label>

 
<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Over-enrollment" <?php if($chei1=='Over-enrollment' || $chei2=='Over-enrollment' || $chei3=='Over-enrollment' || $chei4=='Over-enrollment' || $chei5=='Over-enrollment' || $chei6=='Over-enrollment' || $chei7=='Over-enrollment' || $chei8=='Over-enrollment'){?>checked="checked"<?php }?>> Over-enrollment</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Enrollment of subjects after IRB-approval of study expired or lapsed;"<?php if($chei1=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei2=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei3=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei4=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei5=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei6=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei7=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei8=='Enrollment of subjects after IRB-approval of study expired or lapsed;'){?>checked="checked"<?php }?>> Enrollment of subjects after IRB-approval of study expired or lapsed;</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Failure to submit continuing  review application to the IRB before study expiration" <?php if($chei1=='Failure to submit continuing  review application to the IRB before study expiration' || $chei2=='Failure to submit continuing  review application to the IRB before study expiration' || $chei3=='Failure to submit continuing  review application to the IRB before study expiration' || $chei4=='Failure to submit continuing  review application to the IRB before study expiration' || $chei5=='Failure to submit continuing  review application to the IRB before study expiration' || $chei6=='Failure to submit continuing  review application to the IRB before study expiration' || $chei7=='Failure to submit continuing  review application to the IRB before study expiration' || $chei8=='Failure to submit continuing  review application to the IRB before study expiration'){?>checked="checked"<?php }?>> Failure to submit continuing  review application to the IRB before study expiration</label>
              
                        </div>       
                        
  
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">3. Root cause of violation </label>

  <textarea name="Rootcauseofviolation_b" id="MyTextBox7" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Rootcauseofviolation_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>


</div>


                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">4. Corrective action  </label>
<textarea name="Correctiveaction_b" id="MyTextBox7" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Correctiveaction_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>



</div>


                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">5. Measures to mitigate violation  </label>

  <?php
$qRPersoneld2="select * from ".$prefix."saes_measures_mitigate_dev_b  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable2" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

        </tr>

        </table>



<?php

while ($rowRows2 = $RPersoneld2->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows2['Measurestomitigatedeviation'];?> </label><br />
<?php
}

?> 
</div>


  </div><!--Panel B Ends-->
  

    <div style="width:40%;">

      <h3 style="font-size:14px;"><strong>Completeness Check</strong></h3>
      <hr />
 
 <?php
$qcommentDrafts="select * from ".$prefix."completeness_check_comments_amendment where amendment_id='$renewal_id' and reviewer_id='$asrmApplctID'";
$rcommentDrafts=$mysqli->query($qcommentDrafts);
$ResultsCommentDrafyts=$rcommentDrafts->fetch_array();?>
<form action="" method="post" name="regForm" id="regForm" autocomplete="false">  
  
<input name="status" type="radio" value="Approved" class="required"  onChange="getCompleteness(this.value)"> Approve &nbsp; <input name="status" type="radio" value="Rejected" class="required" onChange="getCompleteness(this.value)"> Reject<br>

<div id="completenessdiv"><?php //if($ResultsCommentDrafyts['chcomments']){?>
<textarea name="AssessorComments" cols="" rows="" style="width:100%;"><?php //echo $ResultsCommentDrafyts['chcomments'];?></textarea><?php //}?></div>


<input name="public_title" type="hidden" value="<?php echo $rstudym['protocol_title'];?>" />
<input name="recAffiliated_id" type="hidden" value="<?php echo $rstudym['recAffiliated_id'];?>" />


<input id="c-signup-submit" name="doSaveCommentsDraft" class="btnLogin" value="Save Comments" type="submit"  tabindex="10" style="float:right;"/>
</form>
  <div style="clear:both;"></div>  
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