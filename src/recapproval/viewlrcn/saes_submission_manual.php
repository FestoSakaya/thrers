<ul id="countrytabs" class="shadetabs">
<li><a href="#">Welcome, Apply for SAEs</a></li>

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
                        <h3 class="h4"></h3><small><?php //echo $rstudym['public_title'];?></small>
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
if($_POST['dosubmitSAEs']=='Save'){

function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
 if($_FILES['AttachEvienceofcorrective']['name']){
$AttachEvienceofcorrective = preg_replace('/\s+/', '_', $_FILES['AttachEvienceofcorrective']['name']);
$AttachEvienceofcorrective2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['AttachEvienceofcorrective']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['AttachEvienceofcorrective']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['AttachEvienceofcorrective']['tmp_name']), $targetw1);

}
	$project_id=$mysqli->real_escape_string($_POST['project_id']);
	$owner_id=$mysqli->real_escape_string($_POST['asrmApplctID']);

	$date_of_birth=$mysqli->real_escape_string($_POST['year'].'-'.$_POST['dmonth'].'-'.$_POST['date']);
	
	$gender=$mysqli->real_escape_string($_POST['gender']);
	$ArticleBeignStudied=$mysqli->real_escape_string($_POST['ArticleBeignStudied']);
	$OnSetDate=$mysqli->real_escape_string($_POST['onsetyear'].'-'.$_POST['month'].'-'.$_POST['onsetday']);
	$ArticleParticipantReceived=$mysqli->real_escape_string($_POST['ArticleParticipantReceived']);
	$RouteOfAdministration=$mysqli->real_escape_string($_POST['RouteOfAdministration']);
    $public_title=$mysqli->real_escape_string($_POST['public_title']);
	
	$CauseOfDeath=$mysqli->real_escape_string($_POST['CauseOfDeath']);
	$DateOfAdmission=$mysqli->real_escape_string($_POST['DateOfAdmission']);
	$DescripitionOfTheEvent=$mysqli->real_escape_string($_POST['DescripitionOfTheEvent']);
	$TreatmentOfEvent=$mysqli->real_escape_string($_POST['TreatmentOfEvent']);
	$ConcomitantMedicalProblems=$mysqli->real_escape_string($_POST['ConcomitantMedicalProblems']);
	$EventAbateAfterStopping=$mysqli->real_escape_string($_POST['EventAbateAfterStopping']);
	$EventOutCome=$mysqli->real_escape_string($_POST['EventOutCome']);
	$CorrectiveActionUndertaken=$mysqli->real_escape_string($_POST['CorrectiveActionUndertaken']);

$wmRenewals="select * from ".$prefix."submission where  id='$project_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();
	$recAffiliated_id=$mysqli->real_escape_string($rRenewals['recAffiliated_id']);

if($_POST['EventResultedin']){
for ($i=0; $i < count($_POST['EventResultedin']); $i++) { 
$EventResultedin.=$mysqli->real_escape_string($_POST['EventResultedin'][$i].'.');
}
}
/*for ($i=0; $i < count($_POST['EventRelatedToStudy']); $i++) { 
$EventRelatedToStudy.=$mysqli->real_escape_string($_POST['EventRelatedToStudy'][$i]).'.';
}*/
$EventRelatedToStudy=$mysqli->real_escape_string($_POST['EventRelatedToStudy']);	
$sessionasrmApplctID=$_SESSION['asrmApplctID'];

$sqlprotocalSubSelCAll="SELECT * FROM ".$prefix."saes order by id desc limit 0,1";
$QprotocalSub2SelCall = $mysqli->query($sqlprotocalSubSelCAll);
$rstudyCall = $QprotocalSub2SelCall->fetch_array();

$code="$sessionasrmApplctID$project_id".$rstudyCall['id']+1;

$sqlprotocalSubSel="SELECT * FROM ".$prefix."saes where protocol_id='$project_id' and owner_id='$sessionasrmApplctID' and RouteOfAdministration='$RouteOfAdministration' order by id desc";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$totalstudy = $QprotocalSub2Sel->num_rows;
if(!$totalstudy){
	$sqlA2="insert into ".$prefix."saes (`protocol_id`,`recAffiliated_id`,`owner_id`,`date_of_birth`,`gender`,`ArticleBeignStudied`,`OnSetDate`,`ArticleParticipantReceived`,`RouteOfAdministration`,`EventResultedin`,`CauseOfDeath`,`DateOfAdmission`,`DescripitionOfTheEvent`,`TreatmentOfEvent`,`ConcomitantMedicalProblems`,`EventRelatedToStudy`,`EventAbateAfterStopping`,`EventOutCome`,`CorrectiveActionUndertaken`,`AttachEvienceofcorrective`,`datesubmitted`,`status`,`assignedto`,`ammendType`,`code`,`public_title`) 

values('$project_id','$recAffiliated_id','$sessionasrmApplctID','$date_of_birth','$gender','$ArticleBeignStudied','$OnSetDate','$ArticleParticipantReceived','$RouteOfAdministration','$EventResultedin','$CauseOfDeath','$DateOfAdmission','$DescripitionOfTheEvent','$TreatmentOfEvent','$ConcomitantMedicalProblems','$EventRelatedToStudy','$EventAbateAfterStopping','$EventOutCome','$CorrectiveActionUndertaken','$AttachEvienceofcorrective',now(),'Pending','Not Assigned','manual','$code','$public_title')";
$mysqli->query($sqlA2);
}


if($totalstudy){
$sqlA2="update ".$prefix."saes set `protocol_id`='$project_id',`recAffiliated_id`='$recAffiliated_id',`date_of_birth`='$date_of_birth',`gender`='$gender',`ArticleBeignStudied`='$ArticleBeignStudied',`OnSetDate`='$OnSetDate',`ArticleParticipantReceived`='$ArticleParticipantReceived',`RouteOfAdministration`='$RouteOfAdministration',`EventResultedin`='$EventResultedin',`CauseOfDeath`='$CauseOfDeath',`DateOfAdmission`='$DateOfAdmission',`DescripitionOfTheEvent`='$DescripitionOfTheEvent',`TreatmentOfEvent`='$TreatmentOfEvent',`ConcomitantMedicalProblems`='$ConcomitantMedicalProblems',`EventRelatedToStudy`='$EventRelatedToStudy',`EventAbateAfterStopping`='$EventAbateAfterStopping',`EventOutCome`='$EventOutCome',`CorrectiveActionUndertaken`='$CorrectiveActionUndertaken',`datesubmitted`=now(),`public_title`='$public_title' where `owner_id`='$sessionasrmApplctID' and `status`='Pending'";
$mysqli->query($sqlA2);
}

 if($_FILES['AttachEvienceofcorrective']['name'] and $totalstudy){
	 
	$sqlA2="update ".$prefix."saes set `AttachEvienceofcorrective`='$AttachEvienceofcorrective' where `owner_id`='$sessionasrmApplctID' and `status`='Pending'";
$mysqli->query($sqlA2); 
 }
 
$message='<p class="success">Dear '.$session_fullname.', details have been submitted.</p>';
logaction("$session_fullname added SAEs");

}//end post

if($category=='FinalManualSubmitSAEs'){
	$project_id=$mysqli->real_escape_string($id);
	$sessionasrmApplctID=$_SESSION['asrmApplctID'];
	////Get Protocol ID
$sqlstudy="SELECT * FROM ".$prefix."submission where `protocol_id`='$project_id'  order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$rstudy = $Querystudy->fetch_array();

$public_title=$mysqli->real_escape_string($_POST['public_title']);
$recAffiliated_idmm=$rstudy['recAffiliated_id'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_idmm'";
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
	//FInish submission
$sqlA2Protocol1="update ".$prefix."saes  set `status`='Submitted' where `owner_id`='$sessionasrmApplctID' and status='Pending'";
$mysqli->query($sqlA2Protocol1);



require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 


///Now Send mail
require_once("viewlrcn/mail_template_make_final_submission_saes.php");

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
//$mail->addCc('mutumba.beth@yahoo.com',$recOriginalNamem);//
$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "SAEs Confirmation - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



$message="<p class='success'>Dear $name !<br><br>
Thank you for your SAEs for protocol titled, '<b>$public_title</b>' Your SAEs have been submitted on <b>$today</b>.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=mysaes">';
}


$sqlstudy="SELECT * FROM ".$prefix."saes where `owner_id`='$asrmApplctID' and status='pending' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
  <div class="form-group row success">
                          <label class="col-sm-6 form-control-label">Protocol you are submitting to <span class="error">*</span></label>
  <div class="col-sm-10">
  <textarea name="public_title" id="MyTextBox3" cols="" rows="5" class="form-control  required"><?php echo $rstudy['public_title'];?></textarea>
  
  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
  </div>
  
                        </div>
                        <div class="line"></div>
 
 <div class="form-group row success">
<label class="col-sm-10 form-control-label">Date of Birth : <span class="error">*</span></label>
<div class="col-sm-10">
                          <?php
$shcategoryID4=$rstudy['date_of_birth'];
$categoryChunks = explode("-", $shcategoryID4);
$chop1="$categoryChunks[0]";
$chop2="$categoryChunks[1]";
$chop3="$categoryChunks[2]";
$currentMonth=date("m");
?>
<select name="date" id="ddate" class="form-control" tabindex="6" style=" width:100px; float:left;">
    <option value="">Day</option>
   <option value="01" <?php if($chop3=='01'){?> selected="selected"<?php }?>>&nbsp;01</option>
   <option value="02" <?php if($chop3=='02'){?> selected="selected"<?php }?>>&nbsp;02</option>
   <option value="03" <?php if($chop3=='03'){?> selected="selected"<?php }?>>&nbsp;03</option>
   <option value="04" <?php if($chop3=='04'){?> selected="selected"<?php }?>>&nbsp;04</option>
   <option value="05" <?php if($chop3=='05'){?> selected="selected"<?php }?>>&nbsp;05</option>
   <option value="06" <?php if($chop3=='06'){?> selected="selected"<?php }?>>&nbsp;06</option>
   <option value="07" <?php if($chop3=='07'){?> selected="selected"<?php }?>>&nbsp;07</option>
   <option value="08" <?php if($chop3=='08'){?> selected="selected"<?php }?>>&nbsp;08</option>
   <option value="09" <?php if($chop3=='09'){?> selected="selected"<?php }?>>&nbsp;09</option>
   <option value="10" <?php if($chop3=='10'){?> selected="selected"<?php }?>>&nbsp;10</option>
   <option value="11" <?php if($chop3=='11'){?> selected="selected"<?php }?>>&nbsp;11</option>
   <option value="12" <?php if($chop3=='12'){?> selected="selected"<?php }?>>&nbsp;12</option>
   <option value="13" <?php if($chop3=='13'){?> selected="selected"<?php }?>>&nbsp;13</option>
   <option value="14" <?php if($chop3=='14'){?> selected="selected"<?php }?>>&nbsp;14</option>
   <option value="15" <?php if($chop3=='15'){?> selected="selected"<?php }?>>&nbsp;15</option>
   <option value="16" <?php if($chop3=='16'){?> selected="selected"<?php }?>>&nbsp;16</option>
   <option value="17" <?php if($chop3=='17'){?> selected="selected"<?php }?>>&nbsp;17</option>
   <option value="18" <?php if($chop3=='18'){?> selected="selected"<?php }?>>&nbsp;18</option>
   <option value="19" <?php if($chop3=='19'){?> selected="selected"<?php }?>>&nbsp;19</option>
   <option value="20" <?php if($chop3=='20'){?> selected="selected"<?php }?>>&nbsp;20</option>
   <option value="21" <?php if($chop3=='21'){?> selected="selected"<?php }?>>&nbsp;21</option>
   <option value="22" <?php if($chop3=='22'){?> selected="selected"<?php }?>>&nbsp;22</option>
   <option value="23" <?php if($chop3=='23'){?> selected="selected"<?php }?>>&nbsp;23</option>
   <option value="24" <?php if($chop3=='24'){?> selected="selected"<?php }?>>&nbsp;24</option>
   <option value="25" <?php if($chop3=='25'){?> selected="selected"<?php }?>>&nbsp;25</option>
   <option value="26" <?php if($chop3=='26'){?> selected="selected"<?php }?>>&nbsp;26</option>
   <option value="27" <?php if($chop3=='27'){?> selected="selected"<?php }?>>&nbsp;27</option>
   <option value="28" <?php if($chop3=='28'){?> selected="selected"<?php }?>>&nbsp;28</option>
   <option value="29" <?php if($chop3=='29'){?> selected="selected"<?php }?>>&nbsp;29</option>
   <option value="30" <?php if($chop3=='30'){?> selected="selected"<?php }?>>&nbsp;30</option>
   <option value="31" <?php if($chop3=='31'){?> selected="selected"<?php }?>>&nbsp;31</option>
  </select>
<select name="dmonth" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
   <option value="01" <?php if($chop2=='01' || $currentMonth=='01'){?> selected="selected"<?php }?>>&nbsp;January</option>
<option value="02" <?php if($chop2=='02' || $currentMonth=='02'){?> selected="selected"<?php }?>>&nbsp;February</option>
   <option value="03" <?php if($chop2=='03' || $currentMonth=='03'){?> selected="selected"<?php }?>>&nbsp;March</option>
<option value="04" <?php if($chop2=='04' || $currentMonth=='04'){?> selected="selected"<?php }?>>&nbsp;April</option>
<option value="05" <?php if($chop2=='05' || $currentMonth=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select>                     
                           
  
                              
    <select name="year" id="dyear" class="form-control" tabindex=8"" style=" width:100px; float:left;">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1940);

$current_year = date('Y');

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>"  <?php if($chop1==$count){?> selected="selected"<?php }?>><?php echo $count;?></option>
<?php }?>

  </select></div>
  <div style="clear:both;"></div>
                        </div>
                        
                        
                        <div class="line"></div>
                        
                         <div class="form-group row success">
<label class="col-sm-10 form-control-label">Gender: <span class="error">*</span></label>
<div class="col-sm-10">
<select name="gender" id="gender" class="form-control" tabindex=8"" style=" width:300px; float:left;">
<option value="">Select</option>
<option value="Male" <?php if($rstudy['gender']=='Male'){?>selected="selected"<?php }?>>Male</option>
<option value="Female" <?php if($rstudy['gender']=='Female'){?>selected="selected"<?php }?>>Female</option>

  </select></div>

<div style="clear:both;"></div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Article/Product beign studied <span class="error">*</span></label>
                          <div class="col-sm-10">
                          <input type="text" name="ArticleBeignStudied" id="ArticleBeignStudied" class="form-control  required" value="<?php echo $rstudy['ArticleBeignStudied'];?>">
                         
                       </div>
                        </div>
                        <div class="line"></div>
                        
                        
                       
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">On set date : <span class="error">*</span></label>
                          
                          
                          
                          
                          
                          
                          
<div class="col-sm-10">
<?php
$shcategoryID5=$rstudy['OnSetDate'];
$categoryChunks = explode("-", $shcategoryID5);
$chop11="$categoryChunks[0]";
$chop22="$categoryChunks[1]";
$chop33="$categoryChunks[2]";
?>
<select name="onsetyear" id="onsetyear" class="form-control required" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulateMeeting(this.value)">
<option value="">Year</option>
<?php
define('DOB_YEAR_STARTM', 2019);

$current_yearm = date('Y')+10;

for ($countm = $current_yearm; $countm >= DOB_YEAR_STARTM; $countm--)
{
?>
 <option value="<?php echo $countm;?>" <?php if($chop11==$countm){?> selected="selected"<?php }?>><?php echo $countm;?></option>
<?php }?>

  </select>
                         
   <div id="monthdiv"></div>
                              
  <select name="onsetday" id="onsetday" class="form-control required" tabindex="6" style=" width:80px; float:left;">
    <option value="">Date</option>
 <option value="01" <?php if($chop33=='01'){?> selected="selected"<?php }?>>&nbsp;01</option>
   <option value="02" <?php if($chop33=='02'){?> selected="selected"<?php }?>>&nbsp;02</option>
   <option value="03" <?php if($chop33=='03'){?> selected="selected"<?php }?>>&nbsp;03</option>
   <option value="04" <?php if($chop33=='04'){?> selected="selected"<?php }?>>&nbsp;04</option>
   <option value="05" <?php if($chop33=='05'){?> selected="selected"<?php }?>>&nbsp;05</option>
   <option value="06" <?php if($chop33=='06'){?> selected="selected"<?php }?>>&nbsp;06</option>
   <option value="07" <?php if($chop33=='07'){?> selected="selected"<?php }?>>&nbsp;07</option>
   <option value="08" <?php if($chop33=='08'){?> selected="selected"<?php }?>>&nbsp;08</option>
   <option value="09" <?php if($chop33=='09'){?> selected="selected"<?php }?>>&nbsp;09</option>
   <option value="10" <?php if($chop33=='10'){?> selected="selected"<?php }?>>&nbsp;10</option>
   <option value="11" <?php if($chop33=='11'){?> selected="selected"<?php }?>>&nbsp;11</option>
   <option value="12" <?php if($chop33=='12'){?> selected="selected"<?php }?>>&nbsp;12</option>
   <option value="13" <?php if($chop33=='13'){?> selected="selected"<?php }?>>&nbsp;13</option>
   <option value="14" <?php if($chop33=='14'){?> selected="selected"<?php }?>>&nbsp;14</option>
   <option value="15" <?php if($chop33=='15'){?> selected="selected"<?php }?>>&nbsp;15</option>
   <option value="16" <?php if($chop33=='16'){?> selected="selected"<?php }?>>&nbsp;16</option>
   <option value="17" <?php if($chop33=='17'){?> selected="selected"<?php }?>>&nbsp;17</option>
   <option value="18" <?php if($chop33=='18'){?> selected="selected"<?php }?>>&nbsp;18</option>
   <option value="19" <?php if($chop33=='19'){?> selected="selected"<?php }?>>&nbsp;19</option>
   <option value="20" <?php if($chop33=='20'){?> selected="selected"<?php }?>>&nbsp;20</option>
   <option value="21" <?php if($chop33=='21'){?> selected="selected"<?php }?>>&nbsp;21</option>
   <option value="22" <?php if($chop33=='22'){?> selected="selected"<?php }?>>&nbsp;22</option>
   <option value="23" <?php if($chop33=='23'){?> selected="selected"<?php }?>>&nbsp;23</option>
   <option value="24" <?php if($chop33=='24'){?> selected="selected"<?php }?>>&nbsp;24</option>
   <option value="25" <?php if($chop33=='25'){?> selected="selected"<?php }?>>&nbsp;25</option>
   <option value="26" <?php if($chop33=='26'){?> selected="selected"<?php }?>>&nbsp;26</option>
   <option value="27" <?php if($chop33=='27'){?> selected="selected"<?php }?>>&nbsp;27</option>
   <option value="28" <?php if($chop33=='28'){?> selected="selected"<?php }?>>&nbsp;28</option>
   <option value="29" <?php if($chop33=='29'){?> selected="selected"<?php }?>>&nbsp;29</option>
   <option value="30" <?php if($chop33=='30'){?> selected="selected"<?php }?>>&nbsp;30</option>
   <option value="31" <?php if($chop33=='31'){?> selected="selected"<?php }?>>&nbsp;31</option>
   
  </select>

   </div>               
         <div style="clear:both;"></div>              
                        </div>
                        
                        
                        <div class="line"></div>
                        
                           <div class="form-group row success">
                          <label class="col-sm-6 form-control-label">Article participant received (If Un Blinded) <span class="error">*</span></label>
  <div class="col-sm-10">
  <textarea name="ArticleParticipantReceived" id="MyTextBox3" cols="" rows="5" class="form-control  required"><?php echo $rstudy['ArticleParticipantReceived'];?></textarea>
  
  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
  </div>
  
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                         
                         <div class="col-sm-10">
                          <label class="col-sm-10 form-control-label">Route of administration <span class="error">*</span></label>
                        <textarea name="RouteOfAdministration" id="MyTextBox" cols="" rows="5" class="form-control  required"><?php echo $rstudy['RouteOfAdministration'];?></textarea>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        </div>
                        </div>
                        
           <?php
	$shcategoryImmmmm=$rstudy['EventResultedin'];
$categoryChunksmm = explode(".", $shcategoryImmmmm);

$chopmm1="$categoryChunksmm[0]";
$chopmm2="$categoryChunksmm[1]";
$chopmm3="$categoryChunksmm[2]";
$chopmm4="$categoryChunksmm[3]";
$chopmm5="$categoryChunksmm[4]";

?>             <div class="line"></div>
                        
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Event resulted in <span class="error">*</span>:</label><br />
<label class="col-sm-10 form-control-label"><input name="EventResultedin[]" type="checkbox" value="Death"  <?php if($chopmm1=='Death' || $chopmm2=='Death' || $chopmm3=='Death' || $chopmm4=='Death' || $chopmm5=='Death'){?>checked="checked"<?php }?>/> Death:  Cause of death <input name="CauseOfDeath" type="text" value="<?php echo $rstudy['CauseOfDeath'];?>"/> <br />


 <input name="EventResultedin[]" type="checkbox" value="Threat To Life" <?php if($chopmm1=='Threat To Life' || $chopmm2=='Threat To Life' || $chopmm3=='Threat To Life' || $chopmm4=='Threat To Life' || $chopmm5=='Threat To Life'){?>checked="checked"<?php }?>/> Threat to life<br />
 
 
 <input name="EventResultedin[]" type="checkbox" value="Inpatient Or Prolonged Hospitalisation" <?php if($chopmm1=='Inpatient Or Prolonged Hospitalisation' || $chopmm2=='Inpatient Or Prolonged Hospitalisation' || $chopmm3=='Inpatient Or Prolonged Hospitalisation' || $chopmm4=='Inpatient Or Prolonged Hospitalisation' || $chopmm5=='Inpatient Or Prolonged Hospitalisation'){?>checked="checked"<?php }?>/> Inpatient or prolonged hospitalisation: Date of admission: <input name="DateOfAdmission" type="date" value="<?php echo $rstudy['DateOfAdmission'];?>"/><br />
 
 <input name="EventResultedin[]" type="checkbox" value="Severe Or Permanent Disability" <?php if($chopmm1=='Severe Or Permanent Disability' || $chopmm2=='Severe Or Permanent Disability' || $chopmm3=='Severe Or Permanent Disability' || $chopmm4=='Severe Or Permanent Disability' || $chopmm5=='Severe Or Permanent Disability'){?>checked="checked"<?php }?>/> Severe or permanent disability  <br />
 
 
  <input name="EventResultedin[]" type="checkbox" value="None Of The Above" <?php if($chopmm1=='None Of The Above' || $chopmm2=='None Of The Above' || $chopmm3=='None Of The Above' || $chopmm4=='None Of The Above' || $chopmm5=='None Of The Above'){?>checked="checked"<?php }?>/> None of the above     </label>                 
                        
                       
                        
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Descripition of the event <span class="error">*</span></label>
                          
                          <div class="col-sm-10">
                        <textarea name="DescripitionOfTheEvent" id="MyTextBox7" cols="" rows="5" class="form-control  required"><?php echo $rstudy['DescripitionOfTheEvent'];?></textarea>
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        
                        </div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Treatment of event <span class="error">*</span></label>
                          
                          <div class="col-sm-10">
                        <textarea name="TreatmentOfEvent" id="MyTextBox4" cols="" rows="5" class="form-control  required"><?php echo $rstudy['TreatmentOfEvent'];?></textarea>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        
                        </div>
                        </div>
                        
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Concomitant medical problems and treatments <span class="error">*</span></label><div class="col-sm-10">
                        <textarea name="ConcomitantMedicalProblems" id="MyTextBox5" cols="" rows="5" class="form-control  required"><?php echo $rstudy['ConcomitantMedicalProblems'];?></textarea>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        </div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <?php
	$shcategoryhhh=$rstudy['EventRelatedToStudy'];
$categoryChunkhh = explode(".", $shcategoryhhh);

$chophh1="$categoryChunkhh[0]";
$chophh2="$categoryChunkhh[1]";
$chophh3="$categoryChunkhh[2]";
$chophh4="$categoryChunkhh[3]";
$chophh5="$categoryChunkhh[4]";

?> 
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Was the event related to this study article? <span class="error">*</span><br /><br />
                        <input name="EventRelatedToStudy" type="radio" value="Definitely" <?php if($chophh1=='Definitely' || $chophh2=='Definitely' || $chophh3=='Definitely' || $chophh4=='Definitely' || $chophh5=='Definitely'){?>checked="checked"<?php }?>/> Definitely<br />
                        
                         <input name="EventRelatedToStudy" type="radio" value="Probably" <?php if($chophh1=='Probably' || $chophh2=='Probably' || $chophh3=='Probably' || $chophh4=='Probably' || $chophh5=='Probably'){?>checked="checked"<?php }?>/> Probably<br />
                         
                          <input name="EventRelatedToStudy" type="radio" value="Possibly" <?php if($chophh1=='Possibly' || $chophh2=='Possibly' || $chophh3=='Possibly' || $chophh4=='Possibly' || $chophh5=='Possibly'){?>checked="checked"<?php }?>/> Possibly<br />
                          
                           <input name="EventRelatedToStudy" type="radio" value="Unlikely" <?php if($chophh1=='Unlikely' || $chophh2=='Unlikely' || $chophh3=='Unlikely' || $chophh4=='Unlikely' || $chophh5=='Unlikely'){?>checked="checked"<?php }?>/> Unlikely<br />
                           
                            <input name="EventRelatedToStudy" type="radio" value="Not Related" <?php if($chophh1=='Not Related' || $chophh2=='Not Related' || $chophh3=='Not Related' || $chophh4=='Not Related' || $chophh5=='Not Related'){?>checked="checked"<?php }?>/> Not Related<br /></label>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Did the event abate after stopping study article?  <span class="error">*</span>
                        <input name="EventAbateAfterStopping" type="radio" value="Yes" <?php if($rstudy['EventAbateAfterStopping']=='Yes'){?>checked="checked"<?php }?>/> Yes 
                        <input name="EventAbateAfterStopping" type="radio" value="No" <?php if($rstudy['EventAbateAfterStopping']=='No'){?>checked="checked"<?php }?> /> No</label>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label"> Out come <span class="error">*</span></label>
                          <div class="col-sm-10">
                        <textarea name="EventOutCome" id="MyTextBox7" cols="" rows="5" class="form-control  required"><?php echo $rstudy['EventOutCome'];?></textarea>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        
                        </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                        
                          <label class="col-sm-10 form-control-label">Describe the corrective action undertaken  <span class="error">*</span> </label>
                          <div class="col-sm-10">
                        <textarea name="CorrectiveActionUndertaken" id="MyTextBox6" cols="" rows="5" class="form-control  required"><?php echo $rstudy['CorrectiveActionUndertaken'];?></textarea><br />
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>

<label class="col-sm-10 form-control-label">Attach Evidence of corrective action (PDF only) <span class="error">*</span><br />


<?php if($rstudy['AttachEvienceofcorrective']){?>

<input name="AttachEvienceofcorrective" type="file" id="AttachEvienceofcorrective"/><br />
<a href="./files/uploads/<?php echo $rstudy['AttachEvienceofcorrective'];?>" target="_blank" style="font-weight:bold;">Click to view</a>
<?php }?>

<?php if(!$rstudy['AttachEvienceofcorrective']){?>

<input name="AttachEvienceofcorrective" type="file" id="AttachEvienceofcorrective" class="required" required/>
<?php }?>

  </label>
</div>
</div>
                        <div class="line"></div>
                        
                        
                   
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="dosubmitSAEs" type="submit"  class="btn btn-primary" value="Save"/>


<?php if($totalstudy){?>					
					<input name="doSaveFinish" type="button"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='<?php echo $base_url;?>main.php?option=FinalSubmitSAEs&id=<?php echo $rstudy['protocol_id'];?>'"/>
					
					<?php }?>
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