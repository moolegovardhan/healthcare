<?php
//session_start();
include_once ('../../Business/DiagnosticData.php');


$dd = new DiagnosticData();
if( isset( $_SESSION['userid'] ) )
   {
      $userId = $_SESSION['userid']; 
      $labDataDetails = $dd->getUnMapTestData();
      
    }
	$objLength = count((array)$labDataDetails);
	//var_dump($labData);
?> 
        
<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" id="userId">
<input type="hidden" value="<?php echo $_SESSION['officeid']; ?>" id="officeId">
<div class="col-md-12">  
    <fieldset>
        <section class="col col-md-3">
        <!-- Added below code by achyuth for getting the Tests with Test Name Sep072015 -->
	    <div class="panel-body"> 
	       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
	         <fieldset>
	            <div class="row">
	                <section class="col">
	                    <label class="input">
	                      <input type="text" id="testName"  placeholder="Test Name">
	                    </label>
	                    <i><font color="red"><span id="testName"></span></font></i>
	                </section>
	                <section class="col">
						<input type="button" class="btn-u pull-right"  name="button" id="searchTest" value="Search"/>
	                </section>
	            </div>
	         </fieldset> 
	         </form>
	     </div>
        <!-- End of achyuth's code Sep072015  -->
        </section>
        <section class="col col-md-9">
            
                <button data-dismiss="modal" class="btn-u btn-u-orange pull-right" type="button" onclick="linkTestLab()" >Link to Lab</button>
            <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Tests</h5>
            </div>
            
            <table class="table table-striped" id="testsdata">
          <tr>
                        <th></th>
                        <th>Test ID</th>
                        <th>Test Name</th>
                        <th>Department</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
            <tbody></tbody>
        </table>
        <div class="paging-container" id="tablePaging"> </div>
        </div> 
      </section>
   </fieldset>  
    
    
    <div class="modal fade" id="myTestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Test Details</h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                        <table class="table table-striped" id="PatientReportTable">
                            <thead>
                                <tr>
                                    <th>Parameter Name</th>
                                    <th>Biological References</th> 
                                    <th>Units</th> 
                                    <th>Comments</th> 
                                    <th>Additional Inputs</th> 
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
    
</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($labDataDetails) ?>;
			for (var i = 0; i < objLength; i++) {
				$('#testsdata').append('<tr class="data"><td><input type="checkbox" name="1" id="'+labDataObj[i].id+'" class="link-test"/></td><td>000'+labDataObj[i].id+'</td><td>'+labDataObj[i].testname+'</td><td>'+labDataObj[i].departmentname+'</td><td><a href="#" onclick="showTestDetails('+labDataObj[i].id+')">Details</a></td><td><a href="labindex.php?page=newwlab&testId='+labDataObj[i].id+'&type=copy" >Copy and Create New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="labindex.php?page=newwlab&testId='+labDataObj[i].id+'&type=edit" >Edit</a></td></tr>');
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
							$rows = $('#testsdata').find('.data');

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