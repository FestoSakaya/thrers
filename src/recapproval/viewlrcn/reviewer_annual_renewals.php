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
                      <h3 class="h4">Annual Renewals for Review</h3>
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
$url='ReviewerAnnualRenualMa';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='AnnualRenewal' order by id desc");//and conceptm_status='new'

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
							//if no page var is given, set start to 0
$sql = "select * FROM ".$prefix."submission_review_sr where  reviewer_id='$asrmApplctID'  and reviewFor='AnnualRenewal' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'

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
$renewal_id=$rProjects['renewal_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

////////////////Get Renewals
$sqlrenewals = "select * from ".$prefix."renewals where id='$renewal_id'";
$resultrenewals = $mysqli->query($sqlrenewals);
$sqprenewals = $resultrenewals->fetch_array();

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
                            <td scope="row">
							<?php if($rProjects['ammendType']=='manual'){echo $sqprenewals['code'];}?>
                            
                            <?php if($rProjects['ammendType']=='online'){echo $sqprotocol['code'];}?>
							</td>
                            <td><h3 class="h4">
							
                            <?php if($rProjects['ammendType']=='manual'){echo $rProjects['public_title'];}?>
                            
                            <?php if($rProjects['ammendType']=='online'){echo $sqReview['public_title'];}?>
                            
                            
                            </h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            
                            <td>
<?php if($rProjects['ammendType']=='online'){?><span class="label label-warning">Online Submission</span><?php }?>
  <?php if($rProjects['ammendType']=='manual'){?><span class="label label-primary">Manual Submission</span> <?php }?>
  
  </td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['reviewDate'];?></td>
                            <td>
							<?php if(!$totalReview){?>Waiting for Committee Review<?php }?>
							<?php if($totalReview){?><?php echo $rProjects['recstatus'];?> <?php }?>
                            
							</td>
                            <td>
<?php if($rProjects['recstatus']=='Pending' || $rProjects['recstatus']=='new' and $rProjects['conflictofInterest']=='no'){?><a href="./main.php?option=RecinitialCommitteeReviewInitial&id=<?php echo $renewal_id;?>" style=" color:#ffffff;" class="label label-sec4">Review Submission</a><br />

<?php }?>

<?php if($rProjects['conflictofInterest']=='none' and $rProjects['recstatus']=='Pending' || $rProjects['recstatus']=='new'){?>
<div style="margin-bottom:6px;"></div>

<input id="go" type="button" value="Click to Confirm Availability to Review" onclick="window.open('<?php echo $base_url;?>conflict.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=500, width=700, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm3" >


<?php }?>


<div style="margin-bottom:6px;"></div>

<?php if($rProjects['recstatus']!='Pending' and $rProjects['conflictofInterest']=='no'){?><a href="<?php echo $base_url;?>main.php?option=dashboard" onClick="return popitup('commentsrenewal.php?id=<?php echo $renewal_id;?>')" class="label label-sec2" style="padding-left:15px; padding-right:13px;">View Comments</a><div style="margin-bottom:6px;"></div><?php }?>

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
