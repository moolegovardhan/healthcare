/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
//alert("hello");
    $('#adminErrorBlock').hide();
    $('#adminStaffErrorBlock').hide();
    if($('#hosiptalcount').val() > 0){
        
        $('#adminErrorMessage').html("<b>INFO </b> : Please register hospital's before registering staff");
        $('#adminErrorBlock').show();
    }
    
    $('#registerAdminUser').click( function(){
         if($('#email').val().length < 1){
                $('#emailerrormsg').html("Please enter email");  
                return false; 
            }
        $('#errorDisplay').html("  ");
            
            var sEmail = $('#email').val();
             var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
             if (!filter.test(sEmail))  {
                  $("#emailerrormsg").html("Invalid Email Address").show();
                 return false;
           }
       
            $("#mobile").keypress(function (e) {
                   if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                      //display error message
                      $("#errmsg").html("Digits Only").show().fadeOut("slow");
                             return false;
                  }
              });
           $("#zipcode").keypress(function (e) {
               if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                  //display error message
                  $("#errmsg").html("Digits Only").show().fadeOut("slow");
                         return false;
              }
             });
       
        
        
        
        if(registerFormValidate())
            checkUserId($('#newuser').val());
        
    });
    
    //Added by achyuth for getting the checked doctors count
    $('.doctorCheckbox').click(function(){
    	var doctorsCheckedCount = $('.doctorCheckbox:checked').length;
    	//alert(doctorsCheckedCount);
    	$('#doctorsCheckedCount').val(doctorsCheckedCount);
    });

    
});



function checkUserId(userId){
    
console.log("user Id "+userId);

console.log(rootURL+'/checkUserId/' + userId);
  $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/checkUserId/' + userId,
        dataType: "json",
        success: function(data, textStatus, jqXHR){

            var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

            console.log("In check User Id"+(list).length);
            console.log("lsit : "+list);
            
            $.each(list, function(index, responseMessageDetails) {
                var message = responseMessageDetails.message;
               if(message.indexOf("]:") > 0)
                  message = message.substring(0,message.indexOf("]:")+2);
              
              console.log(message);
              
                if(responseMessageDetails.status == "Success"){
                    console.log("Data length : "+responseMessageDetails.data.length);
                     
                    if(message.indexOf("Exists") > 0){
                        console.log("User Exists count");
                         $('#adminErrorMessage').html("<b>Error : </b>"+message);
                         $('#adminErrorBlock').show();
                        
                    }else{
                        
                        
                        registerNewUser();
                        
                        
                    }
                    
                }else if(responseMessageDetails.status == "Fail"){
                    $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                    $('#adminStaffErrorBlock').show();
                }else {
                     $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                     $('#adminStaffErrorBlock').show();
                }
                
                
            });
          
        },
        error: function(data){
               var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
        }
    });

    
}



function registerFormValidate(){
    
    clearValidationMessage();
    if($('#newuser').val().length < 1){
        $('#useriderrmsg').html("Please enter user id"); 
        return false;
    }
     if($('#newuserpassword').val().length < 1){
        $('#passworderrormsg').html("Please enter password"); 
        return false;  
    }
     if($('#name').val().length < 1){
        $('#nameerrormsg').html("Please enter first name"); 
        return false;
    }
     if($('#mname').val().length < 1){
        $('#mnameerrormsg').html("Please enter mname"); 
        return false;  
    }
     if($('#lname').val().length < 1){
        $('#lnamerrormsg').html("Please enter last name"); 
        return false;  
    }
    
     if($('#mobile').val().length < 1){
        $('#mobileerrormsg').html("Please enter mobile #");  
        return false;
    }
     if($('#address1').val().length < 1){
        $('#address1errormsg').html("Please enter address line 1");  
        return false; 
    }
     if($('#district').val().length < 1){
        $('#districterrormsg').html("Please enter district");
        return false;  
    }
     if($('#state').val().length < 1){
        $('#stateerrormsg').html("Please enter state");  
        return false; 
    }
     if($('#zipcode').val().length < 1){
        $('#zipcodeerrormsg').html("Please enter zipcode"); 
        return false;  
    }
     if($('#start').val().length < 1){
        $('#starterrormsg').html("Please enter date of birth");
        return false; 
    }
     if($('#gender').val().length < 1){
        $('#gendererrormsg').html("Please select gender ");   
        return false;
    }
    if($('#hosiptal').val() == "HOSPITAL"){
        $('#proferrormsg').html("Please Select Hsopital ") ; 
        return false;
    }
    if($('#aadharcard').val().length < 1){
        $('#aadharerrormsg').html("Please enter aadhar card ") ; 
        return false;
    }
     if($('#city').val().length < 1){
        $('#cityerrormsg').html("Please enter aadhar card ") ; 
        return false;
    }
    return true;
}
function clearValidationMessage(){
    $('#useriderrmsg').html("");
     $('#passworderrormsg').html("");  
    $('#nameerrormsg').html(""); 
     $('#mnameerrormsg').html("");   
     $('#lnamerrormsg').html("");
     $('#emailerrormsg').html("");  
    $('#mobileerrormsg').html("");
     $('#address1errormsg').html("");
      $('#stateerrormsg').html("");   
     $('#districterrormsg').html("");
       $('#zipcodeerrormsg').html(""); 
     $('#gendererrormsg').html("");  
    $('#proferrormsg').html("") ; 
     $('#aadharerrormsg').html("") ; 
     $('#cityerrormsg').html("") ; 
}

function clearFormValues(){
    $('#name').val("");
     $('#mname').val("");  
    $('#lname').val(""); 
     $('#email').val("");   
     $('#newuserpassword').val("");
    $('#newuser').val("");
     $('#mobile').val("");  
    $('#address1').val("");
     $('#address2').val("");
     $('#district').val("");
      $('#state').val("");   
     $('#zipcode').val("");
       $('#start').val(""); 
     $('#gender').val("");  
    $('#profession').val("") ; 
      $('#aadharcard').val("") ; 
     $('#city').val("") ; 
}




function registerNewUser(){
    

        var appdt = ($('#start').val()).split('.');
        var appdate = appdt[2]+"-"+appdt[1]+"-"+appdt[0];
        if($('#address2').val().length < 1)
        {
          addressline2 = " ";
        }else
          addressline2 = $('#address2').val();

         profession = "Staff"; 
        registerUser($('#newuser').val(),$('#newuserpassword').val(),$('#email').val(),$('#mobile').val(),profession,$('#address1').val(),$('#name').val(), addressline2, $('#district').val(), $('#state').val(), $('#mname').val(),$('#lname').val(), $('#zipcode').val(), appdate, $('#gender').val(),  $('#aadharcard').val(),  $('#city').val(),  $('#hosiptal').val(),  $('#altmobile').val(),  $('#landline').val(),  $('#age').val(),  $('#cardtype').val()    );


}



function registerUser(userName,password,email,mobile,profession,address,name,address2,district,state,mname,lname,zipcode,start,gender,aadharcard,city,hosiptal,altmobile,landline,age,cardtype){
   
    var finalname = $('#name').val()+" "+$('#mname').val()+" "+$('#lname').val();

    var registerData = JSON.stringify( {"userName" : userName,"password" : password,"email" : email,"mobile" : mobile,"profession" : profession,"address":address,"name":finalname,"mname":mname,"state":state,"zipcode":zipcode,"district":district,"lname":lname,"gender":gender,"start":start,"aadharcard":aadharcard,"address2":address2,"fname":$('#name').val(),"city":city,"hospital":hosiptal,"altmobile":altmobile,"landline":landline,"age":age,"cardtype":cardtype } );
        
    console.log("data "+registerData);
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/registerAdminUser',
            dataType: "json",
            data:  registerData,
            success: function(data, textStatus, jqXHR){
                var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var message = responseMessageDetails.message;
                   
                  
                    if(message.indexOf("]:") > 0)
                        message = message.substring(0,message.indexOf("]:")+2);
                    
                     console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                       console.log("In SUccess");
                       $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                        $('#adminStaffErrorBlock').show();
                       clearFormValues();
                   }else{
                       console.log("In fail");
                       if(message.indexOf("Exists") > 0){
                           $('#adminStaffErrorMessage').html("<b>Error : User Id exists</b>");
                             $('#adminStaffErrorBlock').show(); 
                       }else{
                           $('#adminStaffErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                             $('#adminStaffErrorBlock').show();
                            clearFormValues();
                       }
                   }
                   
                   
                });
 
            },
            error: function(data){
                var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });

            }
        });

}


function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#adminErrorBlock').hide();
         $('#adminErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}



function requestText(requestId){
    console.log(rootURL+'/fetchRequestText/' + requestId);
    $.ajax({
                type: 'GET',
        contentType: 'application/json',
        url: rootURL+'/fetchRequestText/' + requestId,
        dataType: "json",
        success: function(data){
            
               var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var message = responseMessageDetails.message;
                   $('#requestMessage').html(responseMessageDetails.data[0].Text);
                   //console.log("message "+);
               });
            
        $('#myModal').modal('show');
                     
        },
        error: function(data){
       var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails :    [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
        }
        
    });
}


function displayErrorResults(){
         $('#adminHospitalErrorBlock').hide();
         $('#adminStaffErrorBlock').hide();
         $('#adminErrorBlock').hide();
         $('#adminErrorMessage').html("");  
          $('#adminStaffErrorMessage').html("");  
}


