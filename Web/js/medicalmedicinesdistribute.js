/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){ 
  
  $('#listofpatients').hide();
   $('#listofmedicines').hide();
  
  $('#searchPrescription').click(function(){
        
        if(validateSearchForm()){
            
            if($('#patientName').val() == ""){
                patientname = "nodata";
            } else
                patientname = $('#patientName').val();
            if($('#patientID').val() == ""){
                 patientid = "nodata";
            }else
                patientid =$('#patientID').val();
            if($('#appointmentID').val() == ""){
                 appid = "nodata";
            }else{
                appid = $('#appointmentID').val(); 
            }
            if($('#mobile').val() == ""){
                 mobile = "nodata";
            }else
                mobile = $('#mobile').val();
            
            
          console.log(rootURL + '/fetchPaidPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile);  
            $.ajax({
                type: 'GET',
                url: rootURL + '/fetchPaidPrescription/' + patientname +'/'+patientid +'/'+appid+'/'+mobile,
                dataType: "json",
                success: function(data){
                    console.log('authentic : ' + data)
                    $('#patient_consultation_records_search_result_table tbody').html('');
                    var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                    //$("#patient_consultation_records_search_result_table tbody").remove();
                    	var objLength = '';
                        console.log("Data List Length "+list.length);
                        $.each(list, function(index, responseMessageDetails) {

                             if(responseMessageDetails.status == "Success"){
                                  //$('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                                    //$('#adminStaffErrorBlock').show();
                                    userData = responseMessageDetails.data;
                                     console.log("userData : "+userData.length);
                                     objLength = userData.length;
                                     var trHTML = "";
                                     $.each(userData, function(index, userDetails) {
                                          var btst = "";
                                        s = userDetails.id;
                                        s = s.replace(/^0+/, '');
									 datatopass = userDetails.PatientId+"$"+userDetails.appointmentid+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName+"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId;  
									  console.log("datatopass : "+datatopass);    
									  console.log("index........"+(index < 1));
									  if(index < 1 && patientid != "nodata")
									  btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
									  else{
									      if(patientid != "nodata")
									         btst = "   ";
									      else
									          btst ='<font color="blue"><i><a href="#" onclick=showDetails("'+escape(datatopass)+'")>Enter Details</a></i></font>';
									  
									  }    
									  
					
									  $('#patient_consultation_records_search_result_table tbody').append('<tr class="data"><td>' + userDetails.appointmentid + '</td><td>' + userDetails.PatientName   +'</td><td>' + userDetails.HospitalName  + 
				                               '</td><td>' + userDetails.DoctorName + '</td><td>' + userDetails.AppointementDate  + '</td><td>' + userDetails.AppointmentTime
				                               + '</td><td>'+btst+'</td></tr>');
                                     
                                        
                                      // console.log("Patient Name : "+userDetails.PatientName); 
                                        $('#prespatientName').html(userDetails.PatientName);
                                        $('#doctorName').html(userDetails.DoctorName);
                                        $('#hospitalName').html(userDetails.HospitalName);
                                        $('#appointmentDate').html(userDetails.AppointementDate);
                                     // console.log("Pavan Kumar");
                                         $('#hidpatientName').val(userDetails.PatientName);  
                                         $('#hiddoctorName').val(userDetails.DoctorName);
                                         $('#hidhospitalName').val(userDetails.HospitalName);
                                         $('#hidappointmentDate').val(userDetails.AppointementDate);
                                         $('#hidappointmentId').val(userDetails.id);
                                         $('#hidpatientID').val(userDetails.patientid);
                                           
                                          
                                    });    
                                        //$('#patient_consultation_records_search_result_table').append(trHTML);
                                        //$('#patient_consultation_records_search_result_table').load();
                                     
                                     $('#tablePaging').show();
                    				 /* Pagination Code Start */
                    				 load = function() {
                    					window.tp = new Pagination('#tablePaging', {
                    					itemsCount: objLength,
                    					onPageSizeChange: function (ps) {
                    						console.log('changed to ' + ps);
                    					},
                    					onPageChange: function (paging) {
                    						//custom paging logic here
                    						//console.log(paging);
                    						var start = paging.pageSize * (paging.currentPage - 1),
                    							end = start + paging.pageSize,
                    							$rows = $('#patient_consultation_records_search_result_table tbody').find('.data');
                    	
                    						$rows.hide();
                    	
                    						for (var i = start; i < end; i++) {
                    							$rows.eq(i).show();
                    						}
                    					}
                    					});
                    				 /* Pagination Code End */
                    				 }
                    	
                    				 load();
                                        
                             } else{
                                   $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                                   $('#adminStaffErrorBlock').show();
                                   $('#patient_consultation_records_search_result_table tbody').html('<tr><td colspan="6" style="text-align:center;">No Data Found</td></tr>');
                  				   $('#tablePaging').hide();
                             }
                             
                     });   
                    
                }
            });    
        }
            
        
        $('#listofpatients').show();
        $('#listofmedicines').hide();
    });
   
   
   
     
}); 

function showDetails(data){
     datapass = (unescape(data).split("$"));    
     console.log("Data pass : : : : : : :"+(datapass));  
     $('#hiddenpatientName').val(datapass[5]);  
    $('#hiddendoctorName').val(datapass[4]);
     $('#hidhospitalName').val(datapass[3]);
     $('#hiddendoctorId').val(datapass[7]);
     $('#hidhospitalId').val(datapass[6]);
      $('#hidappointmentDate').val(datapass[2]);
      $('#hidappointmentId').val(datapass[1]);
      $('#hiddenpatientId').val(datapass[0]);
      
            
    console.log(rootURL + '/fetchAppointmentSpecificPatientMedicines/' + datapass[1] );  
      $.ajax({
          type: 'GET',
          url: rootURL + '/fetchAppointmentSpecificPatientMedicines/' + datapass[1],
          dataType: "json",
          success: function(data){
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
            $("#patient_consultation_medicines_table tbody").remove();
            console.log("Data List Length "+list.length);
             $.each(list, function(index, responseMessageDetails) {
                  if(responseMessageDetails.status == "Success"){
                       // $('#medicalErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        //$('#adminStaffErrorBlock').show();
                        userData = responseMessageDetails.data;
                         var trHTML = "";
                        $.each(userData, function(index, userDetails) {
                            
                            console.log(index);
                        //MBF,MAF,ABF,AAF,EBF, EAF 
                        textname = "medicinedist"+index;
                        medicineid = "medicine"+index;
                        price = "medicineprice"+index;
                        console.log(userDetails.totalcount);
                        $('#patientname').val(userDetails.patientname);
                        passonvalue = userDetails.id+"$"+userDetails.totalcount+"$"+userDetails.patientid+"$"+userDetails.appointmentid+"$"+escape(userDetails.medicinename)+"$"+escape(userDetails.patientname);
                        btst = '<input type="text" size="3" name='+textname+' value='+userDetails.totalcount +'>'; 
                        hbtst = '<input type="hidden" size="3" name='+medicineid+' value='+passonvalue+'>'; 
                        pbtst = '<input type="text" size="5" name='+price+'>'; 
                            
                        trHTML += '<tr><td>' + userDetails.medicinename + '</td><td>' + userDetails.noofdays   +'</td><td>' + userDetails.dosage  + 
                      '</td><td>' + userDetails.MBF + '</td><td>' + userDetails.MAF  + '</td><td>' + userDetails.ABF
                      + '</td><td>' + userDetails.AAF  + '</td><td>' + userDetails.EBF  + '</td><td>' + userDetails.EAF  + '</td><td>' + userDetails.totalcount  + '</td><td>'+btst+'</td><td>'+pbtst+'</td><td>'+hbtst+'</td></tr>';  
                            
                            
                            
                            $('#hidcount').val(index);
                            
                        });
                         $('#patient_consultation_medicines_table').append(trHTML);
                         $('#patient_consultation_medicines_table').load();
                        
                  }
             });
             $('#listofpatients').hide();
                        $('#listofmedicines').show();
          }
      
    });  
    
 //   
}

