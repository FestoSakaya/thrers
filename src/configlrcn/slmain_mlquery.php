<?php
//$Auth = new Auth();
////////////////Begin Table Prefix////////////////////////////////////////////////

$photos_folder="files/photos/";
$requsitions_folder="../files/requsitions/";
////////////////End Table Prefix///////////////////////////////////////////////////

function striptags($value)
{   
	$return=strip_tags($value);  
	$return=htmlspecialchars($return);  
	$return=mysql_real_escape_string($return);
	return $return;
}

function numberformat($nvalue)
{   
	$returnno=number_format($nvalue,0);  
	return $returnno;
}
//////////////////////////////////////////////////////////////////////////////////////////
function EscapeString($evalue)
{
$returnES=mysql_real_escape_string($evalue);
return $returnES;	
}
///////////////////////date/////////////////
function dateformat($date,$format="")
{
	$default_format="l dS F, Y";
	$format=($format)?$format:$default_format;
	
$new_date=new DateTime($date);
$new_date=$new_date->format($format);

return $new_date;
	
}

function Error($errorvalue)
{
$returnerrorVal=print(mysql_error($errorvalue));
return $returnerrorVal;	
}

function Menu(){
global $mysqli,$prefix;
		$sqlUser = "SELECT * FROM ".$prefix."web_menus order by rank asc limit 0,6";
		$queryUser = $mysqli->query($sqlUser);
        $totalUser = $queryUser->num_rows;
        while($r = $queryUser->fetch_array()){?>
        <li><a href="#<?php echo $r['menu_link'];?>"><?php echo $r['menu_name'];?></a></li>
        <?php 
}
}
function WelcomeAbout(){
global $mysqli,$prefix;
		$sqlUser2 = "SELECT * FROM ".$prefix."web_content where category='about' and publish='Yes'";
		$queryUser2 = $mysqli->query($sqlUser2);
        $totalUser2 = $queryUser2->num_rows;
        $r2 = $queryUser2->fetch_array();?>
       <h2 class="text-uppercase" style="color:#ffffff!important;"><strong><?php echo $r2['title'];?></strong></h2>
                                 
                                    <p class="m-top-20"><?php echo $r2['summary'];?></p>
        <?php 
}

function WecomeContentLeftA(){
global $mysqli,$prefix;
		$sqlUser_a = "SELECT * FROM ".$prefix."web_content where category='content_left_top' and publish='Yes' order by rank asc limit 0,1";
		$queryUser_a = $mysqli->query($sqlUser_a);
        $totalUser_a = $queryUser_a->num_rows;
        $r_a = $queryUser_a->fetch_array();?>
         <h3><?php echo $r_a['title'];?></h3>
         <p><?php echo $r_a['summary'];?></p>
<a href="<?php echo $r_a['link'];?>" class="btn btn-primary m-top-20" target="_blank">Apply Now</a>
        <?php 
}

function WecomeContentLeftB(){
global $mysqli,$prefix;
		$sqlUser_a3 = "SELECT * FROM ".$prefix."web_content where category='content_middle_top' and publish='Yes' order by rank asc limit 0,1";
		$queryUser_a3 = $mysqli->query($sqlUser_a3);
        $totalUser_a3 = $queryUser_a3->num_rows;
        $r_a3 = $queryUser_a3->fetch_array();?>
         <h3><?php echo $r_a3['title'];?></h3>
         <p><?php echo $r_a3['summary'];?></p>
<a href="<?php echo $r_a3['link'];?>" class="btn btn-primary m-top-20" target="_blank">Apply Now</a>
        <?php 
}
function WecomeContentLeftC(){
global $mysqli,$prefix;
		$sqlUser_a4 = "SELECT * FROM ".$prefix."web_content where category='content_right_top' and publish='Yes' order by rank asc limit 0,1";
		$queryUser_a4 = $mysqli->query($sqlUser_a4);
        $totalUser_a4 = $queryUser_a4->num_rows;
        $r_a4 = $queryUser_a4->fetch_array();?>
         <h3><?php echo $r_a4['title'];?></h3>
         <p><?php echo $r_a4['summary'];?></p>
<a href="<?php echo $r_a4['link'];?>" class="btn btn-primary m-top-20" target="_blank">Apply Now</a>
        <?php 
}



function WecomeContentLeftD(){
global $mysqli,$prefix;
		$sqlUser_a5 = "SELECT * FROM ".$prefix."web_content where category='content_left_bottom' and publish='Yes' order by rank asc limit 0,1";
		$queryUser_a5 = $mysqli->query($sqlUser_a5);
        $totalUser_a5 = $queryUser_a5->num_rows;
        $r_a5 = $queryUser_a5->fetch_array();?>
         <h3><?php echo $r_a5['title'];?></h3>
         <p><?php echo $r_a5['summary'];?></p>

        <?php 
}

function WecomeContentLeftE(){
global $mysqli,$prefix;
		$sqlUser_a6 = "SELECT * FROM ".$prefix."web_content where category='content_left_bottom' and publish='Yes' order by rank asc limit 0,1";
		$queryUser_a6 = $mysqli->query($sqlUser_a6);
        $totalUser_a6 = $queryUser_a6->num_rows;
        $r_a6 = $queryUser_a6->fetch_array();?>
         <h3><?php echo $r_a6['title'];?></h3>
         <p><?php echo $r_a6['summary'];?></p>

        <?php 
}

if ($_POST['doLogin']=='Sign in')
{

		$name = $mysqli->real_escape_string($_POST['name']);
		$md5pass = md5($mysqli->real_escape_string($_POST['pwd']));

		$sqlUser = "SELECT * FROM ".$prefix."user where username='$name' and password='$md5pass'";
		$queryUser = $mysqli->query($sqlUser);
        $totalUser = $queryUser->num_rows;
        $r = $queryUser->fetch_array();
	
		$dbasrmApplctID=$r['asrmApplctID'];
		$dbprdffullname=$r['name'];
		$dbasrmEmail=$r['email'];
		$dbasrmUserName=$r['username'];
		$dbasrmApproved=$r['is_active'];
		$dbasrmStatus=$r['asrmStatus'];
		$dbprivillage=$r['privillage'];
		$userConfirmation=$r['userConfirmation'];
		$passwordpwd=$r['password'];
		$userConfirmationLink=$r['userConfirmationLink'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////


		if($totalUser==1 && $dbasrmApproved=="1"){ 
		$_SESSION['username']=$dbasrmUserName;
		$_SESSION['email']=$dbasrmEmail;
		$_SESSION['asrmApplctID']=$dbasrmApplctID;
		$_SESSION['privillage']=$dbprivillage;
		$_SESSION['mmfullname']=$dbprdffullname;
		$_SESSION['password']=$passwordpwd;	
//$sqlA = "update ".$prefix."users set first_access='1',loggedin=now() where asrmApplctID=".$_SESSION['asrmApplctID'];
//$mysqli->query($sqlA);

if($_SESSION['privillage']=='recadmin' || $_SESSION['privillage']=='administrator' || $_SESSION['privillage']=='rechairperson' || $_SESSION['privillage']=='revicechairperson' || $_SESSION['privillage']=='secretary' || $_SESSION['privillage']=='membercommittee' || $_SESSION['privillage']=='memberadhoc' || $_SESSION['privillage']=='recreviewer' || $_SESSION['privillage']=='monitoring' || $_SESSION['privillage']=='communityrepresentative' || $_SESSION['privillage']=='recitadmin'){//Login PI
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/recapproval/main.php?option=dashboard">';

}

if($_SESSION['privillage']=='investigator' and $userConfirmation=="new" || $userConfirmation==""){///Login Admin
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/recapproval/main.php?option=dashboard">';
}
if($_SESSION['privillage']=='investigator' and $userConfirmation=="returning"){///Login Admin
/*echo("<script>location.href = '".$userConfirmationLink."';</script>");*/
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/recapproval/main.php?option=dashboard">';
}		
			}else{
$err2='<div class="error"><b>Error: Wrong username, password!</b></div>';
		
		
			}
					}//end if post
					
	$asrmUserName=$_SESSION['username'];
		$asrmApplctID=$_SESSION['asrmApplctID'];
		$session_fullname=$_SESSION['mmfullname'];
		$session_privillage=$_SESSION['privillage'];
		$session_password=$_SESSION['password'];			
						# Session Logout after in activity 
function sessionX(){
	global $session_username,$mysqli;
    $logLength = 1200; # time in seconds :: 1800 = 30 minutes 
    $ctime = strtotime("now"); # Create a time from a string 
    # If no session time is created, create one 
    if(!isset($_SESSION['sessionX'])){  
        # create session time 
        $_SESSION['sessionX'] = $ctime;  
    }else{ 
        # Check if they have exceded the time limit of inactivity 
        if(((strtotime("now") - $_SESSION['sessionX']) > $logLength) && $session_username){ 
            # If exceded the time, log the user out 
            //logOut(); 
			session_destroy();
            # Redirect to login page to log back in 
            header("location: ./"); 
            exit; 
        }else{ 
            # If they have not exceded the time limit of inactivity, keep them logged in 
            $_SESSION['sessionX'] = $ctime; 
        } 
    } 
}
?>