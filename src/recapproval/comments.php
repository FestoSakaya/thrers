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
            <?php
			if($session_privillage=='recreviewer'){?>
               <table class="table table-striped table-sm">
                        <thead>
                          <tr>

                            <th>Comment</th>
                            <th>Updated On</th>
 
                           
                          </tr>
                        </thead>
                        <tbody>
<?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];

$sql = "select * FROM ".$prefix."initial_committee_screening where  reviewer_id='$asrmApplctID' and protocol_id='$id' order by id desc LIMIT 0,100";//and conceptm_status='new'
$result = $mysqli->query($sql);
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
                            <td><?php echo $rProjects['screening'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
            

                         
                          </tr>
   <?php }///////////end function
			}else{?>Other comments<?php }?>                 
                        </tbody>
                      </table>
                      </div>
                     </div>
          </section>
</body>
</html>