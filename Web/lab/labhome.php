<?php
include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();
$labTests = $dd->getLabTests($_SESSION['officeid']);
$objLength = count($labTests);
//echo "<pre>"; print_r($_SESSION); echo "</pre>";
?>
<div class="col-md-12">
	<section class="col col-md-4">
		<div class="panel panel-orange" id="reportssearchpanel">
			<div class="panel-heading">
				<h3 class="panel-title">Lab Tests</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					  
					<table class="table table-striped" id="lab_test_results_table">
		                 <tbody></tbody> 
            		</table>
            <div class="paging-container" id="tablePaging"></div>
					      		
				</div>
			</div>
	   </div> 
	</section>
	    
	<section class="col col-md-8">
		    <div class="panel panel-orange  sky-form">
				<div class="panel-heading">
		        	<h3 class="panel-title"><i class="fa fa-tasks"></i>Patients List</h3>
				</div>
			    <table class="table table-bordered table-hover" id="patient_records_reports_table">
			    	<thead>
			        	<tr>
			            	<th>AID</th>
			                <th>Patient Name</th>
			                <th>Doctor Name</th>
			                <th>Date</th>
			                <th>Time</th>
			                <th>Actions</th>
						</tr>
					</thead>
			        <tbody id="labtestPatientList"></tbody>
				</table>
			</div>
	 </section>
 </div>
 
 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($labTests) ?>;
		var officeId = <?php echo $_SESSION['officeid'];?>;
			for (var i = 0; i < objLength; i++) {
				$('#lab_test_results_table tbody').append('<tr class="data"><td id="doctorName_'+labDataObj[i].id+'"><a href="javascript:showLabTestsPateients('+labDataObj[i].id+','+officeId+')">'+labDataObj[i].testname+'</a></td></tr>');
			}
			
			load = function() {
				window.tp = new Pagination('#tablePaging', {
					itemsCount: objLength,
					onPageSizeChange: function (ps) {
						console.log('changed to ' + ps);
					},
					onPageChange: function (paging) {
						//custom paging logic here
						console.log(paging);
						var start = paging.pageSize * (paging.currentPage - 1),
							end = start + paging.pageSize,
							$rows = $('#lab_test_results_table tbody').find('.data');

						$rows.hide();

						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
				});
			}

		load();
	});
</script>