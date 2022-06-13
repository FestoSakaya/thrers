<form action="" method="post" name="regForm" id="regForm" autocomplte="off">




<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find Closeout Reports:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                               <option value="" selected="">All</option>
<option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee</option>
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
                      <h3 class="h4">My Closeout Reports </h3>
</div>
                    <div class="card-body">
               <table width="100%" class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th width="456">Project Title </th>
                            <th width="153">Attachment</th>
                            <th width="161">Submission Date</th>
                                      
                            <th width="97">Status</th>
                            <th width="187">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='main.php?';
$url='MyFinalReportREC';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."final_reports  where (fileAttachment like '%$searchprotocol%') and recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 
}
if(!$_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."final_reports  where recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 
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
if($_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS datesubmitted FROM ".$prefix."final_reports  where (fileAttachment like '%$searchprotocol%') and recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}
if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS datesubmitted FROM ".$prefix."final_reports  where recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
} $count=0;
while($rProjects=$result->fetch_array()){
$owner_id=$rProjects['owner_id'];
$protocol_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."submission where protocol_id='$protocol_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_id' and meetingFor='Amendments' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();


	?>
                          <tr>
                            <td><h3 class="h4"><?php echo $rProjects['protocol_title'];?></h3></td>
                            <td>
                            
                            
                                       <?php
							
$notification_id=$rProjects['id'];
$sqlstudy="SELECT * FROM ".$prefix."final_reports_attachments where notification_id='$notification_id' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
while($rstudy = $Querystudy->fetch_array()){
$count++;
echo $count.' .';	
	?>
<a href="./files/uploads/<?php echo $rstudy['fileAttachment'];?>" target="_blank">View Attachment</a><br />
<?php }?>
                            
                            </td>
                            <td><?php echo $rProjects['datesubmitted'];?></td>
               
                            
                            <td><?php if($rProjects['status']=='Approved'){echo "Approved";}else{echo $rProjects['status'];}?></td>
                            <td>                            
<a href="./main.php?option=ConfirmCloseoutreport&id=<?php echo $rProjects['id'];?>"><span class="label label-primary">+ View Submission</span></a><div style="margin-bottom:6px;"></div>
                            
                           
                <div style="margin-bottom:6px;"></div>                         
<?php /*?><?php 
if($rProjects['assignedto']=='Not Assigned' and $rProjects['status']=='Submitted' and $session_privillage=='recitadmin'){?><a href="./main.php?option=ConfirmCloseoutreport/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Assign Reviewers</span></a><div style="margin-bottom:6px;"></div><?php } //$rProjects['paymentProof'] and?><?php */?>    
                    
<?php 
	if($rProjects['status']=='Submitted' and $session_privillage=='recadmin' and ($rProjects['assignedto']=='Not Assigned' || $rProjects['assignedto']=='')){?>
  <a href="./main.php?option=ConfirmCloseoutreport&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Assign Reviewers</span></a><div style="margin-bottom:6px;"></div><?php }?> 
  
  
  <?php 
	if($rProjects['status']=='Scheduled for Review' and $session_privillage=='recadmin' and $rProjects['assignedto']=='Assigned'){?>
  <a href="./main.php?option=ConfirmCloseoutreport&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Acknowledge Receipt</span></a><div style="margin-bottom:6px;"></div><?php }?> 


                            
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
