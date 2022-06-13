<div class="card-header d-flex align-items-center">
                      <h3 class="h4">General Statistics </h3>
</div>
<?php

$sqlstudyWaivedPayent="SELECT * FROM ".$prefix."submission where is_sent='1' and paymentStatus='Payment Waiver' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyWaivedPayent = $mysqli->query($sqlstudyWaivedPayent);
$totalstudyWaivedPayent = $QuerystudyWaivedPayent->num_rows;

 $sqlstudyReviewPendingPayement="SELECT * FROM ".$prefix."submission where is_sent='1' and paymentStatus='Review Pending Payment' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyReviewPendingPayement = $mysqli->query($sqlstudyReviewPendingPayement);
$totalstudyReviewPendingPayement = $QuerystudyReviewPendingPayement->num_rows;

 $sqlstudyNotPaid="SELECT * FROM ".$prefix."submission where is_sent='1' and paymentStatus='Not Paid' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyNotPaid = $mysqli->query($sqlstudyNotPaid);
$totalstudyNotPaid = $QuerystudyNotPaid->num_rows;

 $sqlstudyPaid="SELECT * FROM ".$prefix."submission where is_sent='1' and paymentStatus='Paid' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyPaid = $mysqli->query($sqlstudyPaid);
$totalstudyPaid = $QuerystudyPaid->num_rows;
?> 
<div class="col-mm9 halfgraph1">
<h4>Submissions by Payments</h4> 
<!--Paid,-->

<canvas id="myChart" width="200" height="200"></canvas>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Waived Payment', 'Review Pending Payement', 'Not Paid', 'Paid'],
        datasets: [{
            label: 'Payments',
            data: [<?php echo $totalstudyWaivedPayent;?>, <?php echo $totalstudyReviewPendingPayement;?>, <?php echo $totalstudyNotPaid;?>, <?php echo $totalstudyPaid;?>],
            backgroundColor: [
                'rgba(239, 76, 76, 0.9)',
                'rgba(239, 76, 76, 0.6)',
                'rgba(239, 76, 76, 0.4)'
            ],
            borderColor: [
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)'
            ],
            borderWidth: 0
        }]
    },
    /*options: {F4516C
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }*/
});
</script>




</div>





<div class="col-mm9 halfgraph2">
<h4>Submissions by Trials</h4> 

<?php

$sqlstudyClinicalTrial="SELECT * FROM ".$prefix."submission where is_clinical_trial='1' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyClinicalTrial = $mysqli->query($sqlstudyClinicalTrial);
$totalstudyClinicalTrial = $QuerystudyClinicalTrial->num_rows;

$sqlstudyNonClinicalTrial="SELECT * FROM ".$prefix."submission where is_clinical_trial='0' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyNonClinicalTrial = $mysqli->query($sqlstudyNonClinicalTrial);
$totalstudyNonClinicalTrial = $QuerystudyNonClinicalTrial->num_rows;

$sqlstudyDrugRelated="SELECT * FROM ".$prefix."submission where drug_related_clinical_trial='Yes' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyDrugRelated = $mysqli->query($sqlstudyDrugRelated);
$totalstudyDrugRelated = $QuerystudyDrugRelated->num_rows;

//Clinical, NonClinical, Drug related
?> 

<canvas id="myChart2" width="200" height="200"></canvas>
<script>
var ctx = document.getElementById('myChart2');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Clinical Trial Submissions', 'Non Clinical Trial Submissions', 'Drug Related Submissions'],
        datasets: [{
            label: 'Clinical Trials',
            data: [<?php echo $totalstudyClinicalTrial;?>, <?php echo $totalstudyNonClinicalTrial;?>, <?php echo $totalstudyDrugRelated;?>],
            backgroundColor: [
                'rgba(239, 76, 76, 0.9)',
                'rgba(239, 76, 76, 0.6)',
                'rgba(239, 76, 76, 0.4)'
            ],
            borderColor: [
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)'
            ],
            borderWidth: 0
        }]
    },
    /*options: {F4516C
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }*/
});
</script>












</div>




<div style="clear:both;"></div>


<div class="col-mm9 halfgraph1">

<h4>Submissions by Status</h4> 
<?php
$sqlstudyFlagged="SELECT * FROM ".$prefix."submission where is_sent='1' and status='Rejected' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyFlagged = $mysqli->query($sqlstudyFlagged);
$totalstudyFlagged = $QuerystudyFlagged->num_rows;

$sqlstudyHalted="SELECT * FROM ".$prefix."submission where is_sent='1' and recruitment_status_id='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyHalted = $mysqli->query($sqlstudyHalted);
$totalstudyHalted = $QuerystudyHalted->num_rows;

$sqlstudyRejected="SELECT * FROM ".$prefix."submission where is_sent='1' and status='Rejected' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyRejected = $mysqli->query($sqlstudyRejected);
$totalstudyRejected = $QuerystudyRejected->num_rows;

$sqlstudyPending="SELECT * FROM ".$prefix."submission where is_sent='1' and status='Waiting for Committee' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyPending = $mysqli->query($sqlstudyPending);
$totalstudyPending = $QuerystudyPending->num_rows;

$sqlstudyScheduled="SELECT * FROM ".$prefix."submission where is_sent='1' and status='Scheduled for Review' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyScheduled = $mysqli->query($sqlstudyScheduled);
$totalstudyScheduled = $QuerystudyScheduled->num_rows;

$sqlstudyApproved="SELECT * FROM ".$prefix."submission where is_sent='1' and status='Approved' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyApproved = $mysqli->query($sqlstudyApproved);
$totalstudyApproved = $QuerystudyApproved->num_rows;

?>
<!--Paid,-->

<canvas id="myChart3" width="200" height="200"></canvas>
<script>
var ctx = document.getElementById('myChart3');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Flagged', 'Halted', 'Rejected', 'Pending', 'Scheduled', 'Approved'],
        datasets: [{
            label: 'Submissions',
            data: [<?php echo $totalstudyFlagged;?>, <?php echo $totalstudyHalted;?>, <?php echo $totalstudyRejected;?>, <?php echo $totalstudyPending;?>, <?php echo $totalstudyScheduled;?>, <?php echo $totalstudyApproved;?>],
            backgroundColor: [
                'rgba(239, 76, 76, 0.9)',
                'rgba(239, 76, 76, 0.6)',
                'rgba(239, 76, 76, 0.4)',
				 'rgba(239, 76, 76, 0.9)',
                'rgba(239, 76, 76, 0.6)',
                'rgba(239, 76, 76, 0.4)'
            ],
            borderColor: [
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)',
				  'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)',
                'rgba(239, 76, 76, 1)'
            ],
            borderWidth: 0
        }]
    },
    /*options: {F4516C
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }*/
});
</script>




</div>





<div class="col-mm9 halfgraph3">
<h4>Submissions by Category of Resarch</h4> 

<?php
//////////////Medical and Health Sciences/////////////////////////////////////////////
$sqlstudyCategory1="SELECT * FROM ".$prefix."submission where clinical_trial_type='1' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyCategory1 = $mysqli->query($sqlstudyCategory1);
$totalstudyCategory1 = $QuerystudyCategory1->num_rows;
//////////////////////////////////////////////////////////////////Social Science///////////////////
$sqlstudyCategory2="SELECT * FROM ".$prefix."submission where clinical_trial_type='2' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyCategory2 = $mysqli->query($sqlstudyCategory2);
$totalstudyCategory2 = $QuerystudyCategory2->num_rows;
/////////////////////////////////////////////////////////////Natural Sciences////////////////////////
$sqlstudyCategory3="SELECT * FROM ".$prefix."submission where clinical_trial_type='3' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyCategory3 = $mysqli->query($sqlstudyCategory3);
$totalstudyCategory3 = $QuerystudyCategory3->num_rows;
//////////////////////////////////////////////////Agricultural Sciences///////////////////////////////////
$sqlstudyCategory4="SELECT * FROM ".$prefix."submission where clinical_trial_type='5' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyCategory4 = $mysqli->query($sqlstudyCategory4);
$totalstudyCategory4 = $QuerystudyCategory4->num_rows;
////////////////////////////////////////////////////////Engineering and Technology/////////////////////////////
$sqlstudyCategory5="SELECT * FROM ".$prefix."submission where clinical_trial_type='6' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyCategory5 = $mysqli->query($sqlstudyCategory5);
$totalstudyCategory5 = $QuerystudyCategory5->num_rows;
/////////////////////////////////////////////////Humanities////////////////////////////////////
$sqlstudyCategory6="SELECT * FROM ".$prefix."submission where clinical_trial_type='9' and is_sent='1' and recAffiliated_id='$recAffiliated_id' order by id desc";
$QuerystudyCategory6 = $mysqli->query($sqlstudyCategory6);
$totalstudyCategory6 = $QuerystudyCategory6->num_rows;
/////////////////////////////////////////////////////////////////////////////////////

//Clinical, NonClinical, Drug related
?> 

<canvas id="myChart4" width="200" height="200"></canvas>
<script>
var ctx = document.getElementById('myChart4');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['HS', 'SS', 'NS', 'AS', 'SIR', 'H'],
        datasets: [{
            label: 'Category of Resarch',
            data: [<?php echo $totalstudyCategory1;?>, <?php echo $totalstudyCategory2;?>, <?php echo $totalstudyCategory3;?>, <?php echo $totalstudyCategory4;?>, <?php echo $totalstudyCategory5;?>, <?php echo $totalstudyCategory6;?>],
            backgroundColor: [
                'rgba(81, 59, 247, 1)',
                'rgba(255, 115, 0, 1)',
                'rgba(221, 0, 255, 1)',
                'rgba(64, 255, 0, 1)',
                'rgba(255, 0, 183, 1)',
                'rgba(0, 234, 255, 1)'
            ],
            borderColor: [
                'rgba(81, 59, 247, 1)',
                'rgba(255, 115, 0, 1)',
                'rgba(221, 0, 255, 1)',
                'rgba(64, 255, 0, 1)',
                'rgba(255, 0, 183, 1)',
                'rgba(0, 234, 255, 1)'
            ],
            borderWidth: 0
        }]
    },
    /*options: {F4516C
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }*/
});
</script>

<span style="color:#513bf7;">HS</span> - Medical and Health Sciences<br />
<span style="color:#ff7300;">SS</span> - Social Science<br />
<span style="color:#dd00ff;">NS</span> - Natural Sciences<br />
<span style="color:#40ff00;">AS</span> - Agricultural Sciences<br />
<span style="color:#ff00b7;">SIR</span> - Engineering and Technology<br />
<span style="color:#00eaff;">H </span>- Humanities










</div>
<div style="clear:both;"></div>