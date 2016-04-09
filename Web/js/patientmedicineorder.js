/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
//fetchMedicalShopPatientData

$('#fetchMedicalShopPatientData').click( function(){
    
    fetchMedicalShopOrders();
});

$('#searchfororders').click( function(){
    
    console.log($('#patientname').val());
    console.log($('#mobilenumber').val());
    console.log($('#start').val());
    console.log($('#finish').val());
    ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
    if($('#patientname').val() == ""){
      patientname ='nodata';  
    }else
        patientname = $('#patientname').val();
    if($('#mobilenumber').val() == ""){
      mobile ='nodata';  
    }else
        mobile = $('#mobilenumber').val();
    if($('#start').val() == ""){
      start ='nodata';  
    }else
        start = $('#start').val();
    if($('#finish').val() == ""){
      end ='nodata';  
    }else
        end = $('#finish').val();
   
   
    if(start != "nodata"){
        startdate1 = start.split(".");
        startdate = startdate1[2]+"-"+startdate1[1]+"-"+startdate1[0];
    }else
        startdate = "nodata";
    if(end != "nodata"){
        enddate1 = end.split(".");
        enddate = enddate1[2]+"-"+enddate1[1]+"-"+enddate1[0];
    }else
        enddate = "nodata";
    
    console.log(rootURL + '/fetchMedicinesOrderedPatientDetails/' + patientname +'/'+mobile+'/'+startdate+'/'+enddate);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchMedicinesOrderedPatientDetails/' + patientname +'/'+mobile+'/'+startdate+'/'+enddate,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_patient_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientcid = "";
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientcid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientcid != data.ID ));
                                 if(patientcid != data.ID ){
                                     console.log("In IF");
                                 link = "<font color='blue'><a href='#' onclick='callDetailsData("+data.ID+")'>Fetch Orders</a></font>";
                                 trHTML ="<tr><td>"+data.name+"</td><td>"+data.ID+"</td><td>"+data.doctorname+"</td><td>"+data.mobile+"</td>\n\
<td>"+data.address+"</td><td nowrap='true'>"+link+"</td></tr>";
                                       $('#patient_medicines_order_patient_table').append(trHTML);
                                        $('#patient_medicines_order_patient_table').load();
                                 }
                                 patientcid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_patient_table').append(trHTML);
                             $('#patient_medicines_order_patient_table').load();
                        }
                         
                    }
                });

                        
        }
    });   
    
});


$('#fetchAllMedicinesOrdered').click( function(){
    
    console.log($('#patientname').val());
    console.log($('#mobilenumber').val());
    console.log($('#start').val());
    console.log($('#finish').val());
    ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
    if($('#patientname').val() == ""){
      patientname ='nodata';  
    }else
        patientname = $('#patientname').val();
    if($('#mobilenumber').val() == ""){
      mobile ='nodata';  
    }else
        mobile = $('#mobilenumber').val();
    if($('#start').val() == ""){
      start ='nodata';  
    }else
        start = $('#start').val();
    if($('#finish').val() == ""){
      end ='nodata';  
    }else
        end = $('#finish').val();
   
   
    if(start != "nodata"){
        startdate1 = start.split(".");
        startdate = startdate1[2]+"-"+startdate1[1]+"-"+startdate1[0];
    }else
        startdate = "nodata";
    if(end != "nodata"){
        enddate1 = end.split(".");
        enddate = enddate1[2]+"-"+enddate1[1]+"-"+enddate1[0];
    }else
        enddate = "nodata";
    
    console.log(rootURL + '/fetchAllMedicinesOrdered/' + patientname +'/'+mobile+'/'+startdate+'/'+enddate);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchAllMedicinesOrdered/' + patientname +'/'+mobile+'/'+startdate+'/'+enddate,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_patient_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientcid = "";
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientcid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientcid != data.ID ));
                                 if(patientcid != data.ID ){
                                     console.log("In IF");
                                 link = "<font color='blue'><a href='#' onclick='callDetailsData("+data.ID+")'>Fetch Orders</a></font>";
                                 trHTML ="<tr><td>"+data.name+"</td><td>"+data.ID+"</td><td>"+data.doctorname+"</td><td>"+data.mobile+"</td>\n\
<td>"+data.medicalshopname+"</td><td>"+data.dispatchdate+"</td><td>"+data.status+"</td></tr>";
                                       $('#patient_medicines_order_patient_table').append(trHTML);
                                        $('#patient_medicines_order_patient_table').load();
                                 }
                                 patientcid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_patient_table').append(trHTML);
                             $('#patient_medicines_order_patient_table').load();
                        }
                         
                    }
                });

                        
        }
    });   
    
});





$('#assigntomedicalshop').click( function(){
    
    patientid = $('#patientoid').val();
    medicalshop = $('#medicalShop').val();
    medicalshopname = $('#medicalShop option:selected').text();
    console.log("patientid : "+patientid);
    console.log("medicalshop : "+medicalshop);
     console.log("medicalshopname : "+medicalshopname);
    
    var jsonData = JSON.stringify( {"patientid" : patientid,"medicalshopid" : medicalshop,"medicalshopname" : medicalshopname,"status" : "A" } );
    console.log(jsonData); 
    console.log(rootURL+'/updateMedicinesOrdered');
    $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL+'/updateMedicinesOrdered',
            dataType: "json",
            data:  jsonData,
            success: function(data){
            
                 console.log('authentic success: ' + data)
                 var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);

                        
                 clearValidationMessage();
                  $.each(list, function(index, responseMessageDetails) {
           
                        if(responseMessageDetails.status == "Success"){
                            $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#adminStaffErrorBlock').show();
                            
                        }   
                    });   

                
            }
        });   
    
});


$('#medicalShopSpecificOrder').click( function(){
         shopid = $('#officeid').val();   
     $.ajax({
        type: 'GET',
        url: rootURL + '/medicalShopSpecificOrder/' + shopid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_patient_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientcid = "";
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientcid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientcid != data.ID ));
                                 if(patientcid != data.ID ){
                                     console.log("In IF");
                                 link = "<font color='blue'><a href='#' onclick='callDetailsData("+data.ID+")'>Fetch Orders</a></font>";
                                 trHTML ="<tr><td>"+data.name+"</td><td>"+data.ID+"</td><td>"+data.doctorname+"</td><td>"+data.mobile+"</td>\n\
<td>"+data.address+"</td><td nowrap='true'>"+link+"</td></tr>";
                                       $('#patient_medicines_order_patient_table').append(trHTML);
                                        $('#patient_medicines_order_patient_table').load();
                                 }
                                 patientcid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_patient_table').append(trHTML);
                             $('#patient_medicines_order_patient_table').load();
                        }
                         
                    }
                });

                        
        }
    });  
});

});


function fetchMedicalShopOrders(){
   
    
    console.log($('#patientname').val());
    console.log($('#mobilenumber').val());
    console.log($('#start').val());
    console.log($('#finish').val());
    ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
    if($('#patientname').val() == ""){
      patientname ='nodata';  
    }else
        patientname = $('#patientname').val();
    if($('#mobilenumber').val() == ""){
      mobile ='nodata';  
    }else
        mobile = $('#mobilenumber').val();
    if($('#start').val() == ""){
      start ='nodata';  
    }else
        start = $('#start').val();
    if($('#finish').val() == ""){
      end ='nodata';  
    }else
        end = $('#finish').val();
   
   
    if(start != "nodata"){
        startdate1 = start.split(".");
        startdate = startdate1[2]+"-"+startdate1[1]+"-"+startdate1[0];
    }else
        startdate = "nodata";
    if(end != "nodata"){
        enddate1 = end.split(".");
        enddate = enddate1[2]+"-"+enddate1[1]+"-"+enddate1[0];
    }else
        enddate = "nodata";
    
    officeid = $('#officeid').val();
    console.log(officeid);
    console.log(rootURL + '/fetchMedicalShopPatientData/' + patientname +'/'+mobile+'/'+startdate+'/'+enddate+'/'+officeid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchMedicalShopPatientData/' + patientname +'/'+mobile+'/'+startdate+'/'+enddate+'/'+officeid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#medicines_orders tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            patientcid = "";
                             $.each(patientData, function(index, data) {
                                 console.log("patientcid"+patientcid);
                                 console.log("data.ID :"+data.ID);
                                 console.log((patientcid != data.ID ));
                                 if(patientcid != data.ID ){
                                     console.log("In IF");
                                 link = "<font color='blue'><a href='#' onclick='callMedicalShopOrderDetailsData("+data.ID+")'>Fetch Orders</a></font>";
                                 trHTML ="<tr><td>"+data.name+"</td><td>"+data.ID+"</td><td>"+data.doctorname+"</td><td>"+data.mobile+"</td>\n\
<td>"+data.address+"</td><td nowrap='true'>"+link+"</td></tr>";
                                       $('#medicines_orders').append(trHTML);
                                        $('#medicines_orders').load();
                                 }
                                 patientcid = data.ID; 
                               
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#medicines_orders').append(trHTML);
                             $('#medicines_orders').load();
                        }
                         
                    }
                });

                        
        }
    });   

}

function callDetailsData(orderid){
    console.log(rootURL + '/fetchMedicinesOrdered/' + orderid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchMedicinesOrdered/' + orderid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                             $.each(patientData, function(index, data) {
                                 link = "<font color='blue'><a href='#' onclick='callDetailsData("+data.id+")'>Fetch Orders</a></font>";
                                 trHTML ="<tr><td>"+data.name+"</td><td>"+data.patientid+"</td><td>"+data.doctorname+"</td><td>"+data.medicinename+"</td>\n\
<td>"+data.quantity+"</td></tr>";
                                 $('#patient_medicines_order_table').append(trHTML);
                             $('#patient_medicines_order_table').load();
                             $('#patientoid').val(data.patientid);
                             
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                             $('#patient_medicines_order_table').append(trHTML);
                             $('#patient_medicines_order_table').load();
                        }
                        
                    }
                });
                    $('#orderedMedicines').modal('show');
                        
        }
    });
    
}


function callMedicalShopOrderDetailsData(orderid){
    shopid = $('#officeid').val();
    console.log(rootURL + '/medicalShopSpecificOrder/'+shopid +"/"+ orderid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/medicalShopSpecificOrder/'+shopid +"/"+ orderid,
        dataType: "json",
        success: function(data){
             console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
           $("#patient_medicines_order_table tbody").remove();
          
            console.log(list);
                console.log("Data List Length "+list.length);
                $.each(list, function(index, responseMessageDetails) {
                    trHTML ="";
                    if(responseMessageDetails.status == "Success"){
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count "+(parseInt(dataCount) > 0));
                        if((parseInt(dataCount) > 0)){
                            $('#recordcount').val(dataCount);
                             $.each(patientData, function(index, data) {
                                 
                                 $('#patientpname').html(data.name); $('#patientaddress').html(data.address);
                                 checkboxdata = index+"#"+data.medicinename+"#"+data.quantity+"#"+data.id;
                                 textboxid = index+"price";
                           link =  "<input type='textbox' id="+textboxid+" name="+textboxid+" size='5'>";
                           checkboxid = index+"selected";
                           datatopass = escape(data.id+"#"+index+"#"+data.mobile+"#"+data.medicalshopname);
                           checklink = "<input type='checkbox' id="+checkboxid+" name="+checkboxid+" value="+datatopass+">";      
                                 trHTML ="<tr><td>"+checklink+"</td><td>"+data.doctorname+"</td><td>"+data.medicinename+"</td>\n\
<td>"+data.quantity+"</td><td>"+link+"</td></tr>";
                                 $('#patient_medicines_order_table').append(trHTML);
                             $('#patient_medicines_order_table').load();
                             $('#patientoid').val(data.patientid);
                             
                             });
                             
                        }else{
                            trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                             $('#patient_medicines_order_table').append(trHTML);
                             $('#patient_medicines_order_table').load();
                        }
                        
                    }
                });
                    $('#orderedMedicines').modal('show');
                        
        }
    });
    
}
