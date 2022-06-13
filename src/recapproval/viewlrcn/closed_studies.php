<?php 
if($session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson' || $session_privillage=='recitadmin'){?>



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
<!--   <td width="9%"> <br /><input name="" type="button" class="btn-warning btn" value="Export to CSV"/></td>-->
   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>


<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Closed Studies</h3>
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
$url='ClosedStudies';
$value='';
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';


$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' and  	end_of_project2>'$sesdate' order by id desc");//and conceptm_status='new' 
}

if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and recAffiliated_id='$recAffiliated_id' and  status='$status'  and end_of_project2>'$sesdate' order by id desc");//and conceptm_status='new' 
}

if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and recAffiliated_id='$recAffiliated_id' and  (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%')  and end_of_project2>'$sesdate' order by id desc");//and conceptm_status='new' 

}



if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where is_sent='1' and recAffiliated_id='$recAffiliated_id'  and end_of_project2>'$sesdate' order by id desc");//and conceptm_status='new' 
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

if($_POST['status'] and $_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status'  and end_of_project2>'$sesdate' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and status='$status'  and end_of_project2>'$sesdate' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['status'] and $_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id'  and end_of_project2>'$sesdate' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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

///Halted Protocols
$sqlSRREC3 = "select * from ".$prefix."appeal_halted_studies where protocol_id='$main_submission_id' order by id desc";
$resultSSSREC3 = $mysqli->query($sqlSRREC3);
$sqUserddRREC3 = $resultSSSREC3->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td>
							
<?php if($rProjects['meeting_status']=='Meeting Scheduled' || $rProjects['meeting_status']=='Pending'){?><?php echo $rProjects['assignedto'];}else{?><?php //echo $rProjects['status'];?>
                            
<?php if($sqUserddRREC3['status']=='Approved'){echo "<b style='color:#796AEE;'>Approved</b>";}else{echo '<b style="color:#796AEE;">'.$sqUserddRREC3['status'].'</b>';}  }?>
                          <?php /*?><?php if($rProjects['assignedto']){?> 
                        
                           <button id="myBtn">View Reviewers </button><?php }?><?php */?>
                           
                           <?php if($rProjects['recruitment_status_id']=='1' and $rProjects['status']=='Approved'){?>
<input id="go" type="button" value="STUDY HALTED" onclick="window.open('<?php echo $base_url;?>haltstudies.php?id=<?php echo $rProjects['id'];?>&act=<?php echo $sqUserddRREC3['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm3" >
      
        <?php }?>
                                                    
<?php if($rProjects['recruitment_status_id']=='0' and $rProjects['status']=='Approved'){?>

<input id="go" type="button" value="STUDY ONGOING" onclick="window.open('<?php echo $base_url;?>haltstudies.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm4" >

<?php }?>
                            </td>
                            <td>
                    


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
