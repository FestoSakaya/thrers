 <?php
 $sqlstudyPending="SELECT * FROM ".$prefix."submission where is_sent='0' and is_clinical_trial='1' order by id desc";
$QuerystudyPending = $mysqli->query($sqlstudyPending);
$totalstudyPending = $QuerystudyPending->num_rows;

 $sqlstudyassignedto="SELECT * FROM ".$prefix."submission where status='Scheduled for Review' and is_clinical_trial='1' order by id desc";
$Querystudyassignedto = $mysqli->query($sqlstudyassignedto);
$totalstudyassignedto = $Querystudyassignedto->num_rows;

$sqlstudySubmitted="SELECT * FROM ".$prefix."submission where is_sent='1' and is_clinical_trial='1' order by id desc";
$QuerystudySubmitted = $mysqli->query($sqlstudySubmitted);
$totalstudySubmitted = $QuerystudySubmitted->num_rows;
$rstudySubmitted = $QuerystudySubmitted->fetch_array();

 $sqlstudyApproved="SELECT * FROM ".$prefix."submission where status='Approved' and is_clinical_trial='1' order by id desc";
$QuerystudyApproved = $mysqli->query($sqlstudyApproved);
$totalstudyApproved = $QuerystudyApproved->num_rows;

?>         <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid" style="padding-bottom:12px;">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>Submitted Protocols</span>
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