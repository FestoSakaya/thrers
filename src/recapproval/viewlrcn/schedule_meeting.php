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


if($_POST['doAssignReviewes']=='Click to Schedule Meeting'){
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
	$meeting_id=$mysqli->real_escape_string($_POST['meetind_id']);
	$meetingdate=$mysqli->real_escape_string($_POST['meetingdate']);
	$meetingcontent=$mysqli->real_escape_string($_POST['meetingcontent']);
//Get meeting details
$sqlRMeeting = "select * FROM ".$prefix."meeting where id='$meeting_id'";//and conceptm_status='new' 
$resultMeeting = $mysqli->query($sqlRMeeting);
$rMeeting=$resultMeeting->fetch_array();
$meetingsubject=$rMeeting['subject'];
$content=$rMeeting['content'];
$public_title=$rMeeting['public_title'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];

	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$queryConceptLogs="select * from ".$prefix."meeting_invitees where meeting_id='$meeting_id',protocol_id='$protocol_idmm' and user_invited='$cfnreviewer'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;

if(!$rTotalConceptLogs){
$sqlA2rr="insert into ".$prefix."meeting_invitees (`meeting_id`,`protocol_id`,`owner_id`,`user_invited`,`created`,`meetingstatus`) 

values('$meeting_id','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'Pending')";
//$mysqli->query($sqlA2rr); 

$update="update ".$prefix."submission set meeting_status='Meeting Scheduled' where id='$id' and protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user'";
//$mysqli->query($update);
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
$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->addBcc($recemail,"$recOriginalName - Admin");//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email, $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($usrm_email, $assignedtoName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$recOriginalName  - Review Meeting";
$body="Dear $assignedtoName !<br><br>
<b>RE: $recOriginalName - Review Meeting</b><br>

You are invited for a <b>Review meeting</b> on <b>$meetingdate</b>.<br>
$meetingcontent<br>
Thank you,<br>

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
$message='<p class="success">Thank you, meeting has been scheduled and notifications sent.</p>';
	
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
                 
                  </div>
                </div>
              </div>
              
                                
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
<?php /*?><h4>Select Meeting below or go to Committee menu on left and add new meeting</h4>


<select name="meetind_id" id="meetind_id" class="form-control  required">
     <option value="">------</option>
  <?php
$sqlRStatus = "select * FROM ".$prefix."meeting where date>='$today' and protocol_id='$protocol_idwe' order by id desc";//and conceptm_status='new' 
$resultStatus = $mysqli->query($sqlRStatus);
while($rStatus=$resultStatus->fetch_array()){
?>
<option value="<?php echo $rStatus['id'];?>" style="color:#000000; font-weight:bold;"><?php echo $rStatus['subject'];?> - <?php echo $rStatus['public_title'];?></option>
<?php }?>
    
    </select><?php */?>

<h3>Review Meeting</h3>
<?php echo $message;?>


 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Meeting Date:</label>
<div class="col-sm-10">
<input type="date" name="meetingdate" id="meetingdate" class="form-control  required" value="" required>
</div>
</div>
        
      <div class="form-group row">
                          <label class="col-sm-2 form-control-label">About the meeting:</label>
                          <textarea name="meetingcontent" id="meetingcontent" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>     
        
<h4>Select Members to the meeting</h4>
<?php
$sqlReviewer="SELECT * FROM ".$prefix."user  where privillage='recreviewer' and recAffiliated_id='$recAffiliated_id'";
$QueryReviewer=$mysqli->query($sqlReviewer);
while($sqReviewer = $QueryReviewer->fetch_array()){
?>
<div style="width:100%; padding-bottom:8px;"><input name="reviewer[]" type="checkbox" value="<?php echo $sqReviewer['asrmApplctID'];?>"  class="required"/>&nbsp;<?php echo $sqReviewer['name'];?></div>

<?php }?>

<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Click to Schedule Meeting"/>
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