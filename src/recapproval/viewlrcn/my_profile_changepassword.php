               <?php
if($_POST['doPassword']=='Update' and $_POST['pwd']){

$allPass = preg_replace('/\s+/', '', $_POST['pwd']);
	$password=md5($mysqli->real_escape_string($allPass));
	$pwdNot=$mysqli->real_escape_string($allPass);

$sqlUserFx="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$QueryUserFx = $mysqli->query($sqlUserFx);
$recUserFx=$QueryUserFx->fetch_array();
$email=$recUserFx['email'];
$name=$recUserFx['name'];
	$musername=$recUserFx['username'];
$sqlA2="update ".$prefix."user set `password`='$password' where asrmApplctID='$asrmApplctID'";
$mysqli->query($sqlA2);

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");
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
//$mail->addCc('uncstuncstapps@gmail.com','Activation Link from UNCST');//
//$mail->addBcc('mawandammoses@gmail.com','Activation Link from UNCST');//

$mail->FromName = "UNCST"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Admin Account";
$body="
Dear $name !<br><br>
An account has been created for you. You will use these logins whenever to log into the system. Below are your login details;<br><br>
Username: $musername<br>
Password: $pwdNot<br>
<a href='".$base_url."/'>Click here to login</a><br><br>

Best Regards<br>
Uganda National Council for Science and Technology<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end




$message='<div class="success">Your profile has been updated<br><br></div>';

		
}?>


<?php
$ownerID=$_SESSION['asrmApplctID'];
$sqlstudy="SELECT * FROM ".$prefix."user where `asrmApplctID`='$ownerID'";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?>

<ul id="countrytabs" class="shadetabs">

<li><a href="./main.php?option=MyProfile">My Profile</a></li>

<li><a href="#" rel="#default" class="selected">Change Password</a></li>


<li><a href="./main.php?option=ProfilePicture">Profile Picture</a></li>



</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php

if(isset($message)){echo $message;}
?>

 <form id="regForm" method="post" action="" name="regForm" autocomplete="off" enctype="multipart/form-data">
    <div  class="logmain"> 
                  Required Fields marked (<span class="fontx">*</span>)
                  <hr>
      
      
      
       <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Password: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            
                            <input name="pwd" type="password" class="form-control required password" minlength="5" id="pwd" required>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Retype Password: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input name="pwd2"  id="pwd2" class="form-control required password" type="password" minlength="5" equalto="#pwd" required>
                          </div>
                        </div>
                        <div class="line"></div>
              
  
 
 
 
 
 
 
 
 
 
 </div><!--End-->
 
 
 
 
 
                          
                        
                        <div class="line"></div>


  
 <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doPassword" type="submit"  class="btn btn-primary" value="Update"/>

                          </div>
                        </div>

                  </form>    
                                     


<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>