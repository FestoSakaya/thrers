<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Ammendments View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."ammendments where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$code=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$renewal_id=$rstudym['id'];
$recAffiliated_id=$rstudym['recAffiliated_id'];
$ammendType=$rstudym['ammendType'];
if($rstudym['ammendType']=='online'){
$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];
}

if($rstudym['ammendType']=='manual'){
$public_title=$rstudym['protocol_title'];	
}




		if($_POST['doSaveCommentsDraft']=='Save Comments' and $asrmApplctID and $_POST['status']=='Approved' and $id){

	$AssessorComments=$_POST['AssessorComments'];
	$status=$_POST['status'];
	$newStatus=$_POST['status'];
	$amendment_id=$_POST['amendment_id'];
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	///Chck if there was no update
$qcommentDrafts1="select * from ".$prefix."completeness_check_comments_amendment where amendment_id='$amendment_id' and reviewer_id='$asrmApplctID'";
$rcommentDrafts1=$mysqli->query($qcommentDrafts1);//assessorComment
if($rcommentDrafts1->num_rows){
	/////////////////////////
$Insert_send="update ".$prefix."completeness_check_comments_amendment set `chcomments`='$AssessorComments',`status`='$status' where amendment_id='$amendment_id' and reviewer_id='$asrmApplctID'";
$mysqli->query($Insert_send);

}
if(!$rcommentDrafts1->num_rows){
/////////////////////////
$Insert_send="insert into ".$prefix."completeness_check_comments_amendment (`owner_id`,`protocol_id`,`reviewer_id`,`chcomments`,`chdate`,`status`,`amendment_id`) values ('$owner_id','$protocol_idwe','$asrmApplctID','$AssessorComments',now(),'$status','$amendment_id')";
$mysqli->query($Insert_send);

/////Send Email

}
$sqlupdateSm="update ".$prefix."ammendments set assignedto='Not Assigned',is_sent='1',status='Scheduled for Review', CompletenessCheck='Approved' where id='$amendment_id'";
$mysqli->query($sqlupdateSm);

echo $message="<p class='success'>Completeness Check for , '<b>$public_title</b> has been marked as <b>$status</b>.'</p>";
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=MyAmmendmentsREC">';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

}////////////////////////////End Approval




if($_POST['status']=='Rejected' and $_POST['AssessorComments'] and $_POST['public_title'] and $_POST['recAffiliated_id'] and $id and $_POST['ammendType']){
	$AssessorComments=$_POST['AssessorComments'];
	$status=$_POST['status'];
	$newStatus=$_POST['status'];
	$amendment_id=$_POST['amendment_id'];
	$public_title=$mysqli->real_escape_string($_POST['public_title']);	
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$code=$mysqli->real_escape_string($_POST['code']);
	
$qcommentDrafts1="select * from ".$prefix."completeness_check_comments_amendment where amendment_id='$amendment_id' and reviewer_id='$asrmApplctID'";
$rcommentDrafts1=$mysqli->query($qcommentDrafts1);//assessorComment
if($rcommentDrafts1->num_rows){
	/////////////////////////
$Insert_send="update ".$prefix."completeness_check_comments_amendment set `chcomments`='$AssessorComments',`status`='$status' where amendment_id='$amendment_id' and reviewer_id='$asrmApplctID'";
$mysqli->query($Insert_send);

}
if(!$rcommentDrafts1->num_rows){
/////////////////////////
$Insert_send="insert into ".$prefix."completeness_check_comments_amendment (`owner_id`,`protocol_id`,`reviewer_id`,`chcomments`,`chdate`,`status`,`amendment_id`) values ('$owner_id','$protocol_idwe','$asrmApplctID','$AssessorComments',now(),'$status','$amendment_id')";
$mysqli->query($Insert_send);

/////Send Email

}
	/////Update submissions Table
	
	
$sqlupdateSm="update ".$prefix."ammendments set assignedto='Not Assigned',is_sent='0',status='$newStatus', CompletenessCheck='Rejected' where id='$amendment_id'";
$mysqli->query($sqlupdateSm);

$sqlupdateSm="update ".$prefix."ammendments_documents set is_sent='0' where amendment_id='$id'";
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
require_once("viewlrcn/mail_template_completeness_check_amendment.php");

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
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=MyAmmendmentsREC">';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
}//end template for rejection

	



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
                        <h3 class="h4">Protocal Title</h3><small><?php echo $public_title;?></small>
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
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$owner_id' and amendment_id='$id' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);//assignedto='Not Assigned' and
$totalstudy = $Querystudy->num_rows;

?> 
<button class="accordion">Ammendments, click to review</button>
  <div class="panel">
 
<table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Protocol</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
				$protocol_id=$rstudy['protocol_id'];
$wmSubmissions="select * from ".$prefix."submission where  `id`='$protocol_id'";
$cmdwbSubmissions = $mysqli->query($wmSubmissions);
$rSubmissions= $cmdwbSubmissions->fetch_array();
;
			
				?>
                          <tr>
                          <td><?php echo $public_title;?>
                          </td>
                          
                            <td><?php if($rstudy['fileAttachment']){?><a href="./files/uploads/<?php echo $rstudy['fileAttachment'];?>" target="_blank" style="color:#06F;"><?php echo $rstudy['atype'];?></a><?php }?></td>
                            
                            <td><?php echo $rstudy['aLanguage'];?></td>
                            <td><?php echo $rstudy['aVersion'];?></td>
                            <td><?php echo $rstudy['aDate'];?></td>
                            </tr>
               
               <?php }?>
                        </tbody>
                      </table>
  </div>
  
  
<button class="accordion">List of Changes, click to review</button>
  <div class="panel">

 
 
 
 
 <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Changes to Consent Form:  Are changes required?:</b> <?php echo $rstudym['ChangestoConsentForm'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewconsentform'];?>" target="_blank"><?php echo $rstudym['Attachnewconsentform'];?></a>
</label>
 </div>
 
 
  <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to data collection tool: Are changes required?: <?php echo $rstudym['ChangestodataCollectionTool'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewtool'];?>" target="_blank"><?php echo $rstudym['Attachnewtool'];?></a>
</label>
 </div>
 
 
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Changes to data collection tool: Are changes required?: </b><?php echo $rstudym['ChangestodataCollectionTool'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewtool'];?>" target="_blank"><?php echo $rstudym['Attachnewtool'];?></a>
</label>
 </div>
 
 
 
    <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to protocol: Are changes required?: <?php echo $rstudym['ChangestoProtocol'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewprotocol'];?>" target="_blank"><?php echo $rstudym['Attachnewprotocol'];?></a>
</label>
 </div>
 
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Are they changes to study districts? Please highlight districts:</b> <br /><?php echo $rstudym['changestostudyDistricts'];?>

</label>
 </div>
 
 <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Description of proposed changes:</b> <br /><?php echo $rstudym['listchanges'];?>

</label>
 </div>
 
 
 </div>   
  
  
 
    
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

<input name="amendment_id" type="hidden" value="<?php echo $renewal_id;?>" />
<input name="public_title" type="hidden" value="<?php echo $public_title;?>" />
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>" />

<input name="ammendType" type="hidden" value="<?php echo $ammendType;?>" />
<input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>" />
<input name="code" type="hidden" value="<?php echo $code;?>" />

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