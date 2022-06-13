<?php
if($session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson' || $session_privillage=='recitadmin'){
	
	//doSaveFive
if($_POST['doFilesUpload'] and $_FILES['Attachment']['name'] and $_POST['asrmApplctID']){
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
	$DocumentName=$mysqli->real_escape_string($_POST['DocumentName']);

	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$Version=$mysqli->real_escape_string($_POST['Version']);
	$Language=$mysqli->real_escape_string($_POST['Language']);
	$Description=$mysqli->real_escape_string($_POST['Description']);
	$mdate=$mysqli->real_escape_string($_POST['date']);
	$month=$mysqli->real_escape_string($_POST['month']);
	$year=$mysqli->real_escape_string($_POST['year']);
	$DateofProposal=$mysqli->real_escape_string($year.'-'.$month.'-'.$mdate);

$extensionw = getExtension(preg_replace('/\s+/', '_', $_FILES['Attachment']['name']));

if($extensionw=='pdf'){
	
if($_FILES['Attachment']['name']){
$Attachment = preg_replace('/\s+/', '_', $_FILES['Attachment']['name']);
$Attachment2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['Attachment']['name']));
$targetw1 = "files/meetings/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['Attachment']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['Attachment']['tmp_name']), $targetw1);

}

$sqlstudy="SELECT * FROM ".$prefix."attendences where `recAffiliated_id`='$recAffiliated_id' and DocumentName='$DocumentName'  and Attachment='$Attachment2'";//
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
if(!$totalstudy){
$sqlA2="insert into ".$prefix."attendences (`owner_id`,`recAffiliated_id`,`DocumentName`,`Version`,`Description`,`Attachment`,`docDate`) 

values('$asrmApplctID','$recAffiliated_id','$DocumentName','$Version','$Description','$Attachment2',now())";
$mysqli->query($sqlA2);



$message='<div class="success">Dear '.$session_fullname.', Attendance details have been added.</div>';
logaction("$session_fullname added Attendance details");
}
if($totalstudy){
$message='<div class="error2">Dear '.$session_fullname.', looks like duplicate file attached</div>';	
}
}else{$message="<span class=error2>Please upload PDF file (s) only. Your File was not uploaded</span>";}


}//end post
	
if($_GET['comnme']=="delete"){
	
$sqlstudy33="SELECT * FROM ".$prefix."attendences where id='$id'";//
$Querystudy33 = $mysqli->query($sqlstudy33);	
$rInGoal=$Querystudy33->fetch_array();
$Attachment=$rInGoal['Attachment'];
$upDelete="delete from ".$prefix."attendences  where  id='$id'";
$mysqli->query($upDelete);

$file = "./files/meetings/$Attachment";
if (!unlink($file))
  {
  //echo ("Error deleting $file");
  }
else
  {
 // echo ("Deleted $file");
  }
 $message="<span class=error2>Attendance has been successfully removed.</span>"; 
}
if( $message){echo  $message;}
	?>



<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="90%">Find Attendances:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
  
<!--   <td width="9%"> <br /><input name="" type="button" class="btn-warning btn" value="Export to CSV"/></td>-->
   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>
<button id="myBtn">Add Minutes </button> 

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Meeting Minutes</h3>
</div>
                    <div class="card-body">
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Document Name</th>
                            <th>Version</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Attachment</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='Attendances';
$value='';
$searchprotocol=$_POST['searchprotocol'];

//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' and (DocumentName like '%$searchprotocol%' OR Version like '%$searchprotocol%' OR Attachment like '%$searchprotocol%')  order by id desc");//and conceptm_status='new' 
}

if(!$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' and  status='$status' order by id desc");//and conceptm_status='new' 
}

if(!$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' and  (DocumentName like '%$searchprotocol%' OR Version like '%$searchprotocol%' OR Attachment like '%$searchprotocol%') order by id desc");//and conceptm_status='new' 

}



if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 
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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' and (DocumentName like '%$searchprotocol%' OR Version like '%$searchprotocol%' OR Attachment like '%$searchprotocol%')  order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."attendences where recAffiliated_id='$recAffiliated_id'  order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' and (DocumentName like '%$searchprotocol%' OR Version like '%$searchprotocol%' OR Attachment like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`docDate`,'%d/%m/%Y %H:%s:%i') AS docDatem FROM ".$prefix."attendences where recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
We're actually saving the Version to a variable in case we want to draw it more than once.
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

////Get REC
$recAffiliated_id=$rProjects['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

	?>
                          <tr>
                            <td scope="row"><?php echo $rProjects['id'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['DocumentName'];?></h3></td>
                            <td><?php echo $rProjects['Version'];?></td>
   <td><?php echo $rProjects['Description'];?></td>
                            <td><?php echo $rProjects['docDatem'];?></td>
                            <td>
                              
 <a href="./files/meetings/<?php echo $rProjects['Attachment'];?>" target="_blank">View File</a><br />
 
 <a href="main.php?option=Attendances&comnme=delete&id=<?php echo $rProjects['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this Attendence?');">Remove File</a>
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
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add Minutes</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-4 form-control-label">Name of the Document: <span class="error">*</span></label>
<div class="col-sm-7">
<input type="text" name="DocumentName" id="DocumentName" tabindex="9" value="" class="form-control  required"/>
</div>
</div> 

 
 <div class="form-group row">
 
<label class="col-sm-4 form-control-label">Version: <span class="error">*</span></label>
<div class="col-sm-7">
<input type="text" name="Version" id="Version" class="form-control  required" value="" required>

</div>
</div> 

<!-- <div class="form-group row">
 
<label class="col-sm-4 form-control-label">Description: <span class="error">*</span></label>
<div class="col-sm-7">
<input type="text" name="Description" id="Description" class="form-control  required" value="" required>

</div>
</div> -->

  <div class="form-group row">
 
<label class="col-sm-4 form-control-label">Date of the Document:</label>
<div class="col-sm-7">
<table width="100%" border="0">
  <tr>
    <td>
  
  <select name="year" id="dyear" class="form-control" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulate(this.value)">
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
  </td>
  </tr>
</table>






</div>
</div>        


 <div class="form-group row">
 
<label class="col-sm-3 form-control-label">File  (PDF) <span class="error">*</span>:</label>
<div class="col-sm-8">
<input name="Attachment" type="file" id="Attachment" class="required" required/>

<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="recAffiliated_id" value="<?php echo $recAffiliated_id;?>">
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
    







<?php }//end Admin
?>