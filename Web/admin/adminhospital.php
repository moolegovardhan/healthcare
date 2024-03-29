
<div class="col-md-12">
 <div class="col-md-10 pull-right" id="adminHospitalErrorBlock">
     <div class="row">
         <center>
             <i>
                  <div class="alert alert-info fade in"><span id="adminHospitalErrorMessage"></span></div>
             </i>
         </center>
     </div>
 </div>     
    <div class="row margin-bottom-40">
         <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i>Create Hospital</h3>
             </div>
             <div class="panel-body"> 
              <form action="" id="sky-form" class="sky-form">
                 <div class="col-md-12">  
                    <fieldset>
                       <div class="row">
                            <label class="label col col-2">Hospital Name</label>
                            <section class="col col-4">
                                <label class="input">
                                     <input type="text" id="adminhosiptalname" placeholder="Name"/>
                                  </label>
                            </section>
                            <button type="button" class="btn-u"  name="button" id="getStaffHosiptal" > Search </button>
                            <button type="button" class="btn-u pull-right"  name="button" id="addHosiptal" ><span class="glyphicon glyphicon-plus"></span> Add Hospital </button>
                        </div>        
                     </fieldset>  
                    <fieldset>
                       <div class="row">
                       <div class="row">
                           <section class="col col-md-12">
	                           <div class="panel panel-orange margin-bottom-40">
	                            <div class="panel-heading">
	                                <h3 class="panel-title"><i class="fa fa-edit"></i>Hospital List</h3>
	                            </div>
	                            
	                             <table class="table table-striped" id="staff_hosiptal_NonActive_data">
		                                <thead>
		                                    <tr>
		                                        <th>#</th>
		                                        <th>Hospital Name</th>
		                                        <th>Mobile</th>
		                                        <th>Email</th>
		                                        <th>Address</th>
		                                        <th>District</th>
		                                        <th>City</th>
		                                        <th>State</th>
		                                        <th>Zip Code</th>
		                                        <th>Edit</th>
		                                    </tr>
		                                </thead>
		                                <tbody></tbody>
		                            </table>
		                            <div class="paging-container" id="tablePaging"></div>
	                         </div>
                           </section> 
                       </div>      
                    
                           
                        </div>     
                        
                     </fieldset> 
                   
                 </div>
                 </form>  
             </div>     
        </div>
     </div>
</div>    
    
    
</div>


<!-- Edit Hospital Edit Form Start -->
<div class="modal fade" id="editHospitalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title myModalLabel">Edit Diagnostics</h4>
            </div>
            <div class="modal-body">
            
            <section class="col col-8">
                        <div class="col-md-15">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Hospital Data</h3>
                                
                            </div>
                            
     <form  id="profile-form" action="." method="post">

          <div class="col-md-6 sky-form">
                <fieldset>
                    <input type="hidden" id="hosiptalid" />
                         <section>
                             <label class="checkbox"> 
                                <input type="checkbox" id="clinic"  name="clinic">
                                <i class="rounded-4x"></i>Is this a Single doctor clinic 
                              </label> 
                          </section>
                          <section>
                              <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                   <input type="text" id="name"  placeholder="Hospital Name">
                              </label>
                               <font><i><span id="nameerrormsg"></span></i></font>  
                          </section>

                          <section>
                              <label class="input">
                                  <i class="icon-append fa fa-phone"></i>
                                  <input type="mobile" id="mobile"  placeholder="Mobile #"  maxlength="10">
                              </label>
                                <font><i><span id="mobileerrormsg"></span></i></font>   
                          </section>
                        
                          <section>
                              <label class="input">
                                  <i class="icon-append fa fa-phone"></i>
                                  <input type="mobile" id="landline"  placeholder="Landline #"  maxlength="10">
                              </label>
                               <font><i><span id="landlineerrormsg"></span></i></font>  
                          </section>
                          
                          <section>
                            <label class="input">
                                  <i class="icon-append fa fa-envelope-o"></i>
                                  <input type="email" id="email" placeholder="Eail Id">
                               
                              </label>
                               <font><i><span id="emailerrormsg"></span></i></font>  
                          </section>


                          <section>
                            <label class="input">
                                  <i class="icon-append fa fa-envelope-o"></i>
                                  <input type="text" id="address1" placeholder="Address Line 1">
                               
                              </label>
                               <font><i><span id="address1errormsg"></span></i></font>  
                          </section>
 


                  </fieldset>

          </div>     

                        <!-- end of Personal Form -->
                             
                        <!-- Health Form -->
                                 
     <div class="col-md-6 sky-form">
               <fieldset>
                    <section>
                     <label class="input">
                           <i class="icon-append fa fa-envelope-o"></i>
                           <input type="text" id="address2" placeholder="Address Line 2">

                       </label>
                         <font><i><span id="address2errormsg"></span></i></font>  
                   </section>

                   
                   
                    <section>
                      <label class="input">
                          <i class="icon-append fa fa-envelope-o"></i>
                          <input type="text" id="district"  placeholder="District">
                      </label>
                         <font><i><span id="districterrormsg"></span></i></font>  
                  </section>               
                    <section>
                        <label class="input">
                            <i class="icon-append fa fa-envelope-o"></i>
                             <input type="text" id="city"  placeholder="City">
                        </label>
                         <font><i><span id="cityerrormsg"></span></i></font>  
                    </section>              
              <section>
                  <label class="input">
                      <i class="icon-append fa fa-envelope-o"></i>
                      <input type="text" id="state"  placeholder="State">
                  </label>
                   <font><i><span id="stateerrormsg"></span></i></font>  
              </section>

            <section>
             <label class="input">
                  <i class="icon-append fa fa-envelope-o"></i>
                  <input type="text" id="zipcode"  placeholder="Zip Code" maxlength="6">
              </label>
                 <font><i><span id="zipcodeerrormsg"></span></i></font>  
            </section>
                   <section class="input">
                       <br/>
                   </section>

      </fieldset>
     </div> 
     </form> 
     </div>
      </div>    
       </section>
            
       		</div>
       <div class="modal-footer">
       	<button type="button" class="btn-u pull-right"  name="button" id="btnStaffSubmitHospital">Save Data</button>
       </div>
    </div>
 </div>
</div>
 <!-- Edit Hospital Edit Form Start -->
 
 <?php $objLength = count($hospitalData);?>
 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var masterUsersData = <?php echo json_encode($hospitalData) ?>;
			for (var i = 0; i < objLength; i++) {
				$('#staff_hosiptal_NonActive_data tbody').append('<tr class="data"><td>'+(i+1)+'</td><td>'+masterUsersData[i].hosiptalname+
                		'</td><td>'+masterUsersData[i].mobile+'</td><td>'+masterUsersData[i].email+'</td><td>'+masterUsersData[i].haddress+
                		'</td><td>'+masterUsersData[i].district+'</td><td>'+masterUsersData[i].city+'</td><td>'+masterUsersData[i].state+
                		'</td><td>'+masterUsersData[i].zipcode+'</td><td><button type="button" class="btn btn-warning btn-xs" onclick="showHosiptalData('+masterUsersData[i].id+')"><span class="glyphicon glyphicon-edit"></span> Edit</button></td></tr>');
           
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
							$rows = $('#staff_hosiptal_NonActive_data tbody').find('.data');

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