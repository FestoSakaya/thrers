<?php 
if($session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson' || $session_privillage=='recitadmin'){

	
	?>


<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr class="success">
    <td width="30%">Dates From:<br />
    <input type="date" class="form-control" name="datesfrom" value="<?php echo $_POST['datesfrom'];?>"></td>
    
    <td width="30%">To:<br />
    <input type="date" class="form-control" name="datesto" value="<?php echo $_POST['datesto'];?>"></td>
    
    
    <td colspan="2" width="30%">Category:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="category" data-live-search="true" tabindex="-98" style="width:90%;">
<option value="">Please Select</option>
<?php
$sqlClinicalcv4 = "select * FROM ".$prefix."categories order by rstug_categoryName asc";//and conceptm_status='new' 
$resultClinicalcv4 = $mysqli->query($sqlClinicalcv4);
while($rClinicalcv4=$resultClinicalcv4->fetch_array()){
?>
<option value="<?php echo $rClinicalcv4['rstug_categoryID'];?>" <?php if($rClinicalcv4['rstug_categoryID']==$_POST['category']){?>selected="selected"<?php }?>><?php echo $rClinicalcv4['rstug_categoryName'];?></option>
<?php }?>
</select></td>


  </tr>
  
  
  <tr class="success">

     <td width="30%">
Payment Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="paymentstatus" data-live-search="true" tabindex="-98" style="width:80%;">

<option value="" selected="">All</option>
 <option value="Paid" <?php if($_POST['paymentstatus']=='Paid'){?>selected="selected"<?php }?>>Paid</option>
<option value="Payment Waiver" <?php if($_POST['paymentstatus']=='Payment Waiver'){?>selected="selected"<?php }?>>Payment Waiver Review</option>
<option value="Review Pending Payment" <?php if($_POST['paymentstatus']=='Review Pending Payment'){?>selected="selected"<?php }?>>Review Pending Payment</option>

<option value="Not Paid" <?php if($_POST['paymentstatus']=='Not Paid'){?>selected="selected"<?php }?>>Not Paid</option>


          </select>

                                
   </td>
    <td width="30%">

Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
 <option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending Final Submission" <?php if($_POST['status']=='Pending Final Submission'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>

    <td width="30%">

                                
   </td>
   
   <td width="9%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>

<?php
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
$datesfrom=$_POST['datesfrom'];
$datesto=$_POST['datesto'];
$category=$_POST['category'];
$paymentstatus=$_POST['paymentstatus'];
$recID=$_POST['recID'];
?>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols</h3>
</div>
                    <div class="card-body">
                    

<?php if($status){?><div class="number allprotocols">        
<a href="exportrec.php?action=?status=<?php echo $status;?>&category=<?php echo $category;?>">EXPORT RESULTS</a>

</div><?php }?>

<?php if($datesfrom){?><div class="number allprotocols">        
<a href="exportrec.php?action=?datesfrom=<?php echo $datesfrom;?>&datesto=<?php echo $datesto;?>">EXPORT RESULTS</a>

</div><?php }?>


         
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>RefNo</th>
                            
                            <th>Protocol Title</th>
                            <th>Type</th>
                            <th>REC</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
$category=$_POST['category'];
$page='./main.php?option=';
$url='Reports';
$value='';


//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;

if(!$_POST['doSearch']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 
}

if($_POST['doSearch'] and $category and !$status){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto' and clinical_trial_type='$category') order by id desc");//and conceptm_status='new' 
}

if($_POST['doSearch'] and $status and !$category){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto' and status='$status') order by id desc");//and conceptm_status='new' 
}

if($_POST['doSearch'] and $status and $category){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto' and status='$status' and clinical_trial_type='$category') order by id desc");//and conceptm_status='new' 
}
if($_POST['doSearch'] and $datesfrom and $datesto){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto') order by id desc");//and conceptm_status='new' 
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
$start = 0;

if($_POST['doSearch'] and $category and !$status){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto' and clinical_trial_type='$category') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//

if($_POST['doSearch'] and $status and !$category){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto' and status='$status') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//

if($_POST['doSearch'] and $status and $category){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto' and status='$status' and clinical_trial_type='$category') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//

/*if($_POST['doSearch']){							//if no page var is given, set start to 0
echo $sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto') OR (status='$status' OR clinical_trial_type='$category' OR paymentStatus='$paymentstatus') and code>=1 order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//*/

if($_POST['doSearch'] and $datesfrom and $datesto){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//





if(!$_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$main_submission_id'  and meetingFor='protocol' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();
$newcode=$sqprotocol['code'];
$shtname=$sqUserdd['name'];

if(!$rProjects['code']){
$sqlprotocol = "update ".$prefix."submission set code='$newcode',shtname='$shtname' where id='$main_submission_id'";
//$mysqli->query($sqlprotocol);	
}
////Get REC
$recAffiliated_id=$rProjects['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$rProjects['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();

$sqlpReviewr = "select * from ".$prefix."submission_review_sr where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultReviewr = $mysqli->query($sqlpReviewr);
$sqprotocolReviewr = $resultReviewr->fetch_array();

$sqlpRevisions = "select * from ".$prefix."submission_archive where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultRevisions = $mysqli->query($sqlpRevisions);
$TotalRevisions = $resultRevisions->num_rows;
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small><br />
                            
                            
<?php if($TotalRevisions){?> <a href="<?php echo $base_url;?>main.php?option=RECRevisions&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Revisions [<?php echo $TotalRevisions;?>]</span></a>   <?php }?>                
                            </td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td>
							
<?php if($rProjects['meeting_status']=='Meeting Scheduled' || $rProjects['meeting_status']=='Pending'){?><?php echo $rProjects['assignedto'];}else{?><?php //echo $rProjects['status'];?>
                            
<?php if($rProjects['status']=='Approved'){echo "<b style='color:#796AEE;'>Approved</b>";}else{echo '<b style="color:#796AEE;">'.$rProjects['status'].'</b>';}  }?>
                          <?php /*?><?php if($rProjects['assignedto']){?> 
                        
                           <button id="myBtn">View Reviewers </button><?php }?><?php */?>
                           
                           <hr />
                           <?php if($rProjects['recruitment_status_id']=='1' and $rProjects['status']=='Approved'){?>
<input id="go" type="button" value="STUDY HALTED" onclick="window.open('<?php echo $base_url;?>haltstudies.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm3" >
      
        <?php }?>
                                                    
<?php if($rProjects['recruitment_status_id']=='0' and $rProjects['status']=='Approved'){?>

<input id="go" type="button" value="STUDY ONGOING" onclick="window.open('<?php echo $base_url;?>haltstudies.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm4" >

<?php }?>
                           
                           
                            </td>
                            <td>
  
  <a href="./main.php?option=viewsubmissionrec&id=<?php echo $rProjects['id'];?>"><span class="label label-sec">View Submission</span></a>
<div style="margin-bottom:6px;"></div>
 <a href="./main.php?option=viewcomments&id=<?php echo $rProjects['id'];?>"><span class="label label-sec">View Comments</span></a>                        
   <div style="margin-bottom:6px;"></div>                         
<?php 
if($rProjects['assignedto']=='Not Assigned' and $rProjects['status']!='Draft' and $rProjects['paymentProof'] and $rProjects['paymentStatus']=='Paid' || $rProjects['paymentStatus']=='Review Pending Payment' || $rProjects['paymentStatus']=='Payment Waiver' and $rProjects['CompletenessCheck']=='Approved'){?><a href="./main.php?option=AssignReviewers&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Assign Reviewers</span></a><div style="margin-bottom:6px;"></div><?php }?>



<?php if($rProjects['paymentProof'] and $rProjects['paymentStatus']=='Not Paid'){?><a href="./main.php?option=ConfirmPayment&id=<?php echo $rProjects['id'];?>"><span class="label label-secwarning">Update Payment Status</span></a><div style="margin-bottom:6px;"></div><?php }?>

 <?php if($rProjects['assignedto']=='Not Assigned' and $rProjects['status']!='Draft' and $rProjects['paymentProof'] and $rProjects['paymentStatus']=='Paid' || $rProjects['paymentStatus']=='Review Pending Payment' || $rProjects['paymentStatus']=='Payment Waiver' and $rProjects['CompletenessCheck']!='Approved'){?><a href="./main.php?option=CompletenessCheck&id=<?php echo $rProjects['id'];?>"><span class="label label-secwarning">Completeness check</span></a><div style="margin-bottom:6px;"></div><?php }?> 
  
    <?php 
	//Final decission should not be made unless the meeting has taken place (Except for Expedited or Fast Track, - Expedited do not go through meetings) || Expedited Review, Fast Track... $sqprotocolReviewr['recstatus']!='Pending' and $rProjects['status']!='Approved' and (
	if($sqUserMeeting['meetingStatus']=='conducted' || $rProjects['type_of_review']=='Expedited Review' || $rProjects['type_of_review']=='Fast Track' and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Approved'){?>
  <a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }?>

<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-sec3">+ PRINT</span></a>
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




<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Reviewers</strong></h3>
    </div>
    <div class="modal-body">


<?php
$sqlCountrycv = "select * FROM ".$prefix."submission_review_sr order by id asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
$reviewer_id=$rCountrycv['reviewer_id'];
$sqlUser = "select * FROM ".$prefix."user where asrmApplctID='$reviewer_id'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUser);
$rUser=$resultUser->fetch_array();
?>
<?php echo $rUser['name'];?><br />
<?php }?>          
                
    </div>
    </div>
    </div><!--End Reviewer-->








<?php }//end Admin
//REC ADMIN
if($session_privillage=='recreviewer'){
	///Declare conflict of interest
	if($_GET['confdata']=='yes'){
		
		
		
		
	}
	
	
	
	
	?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
<option value="" selected="">All</option>
<option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>

   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>
<script>
   function popitup(url) 
   {
    newwindow=window.open(url,'name','height=600,width=950,screenX=400,screenY=350');
    if (window.focus) {newwindow.focus()}
    return false;
   }
   </script> 
<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Protocols for Review</h3>
</div>
                    <div class="card-body">
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Protocol Title</th>
                            <th>Type</th>
                            <th>REC</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new'
}
if(!$_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID'  order by id desc");//and conceptm_status='new'
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
$start = 0;
if($_POST['searchprotocol']){								//if no page var is given, set start to 0
echo $sql = "select * FROM ".$prefix."submission_review_sr where  reviewer_id='$asrmApplctID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}
if(!$_POST['searchprotocol']){								//if no page var is given, set start to 0
$sql = "select * FROM ".$prefix."submission_review_sr where  reviewer_id='$asrmApplctID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

///submission_review_sr
$sqlReview = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created  from ".$prefix."submission where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultReview = $mysqli->query($sqlReview);
$totalReview = $resultReview->num_rows;
$sqReview = $resultReview->fetch_array();

////Get REC
$recAffiliated_c=$rProjects['recAffiliated_c'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_c'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$sqReview['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $sqReview['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td><?php if($sqReview['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($sqReview['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?>                          </td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $sqReview['updated'];?></td>
                            <td>
							<?php if(!$totalReview){?>Waiting for Committee Review<?php }?>
							<?php if($totalReview){?><?php echo $rProjects['recstatus'];?> <?php }?>
                            
							</td>
                            <td>
<?php if($rProjects['recstatus']=='Pending' || $rProjects['recstatus']=='new' and $rProjects['conflictofInterest']=='no'){?><a href="./main.php?option=RecinitialCommitteeReview&id=<?php echo $sqReview['id'];?>" style=" color:#ffffff;" class="label label-sec4">Review Submission</a><br />

<?php }?>

<?php if($rProjects['conflictofInterest']=='none' and $rProjects['recstatus']=='Pending' || $rProjects['recstatus']=='new'){?>
<div style="margin-bottom:6px;"></div>

<input id="go" type="button" value="Click to Confirm Availability to Review" onclick="window.open('<?php echo $base_url;?>conflict.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=500, width=700, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm3" >


<?php }?>


<div style="margin-bottom:6px;"></div>

<?php if($rProjects['recstatus']!='Pending' and $rProjects['conflictofInterest']=='no'){?><a href="<?php echo $base_url;?>main.php?option=dashboard" onClick="return popitup('comments.php?id=<?php echo $main_submission_id;?>')" class="label label-sec2" style="padding-left:15px; padding-right:13px;">View Comments</a><div style="margin-bottom:6px;"></div><?php }?>

<a href="print.php?pr=<?php echo $sqReview['id'];?>" target="_blank"  class="label label-primary" style=" color:#ffffff; padding-left:15px; padding-right:13px;">View /Print Submission</a>
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
<?php }//end Admin

if($session_privillage=='UHNRO'){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="55%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
     <td width="11%">
Search by Type:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="type" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv4 = "select * FROM ".$prefix."categories order by rstug_categoryName asc";//and conceptm_status='new' 
$resultClinicalcv4 = $mysqli->query($sqlClinicalcv4);
while($rClinicalcv4=$resultClinicalcv4->fetch_array()){
?>
<option value="<?php echo $rClinicalcv4['rstug_categoryID'];?>" <?php if($rClinicalcv4['rstug_categoryID']==$_POST['type']){?>selected="selected"<?php }?>><?php echo $rClinicalcv4['rstug_categoryName'];?></option>
<?php }?>
</select>

                                
   </td>
    <td width="11%">
Search by REC:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="recID" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$_POST['recID']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                                
   </td>

    <td width="16%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
 <option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending Final Submission" <?php if($_POST['status']=='Pending Final Submission'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>
   
   <td width="7%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
</div>
                    <div class="card-body">
               <table width="100%" class="table table-striped table-sm"  id="customers">
                        <thead>
                          <tr>
                            <th width="6%">#</th>
                            <th width="27%">Protocol Title</th>
                            <th width="20%">PI</th>
                            <th width="39%">Objectives</th>
                            <th width="8%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
$recID=$_POST['recID'];
$type=$_POST['type'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and status='$status' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}

if($_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where status='$status' and recAffiliated_id='$recID' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and recAffiliated_id='$recID' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['type']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and clinical_trial_type='$type' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}

if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
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
$start = 0;		

if($_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and status='$status' and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where status='$status' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

 if(!$_POST['status'] and $_POST['type']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and clinical_trial_type='$type' and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}


if(!$_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and recAffiliated_id='$recID'  and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['doSearch']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and is_clinical_trial='1'  order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

////Get REC
$recAffiliated_id=$rProjects['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$rProjects['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td>
<?php echo $sqUserdd['name'];?>
<?php /*?><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?><?php */?>
  
  
  </td>
   <td><?php echo $rProjects['objective_1'];?>
   <?php //if($rProjects['status']=='Approved'){echo "Approved";}else{echo $rProjects['status'];}?>
   
   </td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>" style="color:#039; font-weight:bold;">+ VIEW</a>
                          <?php /*?>  <?php if($rProjects['status']){?><a href="./main.php?option=submissionUpSecond/<?php echo $rProjects['id'];?>/"><img src="./img/icon2.png" border="0" title="Edit Submission"/></a>
                            <a href=""><img src="./img/icon3.png" border="0" title="Delete Protocol"/></a><?php }?><?php */?>
                            
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
<?php }//end UHNRO

///Monitoring only
if($session_privillage=='administrator'){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="55%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
     <td width="11%">
Search by Type:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="type" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv4 = "select * FROM ".$prefix."categories order by rstug_categoryName asc";//and conceptm_status='new' 
$resultClinicalcv4 = $mysqli->query($sqlClinicalcv4);
while($rClinicalcv4=$resultClinicalcv4->fetch_array()){
?>
<option value="<?php echo $rClinicalcv4['rstug_categoryID'];?>" <?php if($rClinicalcv4['rstug_categoryID']==$_POST['type']){?>selected="selected"<?php }?>><?php echo $rClinicalcv4['rstug_categoryName'];?></option>
<?php }?>
</select>

                                
   </td>
    <td width="11%">
Search by REC:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="recID" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$_POST['recID']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                                
   </td>

    <td width="16%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
 <option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending Final Submission" <?php if($_POST['status']=='Pending Final Submission'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>
   
   <td width="7%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
</div>
                    <div class="card-body">
               <table width="100%" class="table table-striped table-sm"  id="customers">
                        <thead>
                          <tr>
                            <th width="6%">#</th>
                            <th width="27%">Protocol Title</th>
                            <th width="20%">PI</th>
                            <th width="39%">Objectives</th>
                            <th width="8%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
$recID=$_POST['recID'];
$type=$_POST['type'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1'  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc");//and conceptm_status='new' }
}
if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and status='$status' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' }
}

if($_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where status='$status' and recAffiliated_id='$recID' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and recAffiliated_id='$recID' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['type']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and clinical_trial_type='$type' order by id desc");//and conceptm_status='new' }
}

if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' order by id desc");//and conceptm_status='new' }
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
$start = 0;		

if($_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where status='$status' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

 if(!$_POST['status'] and $_POST['type']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and clinical_trial_type='$type' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}


if(!$_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['doSearch']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

////Get REC
$recAffiliated_id=$rProjects['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$rProjects['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td>
<?php echo $sqUserdd['name'];?>
<?php /*?><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?><?php */?>
  
  
  </td>
   <td><?php echo $rProjects['objective_1'];?>
   <?php //if($rProjects['status']=='Approved'){echo "Approved";}else{echo $rProjects['status'];}?>
   
   </td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>" style="color:#039; font-weight:bold;">+ VIEW</a>
                          <?php /*?>  <?php if($rProjects['status']){?><a href="./main.php?option=submissionUpSecond/<?php echo $rProjects['id'];?>/"><img src="./img/icon2.png" border="0" title="Edit Submission"/></a>
                            <a href=""><img src="./img/icon3.png" border="0" title="Delete Protocol"/></a><?php }?><?php */?>
                            
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
<?php }//end Admin
