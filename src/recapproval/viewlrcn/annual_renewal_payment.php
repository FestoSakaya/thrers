<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
$sqlstudy="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];



if($_POST['doFilesUpload']=='Save' and $_FILES['attachethicalapproval']['name'] and $id){
	function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }


	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$FuturePlans=$mysqli->real_escape_string($_POST['FuturePlans']);
	$annual_id=$mysqli->real_escape_string($_POST['annual_id']);
	$type_of_payment=$mysqli->real_escape_string($_POST['type_of_payment']);
	
	
	$mdate=$mysqli->real_escape_string($_POST['date']);
	$month=$mysqli->real_escape_string($_POST['month']);
	$year=$mysqli->real_escape_string($_POST['year']);
	$DateofProposal=$mysqli->real_escape_string($year.'-'.$month.'-'.$mdate);
	$upload_type_id=$mysqli->real_escape_string($_POST['upload_type_id']);
	$othername=$mysqli->real_escape_string($_POST['othername']);
	
	$extensionw = getExtension(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));


if($_FILES['attachethicalapproval']['name']){
$attachethicalapproval = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$attachethicalapproval2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw1);

}

$sqlstudyExist="SELECT * FROM ".$prefix."renewals_attachments where `renewal_id`='$id' and owner_id='$sessionasrmApplctID' and filename='$upload_type_id' and attachment_file='$attachethicalapproval2' order by id desc";// and filename='$attachethicalapproval2'
$QuerystudyExist = $mysqli->query($sqlstudyExist);
$totalstudyExist = $QuerystudyExist->num_rows;
if(!$totalstudyExist){
$sqlA2="insert into ".$prefix."renewals_attachments (`renewal_id`,`recAffiliated_id`,`owner_id`,`filename`,`attachment_file`,`attachment_date`,`othername`,`created`) 

values('$id','$submission_id','$sessionasrmApplctID','$upload_type_id','$attachethicalapproval2','$DateofProposal','$othername','$today')";
$mysqli->query($sqlA2);

//$message='<div class="success">Dear '.$session_fullname.', details have been submitted, click save to continue</div>';
logaction("$session_fullname updated protocol, Bibliography Information");
}

$attachpayment = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$attachpayment2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw1);

if($_FILES['attachethicalapproval']['name'] and $upload_type_id=='Payment'){
$sqlA2Protocol="update ".$prefix."renewals  set `paymentProof`='$attachpayment2',`type_of_payment`='$type_of_payment' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and id='$id'";
$mysqli->query($sqlA2Protocol);

//Insert into Submission Stages
$wm="select * from ".$prefix."annual_stages where  owner_id='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

if($totalStages){
$sqlASubmissionStages="update ".$prefix."annual_stages  set `payment_proof`='1' where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages);
}



$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname added created new protocol");

}//end payment proof has been added


}//end post
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."annual_stages where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();

if($rstudy['ammendType']=='online'){$link="AnnualRenual";}
if($rstudy['ammendType']=='manual'){$link="AnnualRenualManual";}

?><ul id="countrytabs" class="shadetabs">

<?php if($totalstudy>=1){?><li><a href="./main.php?option=<?php echo $link;?>&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualFour&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Future Plans/Activities</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Future Plans/Activities</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li>






</ul>
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
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
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
    inp3.value = '';*/
	
    x.appendChild( new_row );
}
</script>
<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php


$sqlstudypp="SELECT * FROM ".$prefix."renewals_summary where `owner_id`='$sessionasrmApplctID' and annual_id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();

$sqlstudyPyment="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and is_sent='0' and id='$id' order by id desc limit 0,1";
$QuerystudyPyment = $mysqli->query($sqlstudyPyment);
$rstudyPyment = $QuerystudyPyment->fetch_array();

if(isset($message)){echo $message;}
?>


<div class="form-group row" style="padding-top:30px;">
 
 
 
 <h3>Attachments:</h3>


 <table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                            <th>Attachment</th>
                            <th>File name</th>
            
                            <th>Date</th>
                         <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
	$sid=$mysqli->real_escape_string($_GET['sid']);					
	if($category=='AnnualRenewalPaymentDel' and $id and $sid){
	$sqlA2Protocol2="delete from ".$prefix."renewals_attachments where owner_id='$asrmApplctID' and renewal_id='$id' and id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	}
						
						
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`attachment_date`,'%d/%m/%Y') AS attachment_date,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."renewals_attachments where  	owner_id='$asrmApplctID' and renewal_id='$id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	
$submittedBy=$rInvestigator['user_id'];
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td>
                            <?php if($today<=$rInvestigator['created']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            
                            </td>
                            <td><?php echo $rInvestigator['filename'];?></td>
                         
                            <td><?php echo $rInvestigator['attachment_date'];?></td>
<td><a href="./main.php?option=AnnualRenewalPaymentDel&id=<?php echo $rInvestigator['renewal_id'];?>&sid=<?php echo $rInvestigator['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                          </tr>
   <?php }///////////end function
?>
<?php
//if no page var is given, set start to 0
$sqlPrevious = "select *,DATE_FORMAT(`created`,'%d/%m/%Y') AS created FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id2' order by id desc LIMIT 0,150";//and conceptm_status='new' 
$resultPrevious = $mysqli->query($sqlPrevious);
while($rInvestigatorPrevious=$resultPrevious->fetch_array()){
$upload_type_id=$rInvestigatorPrevious['upload_type_id'];
$submittedBy=$rInvestigatorPrevious['user_id'];

$filem = "select * FROM ".$prefix."upload_type where id='$upload_type_id'";//and conceptm_status='new' 
$resultfile = $mysqli->query($filem);
$rfile=$resultfile->fetch_array();
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td> <?php if($today<=$rInvestigatorPrevious['created']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigatorPrevious['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigatorPrevious['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            
                            </td>
                            <td><?php if($rInvestigatorPrevious['othername']){echo $rInvestigatorPrevious['othername'];}else{echo $rfile['name'];}?></td>
                         
                            <td><?php echo $rInvestigatorPrevious['created'];?></td>
<td></td>
                          </tr>
   <?php }///////////end function ?> 
   

   
                   
                        </tbody>
                      </table>
                     

    
    
    
    
    
    


   <button id="myBtn">New Attachment </button>      
  <div style="clear:both;"></div>    
   <!-- Trigger/Open The Modal -->  

    
 <?php if($rstudypp['FuturePlans'] and $rstudy['paymentProof']){?>					
					<input name="doSaveFinish" type="button"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; margin-left:20px; "  onClick="window.location.href='<?php echo $base_url;?>main.php?option=FinalRenewalSubmit&id=<?php echo $id;?>'"/>
					
					<?php }?>                     

 
   <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="<?php echo $base_url;?>main.php?option=AnnualRenewalPayment&id=<?php echo $id;?>" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Type: <span class="error">*</span></label>
<div class="col-sm-8">
<select name="upload_type_id" id="upload_type_id" class="form-control  required" required onChange="getAnualdocument(this.value)">
<option value="">Please Select</option>

<option value="Payment">Payment</option>
<option value="other">Other</option>
</select>
</div>
</div> 

 <div class="form-group row">
 <div id="getAnnualRenewaldiv"></div>
 </div>
 

 


  <div class="form-group row">
 
<label class="col-sm-3 form-control-label">Date:</label>
<div class="col-sm-8">
<table width="100%" border="0">
  <tr>
    <td>
  
  <select name="year" id="dyear" class="form-control" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulate(this.value)"  required>
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 2000);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select>
    
    </td>
    <td><div id="monthdiv"></div></td>
    <td> 
    
    <select name="date" id="ddate" class="form-control" tabindex="6" style=" width:80px; float:left;"  required>
    <option value="">Date</option>
   <option value="01">&nbsp;01</option>
   <option value="02">&nbsp;02</option>
   <option value="03">&nbsp;03</option>
   <option value="04">&nbsp;04</option>
   <option value="05">&nbsp;05</option>
   <option value="06">&nbsp;06</option>
   <option value="07">&nbsp;07</option>
   <option value="08">&nbsp;08</option>
   <option value="09">&nbsp;09</option>
   <option value="10">&nbsp;10</option>
   <option value="11">&nbsp;11</option>
   <option value="12">&nbsp;12</option>
  <option value="13">&nbsp;13</option>
<option value="14">&nbsp;14</option>
<option value="15">&nbsp;15</option>
<option value="16">&nbsp;16</option>
<option value="17">&nbsp;17</option>
<option value="18">&nbsp;18</option>
<option value="19">&nbsp;19</option>
<option value="20">&nbsp;20</option>
<option value="21">&nbsp;21</option>
<option value="22">&nbsp;22</option>
<option value="23">&nbsp;23</option>
<option value="24">&nbsp;24</option>
<option value="25">&nbsp;25</option>
<option value="26">&nbsp;26</option>
<option value="27">&nbsp;27</option>
<option value="28">&nbsp;28</option>
<option value="29">&nbsp;29</option>
<option value="30">&nbsp;30</option>
<option value="31">&nbsp;31</option>
   
  </select>
  </td>
  </tr>
</table>






</div>
</div>        


 <div class="form-group row">
 
<label class="col-sm-3 form-control-label">File  (PDF) <span class="error">*</span>:</label>
<div class="col-sm-8">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required" required/>

<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
</div>
</div>
                        
  




 

            
                  
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doFilesUpload" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>