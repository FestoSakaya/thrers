<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="70%"><span class="label label-sec2">Find protocol (Search by protocol title or RefNo):</span><br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>" style="border:2px ssolid #09F!important; padding:10px!important;"></td>
   
   <td width="7%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>
<?php
$searchprotocol=$_POST['searchprotocol'];
if($_POST['searchprotocol']){
	?>
                    <div class="card-body">
               <table width="100%" class="table table-striped table-sm"  id="customers">
                        <thead>
                          <tr>
                            <th width="10%">#</th>
                            <th width="50%">Protocol Title</th>
                            <th width="18%">PI</th>
                            <th width="12%">Transfer To</th>
                            <th width="10%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT 0,5";//and conceptm_status='new'

$result = $mysqli->query($sql);

$rProjects=$result->fetch_array();
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
while($sqUserddRREC2 = $resultSSSREC2->fetch_array()){
	?>
                          <tr>
<td scope="row"><?php echo $sqprotocol['code'];?> </td>
<td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
<td><?php echo $sqUserdd['name'];?></td>
<td>
<a href="./main.php?option=TransferProceed&id=<?php echo $rProjects['id'];?>"><span class="label label-sec4">Click to proceed</span></a>
</td>
<td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>" style="color:#039; font-weight:bold;" target="_blank">+ View Details</a>
                                                    
                            </td>
                          </tr>
             <?php }?>
                        </tbody>
                      </table>
        </div>

<?php }?>




<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Previously Transfered Protocols </h3>
</div>
                    <div class="card-body">
               <table width="100%" class="table table-striped table-sm"  id="customers">
                        <thead>
                          <tr>
                            <th width="12%">#</th>
                            <th width="36%">Protocol Title</th>
                            <th width="18%">Transfered From</th>
                            <th width="18%">Transfered To</th>
                            <th width="7%">Date</th>
                            <th width="9%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='TransferaProtocol';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
$recID=$_POST['recID'];
$type=$_POST['type'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission_transfered order by id desc");//and conceptm_status='new' }
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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_transfered order by id desc LIMIT $start, $limitm";//and conceptm_status='new'

 

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
$tranfer_from=$rProjects['transfered_from'];
$tranfer_to=$rProjects['transfered_to'];

$main_submission_id=$rProjects['main_submission_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$tranfer_from'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


$sqlSRRto = "select * from ".$prefix."user where asrmApplctID='$tranfer_to'";
$resultSSSto = $mysqli->query($sqlSRRto);
$sqUserdd_to = $resultSSSto->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."submission where id='$main_submission_id'";
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
                            <td><h3 class="h4"><?php echo $sqprotocol['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td>
<?php echo $sqUserdd['name'];?>
<?php /*?><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?><?php */?>
  
  
  </td>
   <td><?php echo $sqUserdd_to['name'];?>
   
   </td>
   <td><?php echo $sqprotocol['created'];?></td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['main_submission_id'];?>" style="color:#039; font-weight:bold;" target="_blank">+ VIEW</a>
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