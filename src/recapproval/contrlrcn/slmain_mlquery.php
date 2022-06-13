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
//////////////////////////////////////////////////////////////////////////////////////////////////////////


		if($totalUser==1 && $dbasrmApproved=="1"){ 
		$_SESSION['username']=$dbasrmUserName;
		$_SESSION['email']=$dbasrmEmail;
		$_SESSION['asrmApplctID']=$dbasrmApplctID;
		$_SESSION['privillage']=$dbprivillage;
		$_SESSION['mmfullname']=$dbprdffullname;	


//////////////////record action//////////////////////////////////////
/*$sqlA = "INSERT INTO ".$prefix."logs(lg_action, lg_user, lg_user_level,lg_time) VALUES('$dbasrmUserName Logged in from $usersipaddress', '".$_SESSION['mmfullname']."', '".$_SESSION['asrmStatus']."','$dateSubmitted')";
$mysqli->query($sqlA);*/
$sqlA = "update ".$prefix."users set first_access='1',loggedin=now() where asrmApplctID=".$_SESSION['asrmApplctID'];
$mysqli->query($sqlA);
/*header("location:./data/dashboard/");echo("<script>location.href = 'http://localhost/work/uncst/recapproval/data/dashboard/';</script>");*/
echo("<script>location.href = '$base_url/recapproval/main.php?option=dashboard';</script>");
		
			}else{
$err2='<span class="error">Error: Wrong username, password!</span>';
		
		
			}
					}//end if post
			

$category=$mysqli->real_escape_string($_GET['option']);
$act=$mysqli->real_escape_string($_GET['act']);
$pd=$mysqli->real_escape_string($_GET['mdc']);
$id=$mysqli->real_escape_string($_GET['id']);
$bt=$mysqli->real_escape_string($_GET['bt']);
$c=$mysqli->real_escape_string($_GET['c']);
$n=$mysqli->real_escape_string($_GET['n']);
$bkey=$mysqli->real_escape_string($_GET['bkey']);
$bmw=$mysqli->real_escape_string($_GET['bmw']);
$address=$_SERVER['REQUEST_URI'];


///////////////////Begin main link/////////////////
function main($MainLink)
{
	global $category; 
	echo $mlink="main.php?option=";
}
///////////////////End main link/////////////////

//////////////sessions//////////////////////////////////////////////////////////////////////////
		$asrmUserName=$_SESSION['username'];
		$asrmApplctID=$_SESSION['asrmApplctID'];
		$session_fullname=$_SESSION['mmfullname'];
		$session_privillage=$_SESSION['privillage'];


///////////end sessions/////////////////////////////////////////////////////////////////////////

function authent($value)
{  global  $cac_role,$cm,$mdc;
	if($cac_role==$cm OR $cac_role==$mdc)
	{
	return($value);
	}
}

////////Begin time out////////////////////////////////////////////////////////////////////////////
function timeout($timeout)
				{
    global $asrmUserName,$asrmApplctID,$session_asrmStatus,$session_fullname,$ca_privillages,$logoutlink;
		
			if(!$asrmUserName and !$asrmApplctID and !$ca_privillages){
				
			header("Location: $logoutlink");
			//die("You are not authorized to see this page");
					}

			$timeout = 20; // Set timeout minutes
			$logout_redirect_url = "$logoutlink"; // Set logout URL
				
			$timeout = $timeout * 60; // Converts minutes to seconds
			if (isset($_SESSION['start_time'])) {
			$elapsed_time = time() - $_SESSION['start_time'];
			if ($elapsed_time >= $timeout) {
			session_destroy();
			header("Location: $logout_redirect_url");
				}
						}

}

function logaction($action) {
   global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus;

   $action = $mysqli->real_escape_string($action);
   $sql = "INSERT INTO ".$prefix."mlogs (lg_action, lg_user, lg_user_level,logdate) VALUES('$action', '$session_fullname', '$session_asrmStatus',now())";
   $mysqli->query($sql);
}
////////end time out///////////////////////////////////////////////////////////////////////

function photo()
{
global $asrmUserName,$asrmApplctID,$session_asrmStatus,$session_fullname,$mysqli,$prefix,$year;

$sqlGroupDIspss="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFGrpDisss=$mysqli->query($sqlGroupDIspss);
$rGRSPss=$sqlFGrpDisss->fetch_array();
?><?php if($rGRSPss['profile']){?>
 
 <div style="width:150px;margin:0 auto;"> <div class="avatar"><img src="./files/profile/<?php echo $rGRSPss['profile'];?>" alt="..." class="img-fluid rounded-circle"></div></div>
       
<?php }}
//MyREC
$sqlMyREC="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFMyREC=$mysqli->query($sqlMyREC);
$rGREC=$sqlFMyREC->fetch_array();
$recAffiliated_id=$rGREC['recAffiliated_id'];

///Get REC Name
$sqlMyrecname="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccna=$mysqli->query($sqlMyrecname);
$recName=$sqlFMyreccna->fetch_array();
///submission_review_sr// function removed. to be rechecked
function SubmissionReview()
{ global $asrmUserName,$asrmApplctID,$session_asrmStatus,$session_fullname,$mysqli,$prefix,$year;
$sqlAllReviewers = "select *,count(protocol_id) AS allprotocol_id FROM ".$prefix."submission_review_sr where protocolStage='stage1' group by protocol_id"; 
$resultAllReviewers = $mysqli->query($sqlAllReviewers);
$totalAllReviewers = $resultAllReviewers->num_rows;
while($rAllReviewers=$resultAllReviewers->fetch_array()){
$protocol_idID=$rAllReviewers['protocol_id'];
$totalReviewrs=$rAllReviewers['allprotocol_id'];
$rAllReviewers['allprotocol_id'].'==Protocol ID:'.$rAllReviewers['protocol_id'].'<br>';

$sqlAllReviewers2 = "select * FROM ".$prefix."submission where recstatus='Pending' and protocol_id='$protocol_idID'"; 
$resultAllReviewers2 = $mysqli->query($sqlAllReviewers2);
$totalAllReviewers2 = $resultAllReviewers2->num_rows;
if($totalAllReviewers2){
$update="update ".$prefix."submission set `totalReviers`='$totalReviewrs',`recstatus`='reviewed' where protocol_id='$protocol_idID'";
$mysqli->query($update);
}
////////////////////////////////////end//////
}
}

////Begin totals for REC admin
function TotalCompletePendingToREC()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission where recAffiliated_id='$recAffiliated_id' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalRevisions()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_archive where recAffiliated_id='$recAffiliated_id' order by id";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}
function MyTotalRevisions()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_archive where owner_id='$asrmApplctID' order by id";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalCompletePendingToRECUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission where owner_id='$asrmApplctID' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalSubmissionsAdmin()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM apvr_submission,apvr_list_rec_affiliated where  apvr_submission.recAffiliated_id=apvr_list_rec_affiliated.id and apvr_list_rec_affiliated.published='Yes' order by apvr_submission.id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function RECAdmins()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;
//'investigator','secretary','membercommittee','memberadhoc','administrator','recadmin','recreviewer','rechairperson','superadmin','UHNRO','monitoring'
$sqlMyRECtt="SELECT * FROM ".$prefix."user where privillage='recadmin' order by asrmApplctID desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function RECITAdmins()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;
//'investigator','secretary','membercommittee','memberadhoc','administrator','recadmin','recreviewer','rechairperson','superadmin','UHNRO','monitoring'
$sqlMyRECtt="SELECT * FROM ".$prefix."user where privillage='recitadmin' order by asrmApplctID desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function RECUsers()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;
//'investigator','secretary','membercommittee','memberadhoc','administrator','recadmin','recreviewer','rechairperson','superadmin','UHNRO','monitoring'
$sqlMyRECtt="SELECT * FROM ".$prefix."user where privillage='investigator' order by asrmApplctID desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}
function AccreditedRECs()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;
$sqlMyRECtt="SELECT * FROM ".$prefix."list_rec_affiliated where published='Yes' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalPendingReports()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt1="SELECT * FROM ".$prefix."final_reports where recAffiliated_id='$recAffiliated_id' and status!='Approved'";
$sqlFMyRECtt1=$mysqli->query($sqlMyRECtt1);
echo $sqlFMyRECtt1->num_rows;
}

function TotalPendingReportsUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt1="SELECT * FROM ".$prefix."final_reports where owner_id='$asrmApplctID' order by id desc";
$sqlFMyRECtt1=$mysqli->query($sqlMyRECtt1);
echo $sqlFMyRECtt1->num_rows;
}

function TotalPendingAnnualRenewals()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt2="SELECT * FROM ".$prefix."renewals where recAffiliated_id='$recAffiliated_id'";//is_sent='1' and 
$sqlFMyRECtt2=$mysqli->query($sqlMyRECtt2);
echo $sqlFMyRECtt2->num_rows;
}

function TotalPendingAnnualRenewalsUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt2="SELECT * FROM ".$prefix."renewals where owner_id='$asrmApplctID' order by id desc";
$sqlFMyRECtt2=$mysqli->query($sqlMyRECtt2);
echo $sqlFMyRECtt2->num_rows;
}

function TotalPendingAmmendments()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt3="SELECT * FROM ".$prefix."ammendments where recAffiliated_id='$recAffiliated_id' and status!='Approved'  group by code";
$sqlFMyRECtt3=$mysqli->query($sqlMyRECtt3);
echo $sqlFMyRECtt3->num_rows;
}

function TotalPendingAmmendmentsUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt3="SELECT * FROM ".$prefix."ammendments where owner_id='$asrmApplctID'  group by code order by id desc";
$sqlFMyRECtt3=$mysqli->query($sqlMyRECtt3);
echo $sqlFMyRECtt3->num_rows;
}

function TotalPendingNotifications()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt3="SELECT * FROM ".$prefix."notifications where recAffiliated_id='$recAffiliated_id' and status!='Approved'";
$sqlFMyRECtt3=$mysqli->query($sqlMyRECtt3);
echo $sqlFMyRECtt3->num_rows;
}

function TotalPendingNotificationsUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt3="SELECT * FROM ".$prefix."notifications where owner_id='$asrmApplctID' order by id desc";
$sqlFMyRECtt3=$mysqli->query($sqlMyRECtt3);
echo $sqlFMyRECtt3->num_rows;
}

function TotalPendingSAEs()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt4="SELECT * FROM ".$prefix."saes where recAffiliated_id='$recAffiliated_id' and status!='approved'";
$sqlFMyRECtt4=$mysqli->query($sqlMyRECtt4);
echo $sqlFMyRECtt4->num_rows;
}

function TotalPendingSAEsUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt4="SELECT * FROM ".$prefix."saes where owner_id='$asrmApplctID' order by id desc";
$sqlFMyRECtt4=$mysqli->query($sqlMyRECtt4);
echo $sqlFMyRECtt4->num_rows;
}

function TotalPendingDeviations()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt5="SELECT * FROM ".$prefix."deviations where recAffiliated_id='$recAffiliated_id' and status!='approved' order by deviationID desc";
$sqlFMyRECtt5=$mysqli->query($sqlMyRECtt5);
echo $sqlFMyRECtt5->num_rows;
}

function HaltedStudies()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECtt5="SELECT * FROM ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and recruitment_status_id='1' order by id desc";
$sqlFMyRECtt5=$mysqli->query($sqlMyRECtt5);
echo $sqlFMyRECtt5->num_rows;
}

function Appeals()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECttrr="SELECT * FROM ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and appeals='Yes' order by id desc";
$sqlFMyRECtt5rr=$mysqli->query($sqlMyRECttrr);
echo $sqlFMyRECtt5rr->num_rows;
}
function AppealsAdmin()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlMyRECttrr="SELECT * FROM ".$prefix."submission where appeals='Yes' order by id desc";
$sqlFMyRECtt5rr=$mysqli->query($sqlMyRECttrr);
echo $sqlFMyRECtt5rr->num_rows;
}
function MyHaltedStudies()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt5="SELECT * FROM ".$prefix."submission where owner_id='$asrmApplctID' and recruitment_status_id='1' order by id desc";
$sqlFMyRECtt5=$mysqli->query($sqlMyRECtt5);
echo $sqlFMyRECtt5->num_rows;
}


function TotalPendingDeviationsUser()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt5="SELECT * FROM ".$prefix."deviations where owner_id='$asrmApplctID' order by deviationID desc";
$sqlFMyRECtt5=$mysqli->query($sqlMyRECtt5);
echo $sqlFMyRECtt5->num_rows;
}
///////////, , , , 
function totalFlaggedProtocols()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlstudyFlagged="SELECT * FROM ".$prefix."submission where status='Rejected' order by id desc";
$QuerystudyFlagged = $mysqli->query($sqlstudyFlagged);
echo $QuerystudyFlagged->num_rows;
}

function SuspectedDuplicates()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlstudyFlagged="SELECT * FROM ".$prefix."submission where duplicates='Yes' order by id desc";
$QuerystudyFlagged = $mysqli->query($sqlstudyFlagged);
echo $QuerystudyFlagged->num_rows;
}

function totalAllSubmittedProtocols()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id;

$sqlstudyAllsun="SELECT * FROM ".$prefix."submission where status!='Pending Final Submission' order by id desc";
$QuerystudyAll = $mysqli->query($sqlstudyAllsun);
echo $QuerystudyAll->num_rows;
}

////////////REC Reviewer

function TotalCompletePendingToRECReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='protocol' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalPendingReportsReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='CloseOutReport' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function MyHaltedStudiesForReview()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt5="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='HaltedAppeal' and recstatus='new' order by id desc";
$sqlFMyRECtt5=$mysqli->query($sqlMyRECtt5);
echo $sqlFMyRECtt5->num_rows;
}

function TotalPendingAnnualRenewalsReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='AnnualRenewal' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalPendingAmmendmentsReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='Amendments' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalPendingNotificationsReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='Notifications' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalPendingSAEsReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='SAEs' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalPendingDeviationsReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='Deviations' and reviewStatus='Pending' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}

function TotalConflictofInterestReviewer()
{global $db,$prefix,$mysqli,$session_fullname,$session_asrmStatus,$recAffiliated_id,$asrmApplctID;

$sqlMyRECtt="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and conflictofInterest='yes' order by id desc";
$sqlFMyRECtt=$mysqli->query($sqlMyRECtt);
echo $sqlFMyRECtt->num_rows;
}


?>