<?php
  include_once '../../Business/MasterData.php';
$diagdiscdata = $md->getLabDiscountData();
$medicaldiscdata = $md->getMedicalShopDiscountData();


?>

<div class="col-md-12">
        <!-- Accordion v1 -->                
        <div class="panel-group acc-v1" id="accordion-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-One">
                            Diagnostics Discount
                        </a>
                         
                    </h4>
                </div>
                <div id="collapse-One" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <form action="../../Business/DiscountDataUpdation.php" method="POST">
   
                                <fieldset>
                                   <div class="row">
                                       <section class="col-md-1"></section>
                                       <section class="col-md-12">
                                               <div class="panel panel-orange margin-bottom-40">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><i class="fa fa-edit"></i>Diagnostics List
                                                      <input type="submit" value=" Submit " class="btn-u btn-u-primary pull-right" id=""/>
                                                    </h3>
                                                </div>

                                                 <table class="table table-striped" id="admin_cgs_diag_discounts">
                                                            <thead>
                                                                <tr>
                                                                    
                                                                    <th width="5%"></th>
                                                                    <th>Diagnostics Name</th>
                                                                    <th width="25%">Address</th>
                                                                     <th width="15%">LAB Discount (%) </th>
                                                                       <th width="15%">CGS Discount (%) </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <div class="paging-container" id="tablePaging"></div>
                                             </div>
                                       </section> 
                                        <section class="col-md-1"></section>  
                                    </div>   
                                 </fieldset> 

                            <input type="hidden" name="recordcount" id="recordcount" />
                            </form>   
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-Two">
                            Medical Shop Discount
                        </a>
                         
                    </h4>
                </div>
                <div id="collapse-Two" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <form action="../../Business/MedicalDiscountDataUpdation.php" method="POST">
   
                                <fieldset>
                                   <div class="row">
                                       <section class="col-md-1"></section>
                                       <section class="col-md-12">
                                               <div class="panel panel-orange margin-bottom-40">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><i class="fa fa-edit"></i>Medical Shop List
                                                      <input type="submit" value=" Submit " class="btn-u btn-u-primary pull-right" id=""/>
                                                    </h3>
                                                </div>

                                                 <table class="table table-striped" id="admin_cgs_shop_discounts">
                                                            <thead>
                                                                <tr>
                                                                    
                                                                    <th width="5%"></th>
                                                                    <th>Medical Shop Name</th>
                                                                    <th width="25%">Address</th>
                                                                     <th width="15%">Shop Discount (%) </th>
                                                                       <th width="15%">CGS Discount (%) </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <div class="paging-container" id="tableMedicalPaging"></div>
                                             </div>
                                       </section> 
                                        <section class="col-md-1"></section>  
                                    </div>   
                                 </fieldset> 

                            <input type="hidden" name="medicalrecordcount" id="medicalrecordcount" />
                            </form>   
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- End Accordion v1 -->                
</div>
<div class="margin-bottom-60"></div>
                
<?php $objLength = count($diagdiscdata);

$objMedicalLength = count($medicaldiscdata);

?>
 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var masterUsersData = <?php echo json_encode($diagdiscdata) ?>;
                $('#recordcount').val(objLength);
			for (var i = 0; i < objLength; i++) {
                              checkName = "diag"+i;
                              console.log("Hospital Name : ".checkName);
                            
				$('#admin_cgs_diag_discounts tbody').append('<tr class="data"><td><input type="checkbox" name="'+checkName+'" value='+masterUsersData[i].id+'></td><td>'+masterUsersData[i].diagnosticsname+'</td><td>'+masterUsersData[i].haddress+
                		'</td><td><input type="textbox" name="discvalue'+i+'" value='+masterUsersData[i].discpercent+' size="5"></td>\n\
                    <td><input type="textbox" name="cgsdiscount'+i+'" value='+masterUsersData[i].cgsdiscount+' size="5"></td></tr>');
           
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
							$rows = $('#admin_cgs_diag_discounts tbody').find('.data');

						$rows.hide();

						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
				});
			}

		
		var objMedicalLength = "<?php echo $objMedicalLength ?>";
		var masterMedicalUsersData = <?php echo json_encode($medicaldiscdata) ?>;
                $('#medicalrecordcount').val(objMedicalLength);
			for (var i = 0; i < objMedicalLength; i++) {
                              checkName = "shop"+i;
                              console.log("Medical Shop Name : ".masterMedicalUsersData);
                            
				$('#admin_cgs_shop_discounts tbody').append('<tr class="data"><td><input type="checkbox" name="'+checkName+'" \n\
                        value='+masterMedicalUsersData[i].id+'></td><td>'+masterMedicalUsersData[i].shopname+'</td><td>'+masterMedicalUsersData[i].haddress+
                		'</td><td><input type="textbox" name="medicaldiscvalue'+i+'" value='+masterMedicalUsersData[i].discpercent+' size="5"></td>\n\
                    <td><input type="textbox" name="medicalcgsdiscount'+i+'" value='+masterMedicalUsersData[i].cgsdiscount+' size="5"></td></tr>');
           
				}
			
			load = function() {
				window.tp = new Pagination('#tableMedicalPaging', {
					itemsCount: objLength,
					onPageSizeChange: function (ps) {
						console.log('changed to ' + ps);
					},
					onPageChange: function (paging) {
						//custom paging logic here
						console.log(paging);
						var start = paging.pageSize * (paging.currentPage - 1),
							end = start + paging.pageSize,
							$rows = $('#admin_cgs_shop_discounts tbody').find('.data');

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

                