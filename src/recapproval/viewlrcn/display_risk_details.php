<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='No Greater than Minimal Risk'){
?>

<label class="col-sm-12 form-control-label">
"Minimal Risk" means that the probability and magnitude of harm or discomfort anticipated in the research are not greater than those ordinarily encountered in daily life or during the performance of routine physical and psychological examinations or tests and where confidentiality is adequately protected. This category includes protocols that pose "no greater than minimal risk" according to federal regulations. <b style="font-weight:bold;">Requires Minimal Intensity Monitoring</b>.

</label>
<?php }

if($country=='Minor Increase over Minimal Risk'){
?>

<label class="col-sm-12 form-control-label">
Research involves a minor increase over minimal risk. There is medium to high probability of the occurrence of a low-severity event that is completely reversible (e.g., headache from lumbar puncture) or the likelihood of serious harm occurring is low (e.g., fatal anaphylaxis from allergy skin testing). <b style="font-weight:bold;">Requires Low Intensity Monitoring</b>.

</label>
<?php }

if($country=='Moderate Risk'){
?>

<label class="col-sm-12 form-control-label">
Risks are recognized as being greater than minimal, but are not considered high. There is a medium to high probability of a moderate-severity event occurring as a result of study participation (e.g., reversible worsening of a non-fatal disease such as seasonal allergy while receiving placebo or pneumonia from a bronchoscopy), but there is adequate surveillance and protections to identify adverse events promptly and to minimize their effects. <b style="font-weight:bold;">Requires Moderate Intensity Monitoring</b>

</label>
<?php }

if($country=='High Risk'){
?>

<label class="col-sm-12 form-control-label">
The study risk is greater than a moderate risk study due to the increased probability for generating serious adverse events. There is a high probability of an event that is serious and prolonged or permanent<br />
occurring as a result of study participation. In situations where there is the prospect of direct benefit to the subject, study risks are high or there is significant uncertainty about the nature or likelihood of adverse events.  <b style="font-weight:bold;">Requires
High Intensity Monitoring.</b>

</label>
<?php }
?>