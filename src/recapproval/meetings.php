<?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php'); 
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

<meta charset="UTF-8">
<title><?php echo $sitename;?></title>
<meta name="description" content="">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
<link rel="shortcut icon" href="images/ico/favicon.png">
<link rel="stylesheet" href="css/bootstrap.min.css">
<!--[if IE]><![endif]-->
<link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<section class="projects no-padding-top">
            <div class="container-fluid">
            
            <div class="card-body">
               <table class="table table-striped table-sm">
                        <thead>
                          <tr>

                            <th>Protocol</th>
                            <th>Decision</th>
                            <th>Agenda</th>
                           
                          </tr>
                        </thead>
                        <tbody>
<?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];

$category=$_POST['category'];
$page='main.php?';
$url='meetings';
$value='&id='.$id;
$search=$mysqli->real_escape_string($_POST['search']);
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."meeting  where date like '%$id%'  and recAffiliated_id='$recAffiliated_idm' order by id desc");//and conceptm_status='new' 


$total_pages = $query->fetch_array($mysqli->query($query));
$rFListss2=$query->fetch_array();
$total_pages = $rFListss2['num'];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 15;
//how many items to show per page
$page = $_GET['pages'];
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;								//if no page var is given, set start to 0

$sql = "select *,DATE_FORMAT(`date`,'%D/%m/%Y') AS datem FROM ".$prefix."meeting where date like '%$id%'  and recAffiliated_id='$recAffiliated_idm' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 

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

///Meeting Date
$sqlSRRDate = "select *,DATE_FORMAT(`date`,'%D/%m/%Y') AS datem from ".$prefix."meeting where date like '%$id%'";
$resultSSSDat = $mysqli->query($sqlSRRDate);
$sqUserddss = $resultSSSDat->fetch_array();
?>
<h3 class="success">Meeting Date: <?php echo $sqUserddss['datem'];?></h3><br>
<div class="success">Subject: <?php echo $sqUserddss['subject'];?></div>
<hr>
<?php
while($rProjects=$result->fetch_array()){
	
	$pprotocol_idm=$rProjects['protocol_id'];

$sqlRStatus2 = "select * FROM ".$prefix."submission where protocol_id='$pprotocol_idm'";
$resultStatus2 = $mysqli->query($sqlRStatus2);
$rStatus2=$resultStatus2->fetch_array();

$sqlRStatus3 = "select * FROM ".$prefix."protocol where id='$pprotocol_idm'";
$resultStatus3 = $mysqli->query($sqlRStatus3);
$rStatus3=$resultStatus3->fetch_array();


	?>
                          <tr>
                            <td><strong><?php echo $rStatus3['code'];?></strong> - <?php echo $rStatus2['public_title'];?></td>
                            <td>
                            <?php
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where  protocol_id='$pprotocol_idm' order by id desc LIMIT 0,10";//and conceptm_status='new'
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	echo $rInvestigator['screening'].'<br>';
}
 ?>                           
                            
                            
                            
                            </td>
                            <td><?php echo $rProjects['content'];?></td>

                         
                          </tr>
   <?php }///////////end function ?>                 
                      </table>
 </div>
                     </div>
          </section>
</body>
</html>