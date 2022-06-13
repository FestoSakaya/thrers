<?php if($session_privillage=='recadmin'){?><button id="myBtn">User Accounts </button>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find Users:<br />
    <input type="text" class="form-control" name="searchname"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="name" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
                                <option value="S" selected="selected">User</option>
          </select>
                                
   </td>

   <td width="6%"><br /><input type="submit" name="button" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>
<div class="number allprotocols">        
         <a href="exportpis.php">Export Investigators</a></div>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">My Investigators </h3>
</div>
                    <div class="card-body">
                <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution of affiliation</th>
                            <th>Email</th>
                            <th>Phone</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='main.php?option=';
$url='Investigators';
$value='&id='.$id;
//$value='listuserauthorised';
$name=$_POST['searchname'];
$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchname']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new'
}//and privillage!='recreviewer' and (name like '%$name%' OR email like '%$name%')
if(!$_POST['searchname']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' group by owner_id order by id desc");//and conceptm_status='new'
}
$row = $query -> fetch_array(MYSQLI_NUM);
$total_pages = $row[0];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 500;
//how many items to show per page
/*Extract Last Value from a link*/
$page = $_GET['page'];
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;	
if($_POST['searchname']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where recAffiliated_id='$recAffiliated_id'  group by owner_id order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
$result = $mysqli->query($sql);
}
if(!$_POST['searchname']){							//if no page var is given, set start to 0
$sql = "select DISTINCT * FROM ".$prefix."submission where recAffiliated_id='$recAffiliated_id' group by owner_id order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
$result = $mysqli->query($sql);
}

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
$asrmApplctID=$rProjects['owner_id'];


$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$rUser = $resultSSS->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rUser['name'];?></td>
                            <td><?php echo $rUser['institution'];?></td>
                            <td><?php echo $rUser['email'];?></td>
                            <td><?php echo $rUser['phone'];?></td>
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
