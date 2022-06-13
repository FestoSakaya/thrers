 <?php
 
$sqlstudyPending="SELECT * FROM apvr_submission,apvr_list_rec_affiliated where  apvr_submission.recAffiliated_id=apvr_list_rec_affiliated.id and is_sent='0' and apvr_list_rec_affiliated.published='Yes' order by apvr_submission.id desc";
$QuerystudyPending = $mysqli->query($sqlstudyPending);
$totalstudyPending = $QuerystudyPending->num_rows;

$sqlstudyassignedto="SELECT * FROM apvr_submission,apvr_list_rec_affiliated where  apvr_submission.recAffiliated_id=apvr_list_rec_affiliated.id and apvr_list_rec_affiliated.published='Yes' and apvr_submission.status='Scheduled for Review' and is_sent='1' order by apvr_submission.id desc";
$Querystudyassignedto = $mysqli->query($sqlstudyassignedto);
$totalstudyassignedto = $Querystudyassignedto->num_rows;
//SELECT * FROM ".$prefix."submission where status='Scheduled for Review' and is_sent='1' order by id desc




$sqlstudySubmitted="SELECT * FROM apvr_submission,apvr_list_rec_affiliated where  apvr_submission.recAffiliated_id=apvr_list_rec_affiliated.id and apvr_list_rec_affiliated.published='Yes' order by apvr_submission.id desc";
$QuerystudySubmitted = $mysqli->query($sqlstudySubmitted);
$totalstudySubmitted = $QuerystudySubmitted->num_rows;
$rstudySubmitted = $QuerystudySubmitted->fetch_array();//where is_sent='1'

$sqlstudyApproved="SELECT * FROM apvr_submission,apvr_list_rec_affiliated where  apvr_submission.recAffiliated_id=apvr_list_rec_affiliated.id and apvr_list_rec_affiliated.published='Yes' and apvr_submission.status='Approved' and is_sent='1' order by apvr_submission.id desc";
$QuerystudyApproved = $mysqli->query($sqlstudyApproved);
$totalstudyApproved = $QuerystudyApproved->num_rows;
////Detect Duplicate Titles at REC level and UNCST and Flag the study to all REC Admins
 /*$sqlstudyDuplicates="SELECT * FROM ".$prefix."submission where status='Approved' order by id desc";
$QuerystudyDuplicates = $mysqli->query($sqlstudyDuplicates);
$totalDuplicates = $QuerystudyDuplicates->num_rows;
$rstudyDuplicats = $sqlstudyDuplicates->fetch_array();
if($totalDuplicates){//duplicates
	echo "suspected";
}*/
?>         <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid" style="padding-bottom:12px;">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>All Protocols</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 40px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $totalstudySubmitted;?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><span>Pending Submission</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 40px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $totalstudyPending;?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><span>Scheduled for Review</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 40px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $totalstudyassignedto;?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-check"></i></div>
                    <div class="title"><span>Approved Protocols</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 40px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $totalstudyApproved;?></strong></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Dashboard Header Section    -->