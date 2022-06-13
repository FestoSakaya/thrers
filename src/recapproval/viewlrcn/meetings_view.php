

<button id="myBtn" class="search btn">Add New Meeting </button> 
 <?php

if($_POST['doMeeting']=='Save' and $_POST['year'] and $_POST['subject'] and $_POST['comment']){
	$mdate=$mysqli->real_escape_string($_POST['year'].'-'.$_POST['month'].'-'.$_POST['date']);
	$activ_code = $recAffiliated_id.rand(1000,9999);
	
	if($mdate>=$today){///meeting has to be after today
$_POST['meetingFor_protocol'];
///////////////////Discuss Protocols

if($_POST['protocol_id']){
for ($i=0; $i < count($_POST['protocol_id']); $i++ and $_POST['meetingFor_protocol']=='protocol') {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id=$mysqli->real_escape_string($_POST['protocol_id'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."submission where protocol_id='$protocol_id'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$public_title=$rStatus4['public_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
	
$sqlInvestigators_protocol="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and protocol_id='$protocol_id' and date>='$mdate' and meetingFor='protocol' order by id desc";
	$QueryInvestigators_protocol = $mysqli->query($sqlInvestigators_protocol);
	$totalInvestigators_protocol = $QueryInvestigators_protocol->num_rows;

	
	
if(!$totalInvestigators_protocol){
$sqlA2_protocol="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id','$public_title','$recAffiliated_id','protocol','$activ_code')";
$mysqli->query($sqlA2_protocol);
		}
		
		
}//end for loop
}

///////////////////Discuss AnnualRenewal
if($_POST['protocol_id_annual']){
for ($i=0; $i < count($_POST['protocol_id_annual']); $i++ and $_POST['meetingFor_annual_renewal']=='AnnualRenewal') {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$renewal_id_annual=$mysqli->real_escape_string($_POST['protocol_id_annual'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."renewals where id='$renewal_id_annual'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$mpublic_title=$rStatus4['public_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
$mprotocol_id=$rStatus4['protocol_id'];

$ammendType=$rStatus4['ammendType'];
	
$sqlInvestigators_AnnualRenewal="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and public_title='$mpublic_title' and date>='$mdate'  and meetingFor='AnnualRenewal' order by id desc";
	$QueryInvestigators_AnnualRenewal = $mysqli->query($sqlInvestigators_AnnualRenewal);
	$totalInvestigators_AnnualRenewal = $QueryInvestigators_AnnualRenewal->num_rows;
	
	
	
if(!$totalInvestigators_AnnualRenewal){
 $sqlA2_AnnualRenewal="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`,`ammendType`) 

values(now(),now(),'$mdate','$subject','$comment','$mprotocol_id','$mpublic_title','$recAffiliated_id','AnnualRenewal','$activ_code','$ammendType')";
$mysqli->query($sqlA2_AnnualRenewal);
		}
		
}//end for loop
}



///////////////////Discuss AnnualRenewal
if($_POST['protocol_id_ammendments']){
for ($i=0; $i < count($_POST['protocol_id_ammendments']); $i++ and $_POST['meetingFor_amendments']=='Amendments') {
$cfnreviewer= $cfn_reviewer;


	$ammendType=$rStatus4['ammendType'];
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id_ammendments=$mysqli->real_escape_string($_POST['protocol_id_ammendments'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."ammendments where id='$protocol_id_ammendments'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$mpublic_title=$rStatus4['protocol_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
$mprotocol_id=$rStatus4['protocol_id'];
$ammendType=$rStatus4['ammendType'];
	
$sqlInvestigators_Amendments="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and public_title='$mpublic_title' and date>='$mdate' and meetingFor='Amendments' order by id desc";
	$QueryInvestigators_Amendments = $mysqli->query($sqlInvestigators_Amendments);
	$totalInvestigators_Amendments = $QueryInvestigators_Amendments->num_rows;
	
	
	
if(!$totalInvestigators_Amendments){
$sqlA2_Amendments="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`,`ammendType`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id_ammendments','$mpublic_title','$recAffiliated_id','Amendments','$activ_code','$ammendType')";
$mysqli->query($sqlA2_Amendments);
		}
		
}//end for loop
}

///////////////////Discuss SAEs
if($_POST['protocol_id_saes']){
for ($i=0; $i < count($_POST['protocol_id_saes']); $i++ and $_POST['meetingFor_SAEs']=='SAEs') {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id_saes=$mysqli->real_escape_string($_POST['protocol_id_saes'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."submission where protocol_id='$protocol_id_saes'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$public_title=$rStatus4['public_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
	
$sqlInvestigators_saes="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and protocol_id='$protocol_id_saes' and date>='$mdate' and meetingFor='SAEs' order by id desc";
	$QueryInvestigators_saes = $mysqli->query($sqlInvestigators_saes);
	$totalInvestigators_saes = $QueryInvestigators_saes->num_rows;
	
	
	
if(!$totalInvestigators_saes){
$sqlA2_saes="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id_saes','$public_title','$recAffiliated_id','SAEs','$activ_code')";
$mysqli->query($sqlA2_saes);
		}
		
}//end for loop
}

///////////////////Discuss Deviations
if($_POST['protocol_id_deviations']){
for ($i=0; $i < count($_POST['protocol_id_deviations']); $i++ and $_POST['meetingFor_Deviations']=='Deviations') {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id_deviations=$mysqli->real_escape_string($_POST['protocol_id_deviations'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."submission where protocol_id='$protocol_id_deviations'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$public_title=$rStatus4['public_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
	
$sqlInvestigators_deviations="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and protocol_id='$protocol_id_deviations' and date>='$mdate' and meetingFor='Deviations' order by id desc";
	$QueryInvestigators_deviations = $mysqli->query($sqlInvestigators_deviations);
	$totalInvestigators_deviations = $QueryInvestigators_deviations->num_rows;
	
	
	
if(!$totalInvestigators_deviations){
$sqlA2_deviations="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id_deviations','$public_title','$recAffiliated_id','Deviations','$activ_code')";
$mysqli->query($sqlA2_deviations);
		}
		
}//end for loop
}

///////////////////Discuss Notifications
if($_POST['protocol_id_notifications']){
for ($i=0; $i < count($_POST['protocol_id_notifications']); $i++ and $_POST['meetingFor_Notifications']=='Notifications') {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id_notifications=$mysqli->real_escape_string($_POST['protocol_id_notifications'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."submission where protocol_id='$protocol_id_notifications'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$public_title=$rStatus4['public_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
	
$sqlInvestigators_notifications="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and protocol_id='$protocol_id_notifications' and date>='$mdate' and meetingFor='Notifications' order by id desc";
	$QueryInvestigators_notifications = $mysqli->query($sqlInvestigators_notifications);
	$totalInvestigators_notifications = $QueryInvestigators_notifications->num_rows;
	
	
	
if(!$totalInvestigators_notifications){
$sqlA2_notifications="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id_notifications','$public_title','$recAffiliated_id','Notifications','$activ_code')";
$mysqli->query($sqlA2_notifications);
		}
		
}//end for loop
}
///////////////////Discuss CloseOutReport

if($_POST['protocol_id_CloseOutReport']){
for ($i=0; $i < count($_POST['protocol_id_CloseOutReport']); $i++ and $_POST['meetingFor_CloseOutReport']=='CloseOutReport') {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id_CloseOutReport=$mysqli->real_escape_string($_POST['protocol_id_CloseOutReport'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."submission where protocol_id='$protocol_id_CloseOutReport'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$public_title=$rStatus4['public_title'];
$recAffiliated_id=$rStatus4['recAffiliated_id'];
	
$sqlInvestigators_CloseOutReport="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and protocol_id='$protocol_id_CloseOutReport' and date>='$mdate' and meetingFor='CloseOutReport' order by id desc";
	$QueryInvestigators_CloseOutReport = $mysqli->query($sqlInvestigators_CloseOutReport);
	$totalInvestigators_CloseOutReport = $QueryInvestigators_CloseOutReport->num_rows;
	
	
	
if(!$totalInvestigators_CloseOutReport){
$sqlA2_CloseOutReport="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingFor`,`meetingCode`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id_CloseOutReport','$public_title','$recAffiliated_id','CloseOutReport','$activ_code')";
$mysqli->query($sqlA2_CloseOutReport);
		}
		
}//end for loop
}





$message="<div class=success>SUCCESS! You have successfully added a meeting.</div>";
	}///end meeting has to be after today
	else{$message="<div class=error2>ERROR! You have set a meeting for a past date. Please correct and add again</div>";}
}?>
<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Meeting</strong></h3>
    </div>
    <div class="modal-body" style="height:320px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" autocomplete="off">
 <?php $startYear=date('Y');?>
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Meeting Date:</label>
<div class="col-sm-9">
 <select name="year" id="dyear" class="form-control" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulateMeeting(this.value)">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', $startYear);

$current_year = date('Y')+1;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select>
                         
   <div id="monthdivmn"></div>
    <?php  ?>                          
  <select name="date" id="ddate" class="form-control" tabindex="6" style=" width:80px; float:left;">
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
</div>
</div> 

 <div class="form-group row">

<label class="col-sm-3 form-control-label">Meeting For:</label>
<div class="col-sm-9">


<table width="98%" border="0" class="success">
  <tr>
    <td>Protocol</td>
    <td><input name="meetingFor_protocol" type="radio" value="No"  onChange="getProtocolsMeetings(this.value)" checked="checked"/> No</td>
    <td><input name="meetingFor_protocol" type="radio" value="protocol"  onChange="getProtocolsMeetings(this.value)"/> Yes</td>
  </tr>
  <tr>
    <td colspan="3"><div id="protocolmeetingdiv"></div></td>
  </tr>
  

  <tr>
    <td>Annual Renewal</td>
    <td><input name="meetingFor_annual_renewal" type="radio" value="No"  onChange="getAnnualMeetings(this.value)" checked="checked"/> No</td>
    <td><input name="meetingFor_annual_renewal" type="radio" value="AnnualRenewal"  onChange="getAnnualMeetings(this.value)"/> Yes</td>
  </tr>
  
   <tr>
    <td colspan="3"><div id="annualmeetingdiv"></div></td>
  </tr>
  
  
  <tr>
    <td>Amendments</td>
    <td><input name="meetingFor_amendments" type="radio" value="No"  onChange="getAmmendmentsMeetings(this.value)" checked="checked"/> No</td>
    <td><input name="meetingFor_amendments" type="radio" value="Amendments"  onChange="getAmmendmentsMeetings(this.value)"/> Yes</td>
  </tr>
  
   <tr>
    <td colspan="3"><div id="ammendmentsmeetingdiv"></div></td>
  </tr>
  
  <tr>
    <td>SAEs</td>
    <td><input name="meetingFor_SAEs" type="radio" value="No"  onChange="getSAEsMeetings(this.value)" checked="checked"/> No</td>
    <td><input name="meetingFor_SAEs" type="radio" value="SAEs"  onChange="getSAEsMeetings(this.value)"/> Yes</td>
  </tr>
  
   <tr>
    <td colspan="3"><div id="SAEsmeetingdiv"></div></td>
  </tr>
  
  <tr>
    <td>Deviations</td>
    <td><input name="meetingFor_Deviations" type="radio" value="No"  onChange="getDeviationsMeetings(this.value)" checked="checked"/>  No</td>
    <td><input name="meetingFor_Deviations" type="radio" value="Deviations"  onChange="getDeviationsMeetings(this.value)"/> Yes</td>
  </tr>
  
   <tr>
    <td colspan="3"><div id="Deviationsmeetingdiv"></div></td>
  </tr>
  

  <tr>
    <td>Notifications</td>
    <td><input name="meetingFor_Notifications" type="radio" value="No"  onChange="getNotificationsMeetings(this.value)" checked="checked"/>No</td>
    <td><input name="meetingFor_Notifications" type="radio" value="Notifications"  onChange="getNotificationsMeetings(this.value)"/> Yes</td>
  </tr>
  
   <tr>
    <td colspan="3"><div id="Notificationsmeetingdiv"></div></td>
  </tr>
  
  <tr>
    <td>Close Out Report </td>
    <td><input name="meetingFor_CloseOutReport" type="radio" value="No"  onChange="getCloseOutReportMeetings(this.value)" checked="checked"/> No</td>
    <td><input name="meetingFor_CloseOutReport" type="radio" value="CloseOutReport"  onChange="getCloseOutReportMeetings(this.value)"/> Yes</td>
  </tr>
  
   <tr>
    <td colspan="3"><div id="CloseOutReportmeetingdiv"></div></td>
  </tr>
  
 
  
</table>















</div>
</div>

 <div class="form-group row">

<label class="col-sm-3 form-control-label">Subject:</label>
<div class="col-sm-9">
<input type="text" name="subject" id="subject" class="form-control  required" value="">
</div>
</div>
  
 
                      
<div class="form-group row">
 
<label class="col-sm-3 form-control-label">Agenda:</label>
<div class="col-sm-9">
<textarea name="comment" id="comment" cols="" rows="5" class="form-control  required"></textarea>
</div>
</div>                
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doMeeting" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
<form action="" method="post" name="regForm" id="regForm" >    
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Search for a meeting subject:<br />
    <input type="text" name="search" class="form-control"></td>
    <td width="4%">&nbsp;</td>
   
   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>

 </form>   
                    <div class="card-body">
                    <?php if($message){echo $message;}?>
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>

                            <th>Date</th>
                            <th>Meeting Subject</th>
                            <th>Agenda</th>
                            <th>Submissions Assigned</th>
                            <th>Meeting Status</th>
                           
                          </tr>
                        </thead>
                        <tbody>
<script>
   function popitup(url) 
   {
    newwindow=window.open(url,'name','height=600,width=950,screenX=400,screenY=350');
    if (window.focus) {newwindow.focus()}
    return false;
   }
   </script> <?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];

if($category=='ConductedMeetings' and $id){

$sqlChceckMembersNew2="update ".$prefix."meeting set meetingStatus='conducted' where  meetingCode='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Meeting Status has been updated</div>';	
}

if($category=='DidNotConductMeetings' and $id){

$sqlChceckMembersNew2="update ".$prefix."meeting set meetingStatus='pending' where meetingCode='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Meeting Status has been updated</div>';
	
}
$countNo=0;
$category=$_POST['category'];
$page='main.php?';
$url='meetings';
$value='&id='.$id;
$search=$mysqli->real_escape_string($_POST['search']);
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."meeting where (subject like '%$search%' OR content like '%$search%') and recAffiliated_id='$recAffiliated_idm' group by meetingCode order by id desc");//and conceptm_status='new' 
}
if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."meeting where recAffiliated_id='$recAffiliated_idm' group by meetingCode order by id desc");//and conceptm_status='new'  date>='$today' and 
}

$row = $query -> fetch_array(MYSQLI_NUM);
$total_pages = $row[0];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 15;
//how many items to show per page
/*Extract Last Value from a link*/
$page = $_GET['page'];
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;								//if no page var is given, set start to 0
if($_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`date`,'%D/%m/%Y') AS datem FROM ".$prefix."meeting where (subject like '%$search%' OR content like '%$search%')  and recAffiliated_id='$recAffiliated_idm' group by meetingCode order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}
if(!$_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`date`,'%D/%m/%Y') AS datem FROM ".$prefix."meeting where recAffiliated_id='$recAffiliated_idm' group by meetingCode order by id desc LIMIT $start, $limitm";//and conceptm_status='new' date>='$today' and 
}
$result = $mysqli->query($sql);

/* Setup page vars for display. */
if ($page == 0) $page = 1;					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limitm);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/* 
Now we apply our rules and draw the pagination object. 
We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
if($lastpage > 1)
{	
$pagination .= "<div class=\"pagination\">";
//previous button
if ($page > 1) 
$pagination.= "<a href=\"$targetpage&page=$prev\">&laquo;previous</a>";
else
$pagination.= "<span class=\"disabled\">&laquo;previous</span>";	

//pages	
if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
{	
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
}
elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
{
//close to beginning; only hide later pages
if($page < 1 + ($adjacents * 2))		
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
$pagination.= "...";
$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
}
//in middle; hide some front and some back
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
$pagination.= "...";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
$pagination.= "...";
$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
}
//close to end; only hide early pages
else
{
$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
$pagination.= "...";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
}
}

//next button
if ($page < $counter - 1) 
$pagination.= "<a href=\"$targetpage&page=$next\">next&raquo;</a>";
else
$pagination.= "<span class=\"disabled\">next&raquo;</span>";
$pagination.= "</div>";		
} 
while($rProjects=$result->fetch_array()){
	
	$pprotocol_idm=$rProjects['protocol_id'];
	$meetingCode=$rProjects['meetingCode'];

$sqlRStatus2 = "select * FROM ".$prefix."submission where protocol_id='$pprotocol_idm'";
$resultStatus2 = $mysqli->query($sqlRStatus2);
$rStatus2=$resultStatus2->fetch_array();


	?>
                          <tr>
                            <td><a href="<?php echo $base_url;?>main.php?option=meetings" onClick="return popitup('meetings.php?id=<?php echo $rProjects['date'];?>')"><?php echo $rProjects['date'];?></a> </td>
                            <td><a href="<?php echo $base_url;?>main.php?option=meetings" onClick="return popitup('meetings.php?id=<?php echo $rProjects['date'];?>')"><?php echo $rProjects['subject'];?></a></td>
                            <td><?php echo nl2br($rProjects['content']);?></td>
                            <td>
                          <?php
$sqlRStatus6 = "select * FROM ".$prefix."meeting where meetingCode='$meetingCode' and recAffiliated_id='$recAffiliated_id' order by id desc";
$resultStatus6 = $mysqli->query($sqlRStatus6);
while($rStatus6=$resultStatus6->fetch_array()){ 
$countNo++; 
 $pprotocol_idm2=$rStatus6['protocol_id'];
 
 

$sqlRStatus3 = "select * FROM ".$prefix."submission where id='$pprotocol_idm2'";
$resultStatus3 = $mysqli->query($sqlRStatus3);
$rStatus3=$resultStatus3->fetch_array();

if($rStatus6['meetingFor']=='protocol'){?><?php $mpublic_title=$rStatus3['public_title'];}


if($rStatus6['ammendType']=='manual' and $rStatus6['meetingFor']=='AnnualRenewal'){?><?php $mpublic_title=$rStatus6['public_title'];}
if($rStatus6['ammendType']=='online' and $rStatus6['meetingFor']=='AnnualRenewal'){?><?php $mpublic_title=$rStatus3['public_title'];}
   
if($rStatus6['ammendType']=='manual' and $rStatus6['meetingFor']=='Amendments'){?><?php $mpublic_title=$rStatus6['public_title'];}
if($rStatus6['ammendType']=='online' and $rStatus6['meetingFor']=='Amendments'){?><?php $mpublic_title=$rStatus3['public_title'];}  

if($rStatus6['ammendType']=='manual' and $rStatus6['meetingFor']=='SAEs'){?><?php $mpublic_title=$rStatus6['public_title'];}
if($rStatus6['ammendType']=='online' and $rStatus6['meetingFor']=='SAEs'){?><?php $mpublic_title=$rStatus3['public_title'];} 

if($rStatus6['ammendType']=='manual' and $rStatus6['meetingFor']=='Deviations'){?><?php $mpublic_title=$rStatus6['public_title'];}
if($rStatus6['ammendType']=='online' and $rStatus6['meetingFor']=='Deviations'){?><?php $mpublic_title=$rStatus3['public_title'];}

if($rStatus6['ammendType']=='manual' and $rStatus6['meetingFor']=='Notifications'){?><?php $mpublic_title=$rStatus6['public_title'];}
if($rStatus6['ammendType']=='online' and $rStatus6['meetingFor']=='Notifications'){?><?php $mpublic_title=$rStatus3['public_title'];}

if($rStatus6['ammendType']=='manual' and $rStatus6['meetingFor']=='CloseOutReport'){?><?php $mpublic_title=$rStatus6['public_title'];}
if($rStatus6['ammendType']=='online' and $rStatus6['meetingFor']=='CloseOutReport'){?><?php $mpublic_title=$rStatus3['public_title'];}  
 
  echo '<b>'.$countNo.'.</b> '.$mpublic_title.'<br><br>'; 
  
}$countNo="";
?>                            
                       
                            </td>
                            <td>
                            
                            <?php if($rProjects['meetingStatus']=='pending' and $session_privillage=='administrator' || $session_privillage=='superadmin' || $session_privillage=='recadmin'  || $session_privillage=='rechairperson'){?>
<span class="m-status m-status--wide cfx-watch"><a href="./main.php?option=ConductedMeetings&id=<?php echo $rProjects['meetingCode'];?>" onClick="return confirm('Are you sure you want to proceed?');">         <span class="cfx-watch-label">NOT CONDUCTED</span>
        <span class="cfx-watch-switch"></span></a> </span><br /><?php }?>
                                                    
<?php if($rProjects['meetingStatus']=='conducted' and $session_privillage=='administrator' || $session_privillage=='superadmin' || $session_privillage=='recadmin'  || $session_privillage=='rechairperson'){?>
<span class="m-status m-status--wide cfx-watch active"><a href="./main.php?option=DidNotConductMeetings&id=<?php echo $rProjects['meetingCode'];?>" onClick="return confirm('Are you sure you want to proceed?');">        <span class="cfx-watch-label">CONDUCTED&nbsp;</span>
        <span class="cfx-watch-switch"></span></a></span><?php }?>
        
        
<?php // and $rProjects['date']>=$today
 if($session_privillage=='administrator' || $session_privillage=='superadmin' || $session_privillage=='recadmin'  || $session_privillage=='rechairperson'){?><br />
  <input id="go" type="button" value="Re-schedule Meeting" onclick="window.open('<?php echo $base_url;?>reschedulemeeting.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4">
                            
    <br />
   <?php /*?><?php */?> <input id="go" type="button" value="Update This Meeting" onclick="window.open('<?php echo $base_url;?>updatemeeting.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorhona">
   
   
   
   <?php }?>
    
    
    
 <?php if($rProjects['meetingStatus']=='pending'){?> <!--<p id="demo"></p> --><?php }?>
  <?php $rProjects['date'];

 
$newMonth = date("M", strtotime($rProjects['date']));  

 
 $newDate = date("n", strtotime($rProjects['date']));  
	
 $newYear = date("Y", strtotime($rProjects['date']));  

  ?>
 <?php /*?>  <script>
// Set the date we're counting down to
var countDownDate = new Date("<?php  echo $newMonth;?> <?php  echo $newDate;?>, <?php  echo $newYear;?> 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "days " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script> <?php */?>
    
    <!-- <div style="padding:20px; background:#09F; color:#ffffff;">
          
          <div id="quiz-time-left"></div>
          
          </div>-->
    
    
                            
                          
                          </td>

                         
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
</div>


 
	  <div class="nav_purgination">
<?php echo $pagination;?>
<div class="clear"></div>

</div><!--end purgination section-->
