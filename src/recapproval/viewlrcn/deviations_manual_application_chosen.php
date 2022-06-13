<input name="" type="button" class="search dropbtn2" value="Click to Deviation" onClick="window.location.href='./main.php?option=Deviations&id=<?php echo $id;?>'"/>


<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

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

if($_POST['doSubmitDeviations']=='Save Details' and $id){

	
	$project_id=$mysqli->real_escape_string($_POST['project_id']);
	
$wmRenewals="select * from ".$prefix."submission where  id='$project_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();

	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	/*$protocol_title=$rRenewals['public_title'];*/
	$protocol_title=$mysqli->real_escape_string($_POST['protocol_title']);
	
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);

	$PDDateofoccurrence=$mysqli->real_escape_string($_POST['PDDateofoccurrence']);
	$PDDescriptionofdeviation=$mysqli->real_escape_string($_POST['PDDescriptionofdeviation']);
	$Rootcauseofdeviation=$mysqli->real_escape_string($_POST['Rootcauseofdeviation']);
	$Correctiveactiontaken=$mysqli->real_escape_string($_POST['Correctiveactiontaken']);
	$PVDateofoccurrence=$mysqli->real_escape_string($_POST['PVDateofoccurrence']);
	$PVDescriptionofdeviation=$mysqli->real_escape_string($_POST['PVDescriptionofdeviation']);
	$Rootcauseofviolation_b=$mysqli->real_escape_string($_POST['Rootcauseofviolation_b']);
	$Correctiveaction_b=$mysqli->real_escape_string($_POST['Correctiveaction_b']);
	
/*if($_FILES['attachpayment']['name']){
$attachpayment = preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']);
$attachpayment2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$targetw1 = "files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachpayment']['tmp_name']), $targetw1);

$sqlA2Protocol="update ".$prefix."deviations  set `paymentStatus`='Not Confirmed',`paymentAttachment`='$attachpayment2' where deviationID='$id' and owner_id='$sessionasrmApplctID'";
$mysqli->query($sqlA2Protocol);
	}*/
if($_POST['partaOther']){
	$partaOther=$mysqli->real_escape_string($_POST['partaOther']);
}
	
	if($_POST['parta']){
	for ($i=0; $i < count($_POST['parta']); $i++) { 
$parta.=$mysqli->real_escape_string($_POST['parta'][$i]).'|';
}
	}
	if($_POST['partb']){
for ($i=0; $i < count($_POST['partb']); $i++) { 
$partb.=$mysqli->real_escape_string($_POST['partb'][$i]).'|';
}
	}

$sqlA2="update ".$prefix."deviations set  `PDDateofoccurrence`='$PDDateofoccurrence',`PDDescriptionofdeviation`='$PDDescriptionofdeviation',`Rootcauseofdeviation`='$PDDescriptionofdeviation',`Correctiveactiontaken`='$Correctiveactiontaken',`Measurestomitigatedeviation`='$Measurestomitigatedeviation',`PVDateofoccurrence`='$PVDateofoccurrence',`PVDescriptionofdeviation`='$PVDescriptionofdeviation',`parta`='$parta',`partaOther`='$partaOther',`partb`='$partb',`Rootcauseofviolation_b`='$Rootcauseofviolation_b',`Correctiveaction_b`='$Correctiveaction_b',`Measurestomitigateviolation_b`='$Measurestomitigateviolation_b',`protocol_title`='$protocol_title' where owner_id='$sessionasrmApplctID' and deviationID='$id'";
$mysqli->query($sqlA2);
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, click finish button below to complete your submission</p>';	

	$deviationId=$id;

if($_POST['Measurestomitigatedeviation']){
for ($i=0; $i < count($_POST['Measurestomitigatedeviation']); $i++) {
$institutioncode=$_POST['Measurestomitigatedeviation'][$i];
$institutioncode2.=$_POST['Measurestomitigatedeviation'][$i];



$wmObjectives="select * from ".$prefix."saes_measures_mitigate_dev where  owner_id='$sessionasrmApplctID' and renewal_id='$id' and Measurestomitigatedeviation='$institutioncode'";
$cmdwbObjectives = $mysqli->query($wmObjectives);
$totalObjectives = $cmdwbObjectives->num_rows;

if(!$totalObjectives and $institutioncode and $id){
	
$Insert_QR2="insert into ".$prefix."saes_measures_mitigate_dev (`protocol_id`,`owner_id`,`sae_id`,`Measurestomitigatedeviation`,`created`,`renewal_id`) values ('$project_id','$sessionasrmApplctID','$id','$institutioncode',now(),'$id')";
$inseted=$mysqli->query($Insert_QR2);
}
	}
}

if($_POST['Measurestomitigateviolation_b']){
for ($i=0; $i < count($_POST['Measurestomitigateviolation_b']); $i++) {
$institutioncodem=$_POST['Measurestomitigateviolation_b'][$i];
$institutioncodem2.=$_POST['Measurestomitigateviolation_b'][$i];



$wmObjectivesm="select * from ".$prefix."saes_measures_mitigate_dev_b where  owner_id='$sessionasrmApplctID' and renewal_id='$id' and Measurestomitigatedeviation='$institutioncodem'";
$cmdwbObjectivesm = $mysqli->query($wmObjectivesm);
$totalObjectivesm = $cmdwbObjectivesm->num_rows;

if(!$totalObjectivesm and $id and $institutioncodem){
	
$Insert_QR2m="insert into ".$prefix."saes_measures_mitigate_dev_b (`protocol_id`,`owner_id`,`sae_id`,`Measurestomitigatedeviation`,`created`,`renewal_id`) values ('$project_id','$sessionasrmApplctID','$id','$institutioncodem',now(),'$id')";
$insetedm=$mysqli->query($Insert_QR2m);
}
	}
}


}//end post



if($category=='FinalSubmitDeviations' and $id){
	////Get Protocol ID
$sqlstudy="SELECT * FROM ".$prefix."deviations where `deviationID`='$id'  order by deviationID desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$rstudy = $Querystudy->fetch_array();

$public_title=$rstudy['protocol_title'];
$recAffiliated_idmm=$rstudy['recAffiliated_id'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_idmm'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$sessionasrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
	//FInish submission
$sqlA2Protocol1="update ".$prefix."deviations  set `status`='Submitted',`is_sent`='1' where `owner_id`='$sessionasrmApplctID' and `deviationID`='$id'";
$mysqli->query($sqlA2Protocol1);



require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 


///Now Send mail
require_once("viewlrcn/mail_template_make_final_submission_deviations.php");

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
//$mail->addCc('mawandammoses@gmail.com',$recOriginalNamem);//
$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --s
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Deviations Confirmation - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



$message="<p class='success'>Dear $name !<br><br>
Thank you for your deviations for protocol titled, '<b>$public_title</b>' Your Deviations have been submitted on <b>$today</b>.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
/*echo("<script>location.href = '$base_url/recapprova./main.php?option=MyDeviations/';</script>");*/
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=MyDeviations">';
}


$sqlstudy="SELECT * FROM ".$prefix."deviations where `owner_id`='$sessionasrmApplctID' and deviationID='$id' order by deviationID desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$chosen=$rstudy['chosen'];
$project_id=$rstudy['protocol_id'];
$protocol_title=$rstudy['protocol_title'];
if(isset($message)){echo $message;}

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

   
   <div style="clear:both;"></div>
<form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<input name="project_id" type="hidden" value="<?php echo $project_id;?>"/>
<input name="protocol_title" type="hidden" value="<?php echo $protocol_title;?>"/>
  <?php 
  if($chosen=='Deviation'){?>
  <div class="form-group row success">
                        <label class="form-control-label" style="font-weight:bold;">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</label>
                        </div>
                   
                   <div class="line"></div>
                        <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PDDateofoccurrence" id="PDDateofoccurrence" class="form-control  required" value="<?php echo $rstudy['PDDateofoccurrence'];?>">
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">2.	Description of deviation:</label>
                                                  
                   <textarea name="PDDescriptionofdeviation" id="MyTextBox3" cols="" rows="5" class="form-control  required"><?php echo $rstudy['PDDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>         
                          
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
    
                        </div>
                        <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">3.	Root cause of deviation:</label>
                                      
                          
                         <textarea name="Rootcauseofdeviation" id="MyTextBox4" cols="" rows="5" class="form-control  required"><?php echo $rstudy['Rootcauseofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p> 
                          
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">4.	Corrective action taken:</label>
                          
                  <textarea name="Correctiveactiontaken" id="MyTextBox5" cols="" rows="5" class="form-control  required"><?php echo $rstudy['Correctiveactiontaken'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>          
                          
                        </div>
                        <div class="line"></div>
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">5.	Measures to mitigate deviation:</label>
           
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



	
  new_row.cells[2].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}
</script>
  <?php
 $dvid=$_GET['dvid'];
  if($_GET['comobje']=='del'){
$qRDel="delete from ".$prefix."saes_measures_mitigate_dev where owner_id='$sessionasrmApplctID' and renewal_id='$id' and id='$dvid'";
$mysqli->query($qRDel);
}

$qRPersoneld="select * from ".$prefix."saes_measures_mitigate_dev  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

            <th width="12%">&nbsp;</th>
            <th width="11%">&nbsp;</th>
        </tr>
        <tr>
            <td width="3%" style="display:none;">1</td>
  
              <td align="left">
              
<?php if(!$RPersoneld->num_rows){?>
<input type="text" name="Measurestomitigatedeviation[]" id="Measurestomitigatedeviation" tabindex="5"  class="form-control required" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
    
    
<?php if($RPersoneld->num_rows){?>
<input type="text" name="Measurestomitigatedeviation[]" id="Measurestomitigatedeviation" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add More" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
   </table>
   
<?php

if($RPersoneld->num_rows){
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows['Measurestomitigatedeviation'];?> <a href="main.php?option=ChooseDeviationsManual&id=<?php echo $id;?>&comobje=del&dvid=<?php echo $rowRows['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></label><br />
<?php
}

?> 
        
        
 <?php }//end totas?>                        
                          
                        </div>
                        <div class="line"></div>
                        
                        
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
 
 
 <div id="DeviationOtherdiv"><?php if($rstudy['partaOther']){?><textarea name="partaOther" id="partaOther" cols="" rows="5" class="form-control  required"><?php echo $rstudy['partaOther'];?></textarea><?php }?></div>
 
 
              
                        </div>
                        <div class="line"></div>
                        
                        
                        
<?php 
  }//end Daviation Chosen
//Violation has been chosen
  if($chosen=='Violation'){?>
                         <div class="form-group row success">
                          <label class="form-control-label"  style="font-weight:bold;">B)	Protocol violation (May pose high risk to participants and protocol implementation)</label>
    
                          
                        </div>
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PVDateofoccurrence" id="PVDateofoccurrence" class="form-control" value="<?php echo $rstudy['PVDateofoccurrence'];?>">
                        </div>
                        <div class="line"></div>
                        
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">2.	Description of violation :</label>
                  
                          
                          <textarea name="PVDescriptionofdeviation" id="MyTextBox" cols="" rows="5" class="form-control"><?php echo $rstudy['PVDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                          
                          
                        </div>
             
             
             
                        <div class="line"></div>
                       
                        
                        
                <!-- <h3>Part B:</h3>-->
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
                        
     <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">3. Root cause of violation </label>

  <textarea name="Rootcauseofviolation_b" id="MyTextBox7" cols="" rows="5" class="form-control"><?php echo $rstudy['Rootcauseofviolation_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>


</div>

    <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">4. Corrective action  </label>
<textarea name="Correctiveaction_b" id="MyTextBox7" cols="" rows="5" class="form-control"><?php echo $rstudy['Correctiveaction_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>



</div>

    <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">5. Measures to mitigate violation  </label>


 <script>
function deleteRow2(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable2').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
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



	
  new_row.cells[2].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}
</script>
  <?php
  $bdiv=$_GET['bdiv'];
  if($_GET['comobjem']=='del'){
$qRDel2="delete from ".$prefix."saes_measures_mitigate_dev_b where owner_id='$sessionasrmApplctID' and renewal_id='$id' and id='$id'";
$mysqli->query($qRDel2);
}

$qRPersoneld2="select * from ".$prefix."saes_measures_mitigate_dev_b  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable2" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

            <th width="12%">&nbsp;</th>
            <th width="11%">&nbsp;</th>
        </tr>
        <tr>
            <td width="3%" style="display:none;">1</td>
  
              <td align="left">
              
<?php if(!$RPersoneld2->num_rows){?>
<input type="text" name="Measurestomitigateviolation_b[]" id="Measurestomitigateviolation_b" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
    
    
<?php if($RPersoneld2->num_rows){?>
<input type="text" name="Measurestomitigateviolation_b[]" id="Measurestomitigateviolation_b" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow2(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add More" onClick="insRow2()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
   </table>


<?php

if($RPersoneld2->num_rows){
while ($rowRows2 = $RPersoneld2->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows2['Measurestomitigatedeviation'];?> <a href="main.php?option=ChooseDeviationsManual&id=<?php echo $id;?>&desv=del&bdiv=<?php echo $rowRows2['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></label><br />
<?php
}

?> 
        
        
 <?php }//end totas?> 


</div>
<?php 
///End Violation Chosen
  }
  /////////////////////////////////****************************From Here, user has chosen both**************************////////////
  ?>
  <?php 
  if($chosen=='Both'){?>
  <div class="form-group row success">
                        <label class="form-control-label" style="font-weight:bold;">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</label>
                        </div>
                   
                   <div class="line"></div>
                        <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PDDateofoccurrence" id="PDDateofoccurrence" class="form-control  required" value="<?php echo $rstudy['PDDateofoccurrence'];?>">
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">2.	Description of deviation:</label>
                                                  
                   <textarea name="PDDescriptionofdeviation" id="MyTextBox3" cols="" rows="5" class="form-control  required"><?php echo $rstudy['PDDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>         
                          
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
    
                        </div>
                        <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">3.	Root cause of deviation:</label>
                                      
                          
                         <textarea name="Rootcauseofdeviation" id="MyTextBox4" cols="" rows="5" class="form-control  required"><?php echo $rstudy['Rootcauseofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p> 
                          
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">4.	Corrective action taken:</label>
                          
                  <textarea name="Correctiveactiontaken" id="MyTextBox5" cols="" rows="5" class="form-control  required"><?php echo $rstudy['Correctiveactiontaken'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>          
                          
                        </div>
                        <div class="line"></div>
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">5.	Measures to mitigate deviation:</label>
           
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



	
  new_row.cells[2].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}
</script>
  <?php
 $dvid=$_GET['dvid'];
  if($_GET['comobje']=='del'){
$qRDel="delete from ".$prefix."saes_measures_mitigate_dev where owner_id='$sessionasrmApplctID' and renewal_id='$id' and id='$dvid'";
$mysqli->query($qRDel);
}

$qRPersoneld="select * from ".$prefix."saes_measures_mitigate_dev  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

            <th width="12%">&nbsp;</th>
            <th width="11%">&nbsp;</th>
        </tr>
        <tr>
            <td width="3%" style="display:none;">1</td>
  
              <td align="left">
              
<?php if(!$RPersoneld->num_rows){?>
<input type="text" name="Measurestomitigatedeviation[]" id="Measurestomitigatedeviation" tabindex="5"  class="form-control required" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
    
    
<?php if($RPersoneld->num_rows){?>
<input type="text" name="Measurestomitigatedeviation[]" id="Measurestomitigatedeviation" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add More" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
   </table>
   
<?php

if($RPersoneld->num_rows){
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows['Measurestomitigatedeviation'];?> <a href="main.php?option=ChooseDeviationsManual&id=<?php echo $id;?>&comobje=del&dvid=<?php echo $rowRows['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></label><br />
<?php
}

?> 
        
        
 <?php }//end totas?>                        
                          
                        </div>
                        <div class="line"></div>
                        
                        
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
 
 
 <div id="DeviationOtherdiv"><?php if($rstudy['partaOther']){?><textarea name="partaOther" id="partaOther" cols="" rows="5" class="form-control  required"><?php echo $rstudy['partaOther'];?></textarea><?php }?></div>
 
 
              
                        </div>
                        <div class="line"></div>
                        
                        
                        

                         <div class="form-group row success">
                          <label class="form-control-label"  style="font-weight:bold;">B)	Protocol violation (May pose high risk to participants and protocol implementation)</label>
    
                          
                        </div>
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PVDateofoccurrence" id="PVDateofoccurrence" class="form-control" value="<?php echo $rstudy['PVDateofoccurrence'];?>">
                        </div>
                        <div class="line"></div>
                        
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">2.	Description of violation :</label>
                  
                          
                          <textarea name="PVDescriptionofdeviation" id="MyTextBox" cols="" rows="5" class="form-control"><?php echo $rstudy['PVDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                          
                          
                        </div>
             
             
             
                        <div class="line"></div>
                       
                        
                        
                <!-- <h3>Part B:</h3>-->
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
                        
     <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">3. Root cause of violation </label>

  <textarea name="Rootcauseofviolation_b" id="MyTextBox7" cols="" rows="5" class="form-control"><?php echo $rstudy['Rootcauseofviolation_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>


</div>

    <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">4. Corrective action  </label>
<textarea name="Correctiveaction_b" id="MyTextBox7" cols="" rows="5" class="form-control"><?php echo $rstudy['Correctiveaction_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>



</div>

    <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">5. Measures to mitigate violation  </label>


 <script>
function deleteRow2(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable2').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
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



	
  new_row.cells[2].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}
</script>
  <?php
  $bdiv=$_GET['bdiv'];
  if($_GET['comobjem']=='del'){
$qRDel2="delete from ".$prefix."saes_measures_mitigate_dev_b where owner_id='$sessionasrmApplctID' and renewal_id='$id' and id='$id'";
$mysqli->query($qRDel2);
}

$qRPersoneld2="select * from ".$prefix."saes_measures_mitigate_dev_b  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable2" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

            <th width="12%">&nbsp;</th>
            <th width="11%">&nbsp;</th>
        </tr>
        <tr>
            <td width="3%" style="display:none;">1</td>
  
              <td align="left">
              
<?php if(!$RPersoneld2->num_rows){?>
<input type="text" name="Measurestomitigateviolation_b[]" id="Measurestomitigateviolation_b" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
    
    
<?php if($RPersoneld2->num_rows){?>
<input type="text" name="Measurestomitigateviolation_b[]" id="Measurestomitigateviolation_b" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow2(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add More" onClick="insRow2()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
   </table>


<?php

if($RPersoneld2->num_rows){
while ($rowRows2 = $RPersoneld2->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows2['Measurestomitigatedeviation'];?> <a href="main.php?option=ChooseDeviationsManual&id=<?php echo $id;?>&desv=del&bdiv=<?php echo $rowRows2['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></label><br />
<?php
}

?> 
        
        
 <?php }//end totas?> 


</div>
<?php 
///End USer has chosen Both
  }?>

                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSubmitDeviations" type="submit"  class="btn btn-primary" value="Save Details"/>
                    
                    
                    <?php if($rstudy['PDDateofoccurrence'] || $rstudy['PVDateofoccurrence']){?>					
					<input name="doSaveFinish" type="button"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='<?php echo $base_url;?>main.php?option=FinalSubmitDeviations&id=<?php echo $id;?>'"/>
					
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