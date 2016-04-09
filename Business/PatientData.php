<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PatientData
 *
 * @author pkumarku
 */
include_once  'BusinessHSMDatabase.php';



class PatientData {
    
    
    
      
    function checkUserName($userName){
        
        $dbConnection = new HSMDatabase();
       $sql = "SELECT * from users where username = :username ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("username", $userName);
                $stmt->execute();
                $userName = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($userName);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }


    function createNewUser($user,$status){
        if($user->profession == "Others")
            $credits = 50;
        else
             $credits = 0;
        
        try{
            
            $encryptPassword = new EncryptDecryptData();
            
            $password = $encryptPassword->encryptData($user->password);
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession, address, name, middlename, lastname, firstname, dob, gender, city, state, zipcode, aadharcard, addressline1, addressline2,district,status,altmobile,landline,credits,doctorid,policyid,policytype,department,age  ) VALUES (:userName, :password, :email, :mobile, :profession,:address,:name, :middlename, :lastname, :firstname, :dob, :gender, :city, :state, :zipcode, :aadharcard, :addressline1, :addressline2,:district,:status,:altmobile,:landline,:credits,:doctorid,:policyid,:policytype,:department,:age  )";
           $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $finalAddress =  $user->address." ".$user->address2;
             $stmt->bindParam("userName", $user->userName);    //echo "Hello ";
            $stmt->bindParam("password", $password); //   echo "Hello ";
            $stmt->bindParam("email", $user->email);    //echo "Hello ";
            $stmt->bindParam("mobile", $user->mobile);   // echo "Hello ";
            $stmt->bindParam("profession", $user->profession); //   echo "Hello ";
            $stmt->bindParam("address", $finalAddress);  //  echo "Hello ";
             $stmt->bindParam("name", $user->name);    //echo "Hello ";
             $stmt->bindParam("middlename", $user->mname);   // echo "Hello ";
             $stmt->bindParam("lastname", $user->lname);    //echo "Hello ";
             $stmt->bindParam("firstname", $user->fname);   // echo "Hello ";
             $stmt->bindParam("dob", $user->start);
             $stmt->bindParam("gender", $user->gender);
             $stmt->bindParam("city", $user->city);
             $stmt->bindParam("state", $user->state);
             $stmt->bindParam("zipcode", $user->zipcode);
             $stmt->bindParam("aadharcard", $user->aadharcard);
             $stmt->bindParam("addressline1", $user->address);
             $stmt->bindParam("addressline2", $user->address2);
             $stmt->bindParam("district", $user->district);
            $stmt->bindParam("status", $status);
             $stmt->bindParam("altmobile", $user->altmobile);
              $stmt->bindParam("landline", $user->landline);
             $stmt->bindParam("credits",$credits); 
              $stmt->bindParam("doctorid",$user->doctorid); 
              
             $stmt->bindParam("policyid", $user->policyid); 
             $stmt->bindParam("policytype", $user->policytype); 
              $stmt->bindParam("department", $user->department); 
               $stmt->bindParam("age", $user->age); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
            //echo json_encode($user); 
         } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
        
    }
    
      function createMobileNewUser($user,$status,$number){
        if($user->profession == "Others")
            $credits = 50;
        else
             $credits = 0;
        
        try{
            
            $encryptPassword = new EncryptDecryptData();
            
            $password = $encryptPassword->encryptData($user->password);
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession, address, name, middlename, lastname, firstname, dob, gender, city, state, zipcode, aadharcard, addressline1, addressline2,district,status,altmobile,landline,credits,doctorid,policyid,policytype,department,age,otp,udid  ) VALUES (:userName, :password, :email, :mobile, :profession,:address,:name, :middlename, :lastname, :firstname, :dob, :gender, :city, :state, :zipcode, :aadharcard, :addressline1, :addressline2,:district,:status,:altmobile,:landline,:credits,:doctorid,:policyid,:policytype,:department,:age,:otp,:udid   )";
           $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $finalAddress =  $user->address." ".$user->address2;
             $stmt->bindParam("userName", $user->userName);    //echo "Hello ";
            $stmt->bindParam("password", $password); //   echo "Hello ";
            $stmt->bindParam("email", $user->email);    //echo "Hello ";
            $stmt->bindParam("mobile", $user->mobile);   // echo "Hello ";
            $stmt->bindParam("profession", $user->profession); //   echo "Hello ";
            $stmt->bindParam("address", $finalAddress);  //  echo "Hello ";
             $stmt->bindParam("name", $user->name);    //echo "Hello ";
             $stmt->bindParam("middlename", $user->mname);   // echo "Hello ";
             $stmt->bindParam("lastname", $user->lname);    //echo "Hello ";
             $stmt->bindParam("firstname", $user->fname);   // echo "Hello ";
             $stmt->bindParam("dob", $user->start);
             $stmt->bindParam("gender", $user->gender);
             $stmt->bindParam("city", $user->city);
             $stmt->bindParam("state", $user->state);
             $stmt->bindParam("zipcode", $user->zipcode);
             $stmt->bindParam("aadharcard", $user->aadharcard);
             $stmt->bindParam("addressline1", $user->address);
             $stmt->bindParam("addressline2", $user->address2);
             $stmt->bindParam("district", $user->district);
            $stmt->bindParam("status", $status);
             $stmt->bindParam("altmobile", $user->altmobile);
              $stmt->bindParam("landline", $user->landline);
             $stmt->bindParam("credits",$credits); 
              $stmt->bindParam("doctorid",$user->doctorid); 
              
             $stmt->bindParam("policyid", $user->policyid); 
             $stmt->bindParam("policytype", $user->policytype); 
              $stmt->bindParam("department", $user->department); 
               $stmt->bindParam("age", $user->age); 
                $stmt->bindParam("udid", $user->udid); 
                $stmt->bindParam("otp", $number); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
            //echo json_encode($user); 
         } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
        
    }
    
    function createQuickNewUser($user,$status,$from){
        if($user->profession == "Others")
            $credits = 50;
        else
             $credits = 0;
        
        try{
            
            $encryptPassword = new EncryptDecryptData();
            if($from == 'Y')
                 $password = $encryptPassword->encryptData("Welcome");
            else    
                 $password = $encryptPassword->encryptData($user->password);
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession,name,status,credits) VALUES (:userName, :password, :email, :mobile, :profession,:name,:status,:credits)";
           $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
          
        //  echo "SQL : ".$sql;
           $stmt = $db->prepare($sql);
           if($from == 'Y')
               $stmt->bindParam("userName", $user->username);
           else    
            $stmt->bindParam("userName", $user->mobile);    //echo "Hello ";
           
            $stmt->bindParam("password", $password); //   echo "Hello ";
            $stmt->bindParam("email", $user->email);    //echo "Hello ";
            $stmt->bindParam("mobile", $user->mobile);   // echo "Hello ";
            $stmt->bindParam("profession", $user->profession); //   echo "Hello ";
            
             $stmt->bindParam("name", $user->name);    //echo "Hello ";
            
            $stmt->bindParam("status", $status);
            
             $stmt->bindParam("credits",$credits); 
             
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
            //echo json_encode($user); 
         } catch(PDOException $pdoex) {
              echo "Exception in create User : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              echo $pdoex->getFile();
              throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in create User : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                echo $ex->getFile();
                 throw new Exception($ex);
             } 
        
        
    }
    
    function createQuickMobileNewUser($user,$status,$from){
        if($user->profession == "Others")
            $credits = 50;
        else
             $credits = 0;
        
        try{
            
            $encryptPassword = new EncryptDecryptData();
            if($from == 'Y')
                 $password = $encryptPassword->encryptData("Welcome");
            else    
                 $password = $encryptPassword->encryptData($user->password);
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession,name,status,credits,udid) VALUES (:userName, :password, :email, :mobile, :profession,:name,:status,:credits,:udid)";
           $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
          
        //  echo "SQL : ".$sql;
           $stmt = $db->prepare($sql);
           if($from == 'Y')
               $stmt->bindParam("userName", $user->username);
           else    
            $stmt->bindParam("userName", $user->mobile);    //echo "Hello ";
           
            $stmt->bindParam("password", $password); //   echo "Hello ";
            $stmt->bindParam("email", $user->email);    //echo "Hello ";
            $stmt->bindParam("mobile", $user->mobile);   // echo "Hello ";
            $stmt->bindParam("profession", $user->profession); //   echo "Hello ";
            
             $stmt->bindParam("name", $user->name);    //echo "Hello ";
            
              $stmt->bindParam("udid", $user->udid);
              
            $stmt->bindParam("status", $status);
            
             $stmt->bindParam("credits",$credits); 
             
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
            //echo json_encode($user); 
         } catch(PDOException $pdoex) {
              echo "Exception in create User : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              echo $pdoex->getFile();
              throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in create User : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                echo $ex->getFile();
                 throw new Exception($ex);
             } 
        
        
    }
    
     function insertCardDetails($cardType,$patientId,$hospitalId){ 
        
        $dbConnection = new BusinessHSMDatabase();
        
        if($hospitalId == "")
            $hospitalId = "CALLCENTER";
        
        try{
         $sql = "INSERT INTO patient_card (patientid,cardtype,status,distribution_date,hospitalid) VALUES(:patientid,:cardtype,'Y',CURDATE(),:officeid)";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("patientid", $patientId);
                $stmt->bindParam("cardtype", $cardType);
                $stmt->bindParam("officeid", $hospitalId);
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
        
    } 
      
    function insertPaymentDetails($paymentDetails,$patientId,$amount,$paymentdate){ 
        
        $dbConnection = new BusinessHSMDatabase();
        
        if($hospitalId == "")
            $hospitalId = "CALLCENTER";
        $userid = $_SESSION['userid'];
        try{
         $sql = "INSERT INTO payments (patientid,amount,status,paymentfor,paymentdate,createddate,createdby) "
                 . " VALUES($patientId,$amount,'Y',$paymentDetails,$paymentdate,CURDATE(),$userid)";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
        
    } 
      
    
    function createAdminNewUser($user,$status){
        if($user->profession != "Doctor"){
            $credits = 0;
            $doctorid = "";
        }  else {
             $credits = 0;
             $doctorid = $user->doctorid;
        }
        
        
        try{
            
              $encryptPassword = new EncryptDecryptData();
            
            $password = $encryptPassword->encryptData($user->password);
            
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession, address, name, middlename, lastname, firstname, dob, gender, city, state, zipcode, aadharcard, addressline1, addressline2,district,status,officeid,altmobile,landline,credits,doctorid,policyid,policytype,department,age ) VALUES (:userName, :password, :email, :mobile, :profession,:address,:name, :middlename, :lastname, :firstname, :dob, :gender, :city, :state, :zipcode, :aadharcard, :addressline1, :addressline2,:district,:status,:officeid,:altmobile,:landline,:credits,:doctorid,:policyid,:policytype,:department,:age )";
           $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $finalAddress =  $user->address." ".$user->address2;
             $stmt->bindParam("userName", $user->userName);    //echo "Hello ";
            $stmt->bindParam("password", $password); //   echo "Hello ";
            $stmt->bindParam("email", $user->email);    //echo "Hello ";
            $stmt->bindParam("mobile", $user->mobile);   // echo "Hello ";
            $stmt->bindParam("profession", $user->profession); //   echo "Hello ";
            $stmt->bindParam("address", $finalAddress);  //  echo "Hello ";
             $stmt->bindParam("name", $user->name);    //echo "Hello ";
             $stmt->bindParam("middlename", $user->mname);   // echo "Hello ";
             $stmt->bindParam("lastname", $user->lname);    //echo "Hello ";
             $stmt->bindParam("firstname", $user->fname);   // echo "Hello ";
             $stmt->bindParam("dob", $user->start);
             $stmt->bindParam("gender", $user->gender);
             $stmt->bindParam("city", $user->city);
             $stmt->bindParam("state", $user->state);
             $stmt->bindParam("zipcode", $user->zipcode);
             $stmt->bindParam("aadharcard", $user->aadharcard);
             $stmt->bindParam("addressline1", $user->address);
             $stmt->bindParam("addressline2", $user->address2);
             $stmt->bindParam("district", $user->district);
            $stmt->bindParam("status", $status);
             $stmt->bindParam("officeid", $user->hospital); 
             $stmt->bindParam("altmobile", $user->altmobile); 
             $stmt->bindParam("landline", $user->landline); 
             $stmt->bindParam("credits", $credits); 
             $stmt->bindParam("doctorid", $doctorid);
             $stmt->bindParam("policyid", $user->policyid); 
             $stmt->bindParam("policytype", $user->policytype); 
             $stmt->bindParam("department", $user->department); 
             $stmt->bindParam("age", $user->age); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            $_SESSION['registereduser'] = $finalUser;
            
           // $this->insertCardDetails($user->cardtype, $finalUser,$user->hospital);
 
            $db = null;
            
            return $finalUser;
            } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
       
    }
    
    
    
    function patientDetails($patientId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT * from users where id = :patientId";
        //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return json_encode($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
     function patientCompleteDetails($start,$end){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT id,name,mobile,email,cardtype,cardamount,salesperson,totalamount from users where profession = 'Others' LIMIT $start,$end";
       // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return ($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function patientCountCompleteDetails(){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT count(*) as count from users where profession = 'Others'";
       // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return ($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function patientNameCountCompleteDetails($patientName,$start,$end){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT count(*) as count from users where profession = 'Others' and name LIKE '%$patientName%'";
       // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return ($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }

 function patientNamePaymentsCompleteDetails($patientName,$start,$end){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT id,name,mobile,email,cardtype,cardamount,salesperson,totalamount from users where profession = 'Others' and name LIKE '%$patientName%' LIMIT $start,$end";
    //  echo "<br/>";  echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return ($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }

  function patientNameCardCompleteDetails($patientName,$start,$end){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT id,name,mobile,email,cardtype,cardamount,salesperson,totalamount from users where profession = 'Others' and name LIKE '%$patientName%' LIMIT $start,$end";
     // echo "<br/>";  echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return ($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
   
     function patientNameCompleteDetails($patientName,$start,$end){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT id,name,mobile,email,cardtype,cardamount,salesperson,totalamount from users where profession = 'Others' and name LIKE '%$patientName%' LIMIT $start,$end";
     // echo "<br/>";  echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return json_encode($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
   
    function updatePatientCardDetails($patientId,$cardType,$cardAmount,$salesPerson){
        
        $sql = "update users set cardtype= '$cardType' ,cardamount = '$cardAmount',salesperson= '$salesPerson' where ID = $patientId";
        echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            return $finalUser;
    }
    
 function patientIDDetails($patientId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from users u where u.ID = :patientId";
        //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                $_SESSION['userDetails'] = $userDetails;

                return json_encode($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function password($password){
            $encryptPassword = new EncryptDecryptData();
            
            //$password = $encryptPassword->encryptData($password);
           echo "password".$encryptPassword->decryptData($password);
            return $encryptPassword->decryptData($password);
    }
     
    function updateProfile($id,$user){
        
         $dbConnection = new HSMDatabase();
    // var_dump($id);    
    // var_dump($user);
             $encryptPassword = new EncryptDecryptData();
            
            $password = $encryptPassword->encryptData($user->password);
         
        
  $sql = "UPDATE users SET password=:password,email=:email,mobile=:mobile,address=:address,name=:name,middlename=:middlename,lastname=:lastname,firstname=:firstname,dob=:start,gender=:gender,city=:city,state=:state,zipcode=:zipcode,aadharcard=:aadharcard,addressline1=:address1,addressline2=:address2,district=:district,altmobile=:altmobile,landline=:landline WHERE username = :userName " ;    
      // echo $sql; 
        try{
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
             $finalAddress =  $user->address." ".$user->address2;
             $stmt->bindParam("userName", $user->userName);    
            $stmt->bindParam("password", $password);    
            $stmt->bindParam("email", $user->email);    
            $stmt->bindParam("mobile", $user->mobile); 
            $stmt->bindParam("address", $finalAddress);   
             $stmt->bindParam("name", $user->name);    
             $stmt->bindParam("middlename", $user->mname);  
             $stmt->bindParam("lastname", $user->lname);   
             $stmt->bindParam("firstname", $user->fname);   
             $stmt->bindParam("start", $user->start);
             $stmt->bindParam("gender", $user->gender);
             $stmt->bindParam("city", $user->city);
             $stmt->bindParam("state", $user->state);
             $stmt->bindParam("zipcode", $user->zipcode);
             $stmt->bindParam("aadharcard", $user->aadharcard);
             $stmt->bindParam("address1", $user->address);
             $stmt->bindParam("address2", $user->address2);
             $stmt->bindParam("district", $user->district);
             $stmt->bindParam("altmobile", $user->altmobile);
             $stmt->bindParam("landline", $user->landline);
                $stmt->execute();  
            //echo $stmt->debugDumpParams();
                $db = null;
                return $user;
            } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
  
   
     function healthParametersHistory($patientId){
        
         $dbConnection = new HSMDatabase();
        
            $sql = "SELECT patientid, id, weight, height, bmi, hemoglobin, sugar, bp, createdby, createddate FROM healthparameters
            WHERE patientid = :patientId";
        //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $userHealthParamaters = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // $_SESSION['userHealthParamatersDetails'] = $userHealthParamatersDetails;
                //echo $stmt->debugDumpParams();
               // var_dump($userLatestHealthParamaters);
                return ($userHealthParamaters);


           } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
    }
    
    
    
    
    function healthParameters($patientId){
        
         $dbConnection = new HSMDatabase();
        
            $sql = "SELECT patientid, id, weight, height, bmi, hemoglobin, sugar, bp, createdby, createddate FROM healthparameters
            WHERE patientid = :patientId and createddate = (select MAX(createddate) from healthparameters where patientid = :inpatientId)";
        //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId", $patientId);
                $stmt->bindParam("inpatientId", $patientId);
                $stmt->execute();
                $userLatestHealthParamaters = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // $_SESSION['userHealthParamatersDetails'] = $userHealthParamatersDetails;
                //echo $stmt->debugDumpParams();
               // var_dump($userLatestHealthParamaters);
                return ($userLatestHealthParamaters);


           } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
    }
    
    
    function getPhoto($patientName){
        //echo "Patient Name".$patientName;
        $sql = "select * from patienttranscripts where patientname = :patientname and reporttype = 'Photo' ";
        $dbConnection = new BusinessHSMDatabase();
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientname", $patientName);
                $stmt->execute();
                $getPhoto = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // $_SESSION['userHealthParamatersDetails'] = $userHealthParamatersDetails;
                //echo $stmt->debugDumpParams();
               // var_dump($userLatestHealthParamaters);
                return ($getPhoto);
        } catch (Exception $ex) {

        }
        
    }
    
    function patientAppointmentDate($patientId){
        
        $sql = "SELECT MAX(AppointementDate) as appointementdate,appointmenttime from appointment where PatientId = :patientid";
        $dbConnection = new BusinessHSMDatabase();
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientId);
                $stmt->execute();
                $appointmentDate = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // $_SESSION['userHealthParamatersDetails'] = $userHealthParamatersDetails;
                //echo $stmt->debugDumpParams();
               // var_dump($userLatestHealthParamaters);
                return ($appointmentDate);
        } catch (Exception $ex) {

        }
        
    }
    
    function confirmCancelAppointment($type,$appointmentId){
      //  echo $type;echo $appointmentId;
        if($type == "Cancel")
            $status = "C";
        else 
            $status = "Y";
        
        $sql = "UPDATE appointment SET STATUS = :status  where id =:id";
        $dbConnection = new BusinessHSMDatabase();
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("status", $status);
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();
                $db = null;
                return ($this->fetchSpecificAppointment($appointmentId));
        } catch (Exception $ex) {
              echo $ex->getMessage();
        }
        
    }
   
    function fetchSpecificAppointment($appointmentid){
       // echo "Hello".$appointmentid;
        
         $sql = "SELECT * from appointment where id = :id";
        $dbConnection = new BusinessHSMDatabase();
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("id", $appointmentid);
                $stmt->execute();
                $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            //  print_r($appointmentData);
                return ($appointmentData);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
    }
    
    
     function getTodayAppointments(){
        
          if(isset($_SESSION['officeid'])){
                $officeId = $_SESSION['officeid'];
            }  else {
                throw new Exception("Invalid Office ID","HSM002","");
            }
         
        $sql = "select * from appointment where appointementdate = CURDATE() and hosiptalid= :officeid";
      //  echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("officeid", $officeId);
                $stmt->execute();
                $todayAppointments = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $todayAppointments;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function patientMedicinces(){
        
        $patientId = $_SESSION['userid'];
       // echo $patientId;
         $dbConnection = new BusinessHSMDatabase();
         /*$sql = "SELECT id,medicinename,noofdays,(if(MBF = 'Y',noofdays*1,'Morning Before Meal')+"
                 . "if(MAF = 'Y',noofdays*1,'Morning After Meal')+if(ABF = 'Y',noofdays*1,'Morning Before Meal')+"
                 . "if(AAF = 'Y',noofdays*1,'Morning Before Meal')+if(EBF = 'Y',noofdays*1,'Morning Before Meal')+"
                 . "if(EAF = 'Y',noofdays*1,'Morning Before Meal')) as totalcount FROM medicines where patientid = :patientid ORDER BY id DESC";
                 */
         $sql = "SELECT m.appointmentid,ap.AppointementDate, m.id,m.medicinename,m.noofdays,(if(m.MBF = 'Y',m.noofdays*1,'Morning Before Meal')+"
         . "if(m.MAF = 'Y',m.noofdays*1,'Morning After Meal')+if(m.ABF = 'Y',m.noofdays*1,'Morning Before Meal')+"
         . "if(m.AAF = 'Y',m.noofdays*1,'Morning Before Meal')+if(m.EBF = 'Y',m.noofdays*1,'Morning Before Meal')+"
         . "if(m.EAF = 'Y',m.noofdays*1,'Morning Before Meal')) as totalcount,ap.DoctorId,ap.DoctorName as doctorname FROM medicines as m,appointment as ap where m.patientid = :patientid AND m.appointmentid = ap.id ORDER BY id DESC";
         
       // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientId);
                $stmt->execute();
                $medicinesDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                
                return $medicinesDetails;

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
    }
    
      function patientAppointmentSpecificMedicinces($appointmentid){
        
        
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT patientname,medicines.id,medicinename,noofdays,dosage,(if(MBF = 'Y',noofdays*1,'Morning Before Meal')+"
                 . "if(MAF = 'Y',noofdays*1,'Morning After Meal')+if(ABF = 'Y',noofdays*1,'Morning Before Meal')+"
                 . "if(AAF = 'Y',noofdays*1,'Morning Before Meal')+if(EBF = 'Y',noofdays*1,'Morning Before Meal')+"
                 . "if(EAF = 'Y',noofdays*1,'Morning Before Meal')) as totalcount,MBF,MAF,ABF,AAF,EBF, EAF,medicines.patientid,appointmentid FROM medicines,appointment a"
                 . " where appointmentid = :appointmentid and medicines.status = 'Y' and a.id = medicines.appointmentid ";
        //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $medicinesDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                
                return $medicinesDetails;

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
    }
    
    function updateMedicinesOrdered($id){
        //echo $id;
        $sql = "update medicines set status = 'Y' where id = :id";
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
             $stmt->bindParam("id", $id);    
             $stmt->execute();  
               $db = null;
                return "Success";
            
            
        } catch(PDOException $pdoex) {
            throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
        
    }
    
    
   function updatePatientCredits($appointmentid){
       
       $appointmentDetails = $this->fetchSpecificAppointment($appointmentid);
       $patientId = $appointmentDetails[0]->id;
       
       $sql = "update users set credits = (credits - 10) where id = :patientid";
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
             $stmt->bindParam("patientid", $patientId);    
             $stmt->execute();  
               $db = null;
                return "Success";
            
            
        } catch(PDOException $pdoex) {
            throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
   } 
  
   
   function fetchPatientList($patientname,$patientid,$appid,$mobile){
          $dbConnection = new BusinessHSMDatabase();
           $sql = "SELECT ID,name,mobile,dob,gender from users ";
              try {
                    $cond = array();
                    $params = array();
                    if ($patientname != 'nodata') {
                        $cond[] = "name LIKE ? ";
                        $params[] = "%".$patientname."%";
                    }  
                    if ($patientid != 'nodata') {
                        $cond[] = "ID = ? ";
                        $params[] = $patientid;
                    }     
                     if ($mobile != 'nodata') {
                            $cond[] = "mobile = ? ";
                            $params[] = $mobile;
                        }    
                    
                       $cond[] = "status = ?";
                        $params[] = 'Y';
                       
                        $cond[] = "profession = ?";
                        $params[] = 'Others';  
                        
                       if (count($cond)) {
                           $sql .= ' WHERE ' . implode(' AND ', $cond);
                       }
                          $db = $dbConnection->getConnection();
                        //  echo $sql;
                         // print_r($params);
                          $stmt = $db->prepare($sql);
                          $stmt->execute($params);
                          $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);   
                        
                     return   $userDetails; 
                   } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                }
    }
    
    function fetchOtherPatientList($patientname,$mobile,$email){
          $dbConnection = new BusinessHSMDatabase();

            $sql = "SELECT username,ID,name,mobile,dob,gender,email,address from users ";
              try {
                    $cond = array();
                    $params = array();
                    if ($patientname != 'nodata') {
                        $cond[] = "name LIKE ? ";
                        $params[] = "%".$patientname."%";
                    }  
                    if ($email != 'nodata') {
                        $cond[] = "email = ? ";
                        $params[] = $email;
                    }     
                     if ($mobile != 'nodata') {
                            $cond[] = "mobile = ? ";
                            $params[] = $mobile;
                        }    
                    
                       $cond[] = "status = ?";
                        $params[] = 'Y';
                       
                        $cond[] = "profession = ?";
                        $params[] = 'Others';  
                        
                       if (count($cond)) {
                           $sql .= ' WHERE ' . implode(' OR ', $cond);
                       }
                          $db = $dbConnection->getConnection();
                         // echo $sql;
                         // print_r($params);
                          $stmt = $db->prepare($sql);
                          $stmt->execute($params);
                          $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);   
                        
                     return   $userDetails; 
                   } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                }
    }
    
    function insertPatientGenralInfo($patientGeneralData){
        
        $sql = "INSERT INTO patient_general_info( paramname, paramvalue, observation, "
                . "status, patientid) VALUES (:paramname,:paramvalue,:observation,'Y',"
                . ":patientid)";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("paramname", $patientGeneralData->paramname);    //echo "Hello ";
            $stmt->bindParam("paramvalue", $patientGeneralData->paramvalue); //   echo "Hello ";
            $stmt->bindParam("observation", $patientGeneralData->observation);   
           $stmt->bindParam("patientid", $patientGeneralData->patientid); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
        
        
    }
    
      function insertPatientSpecificGenralInfo($paramname,$paramvalue,$observation,$patientid){
        
        $sql = "INSERT INTO patient_general_info( paramname, paramvalue, observation, "
                . "status, patientid) VALUES (:paramname,:paramvalue,:observation,'Y',"
                . ":patientid)";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("paramname", $paramname);    //echo "Hello ";
            $stmt->bindParam("paramvalue", $paramvalue); //   echo "Hello ";
            $stmt->bindParam("observation", $observation);   
           $stmt->bindParam("patientid", $patientid); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
        
        
    }
    
    function insertPatientHealthParameters($paramname,$paramvalue,$observation,$patientid){
        
        $sql = "INSERT INTO patient_medical_info( paramname, paramvalue, observation, "
                . "status, patientid) VALUES (:paramname,:paramvalue,:observation,'Y',"
                . ":patientid)";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("paramname", $paramname);    //echo "Hello ";
            $stmt->bindParam("paramvalue", $paramvalue); //   echo "Hello ";
            $stmt->bindParam("observation", $observation);   
           $stmt->bindParam("patientid", $patientid); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
        
        
    }
  
    function updatePatientGeneralInfo($patientGeneralInfo){
         $sql = "UPDATE patient_general_info SET paramname=:paramname,"
                 . "paramvalue=:paramvalue,observation=:observation,status='Y'"
                 . " WHERE id = :paramid";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("paramname", $patientGeneralInfo->paramname);    //echo "Hello ";
            $stmt->bindParam("paramvalue", $patientGeneralInfo->paramvalue); //   echo "Hello ";
            $stmt->bindParam("observation", $patientGeneralInfo->observation);   
           $stmt->bindParam("paramid", $patientGeneralInfo->paramid); 
            $stmt->execute();
        
    }
    
      function createPatientPaymentTransaction($patientid,$amount,$paymentfor,$createdby){
          try{
            $sql = "INSERT INTO payments( patientid, amount, paymentfor,paymentdate, "
                . "status, createdby,createddate) VALUES ($patientid,$amount,'$paymentfor',CURDATE(),'Y',"
                . "$createdby,CURDATE())";
          // echo $sql; 
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
          }catch(Exception $e){
             echo $e->getMessage(); 
          }
          
      }
    
      function updatePatientPaymentInfo($patientid,$amount){
         $sql = "UPDATE users SET totalamount= totalamount+$amount"
                
                 . " WHERE id = $patientid";
      //   echo $sql;
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
            $stmt->execute();
        
    }
    
    
      function updatePatientWalletPaymentInfo($patientid,$amount){
         $sql = "UPDATE users SET totalamount= totalamount-$amount"
                
                 . " WHERE id = $patientid";
      //   echo $sql;
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
            $stmt->execute();
        
    }
  
   function fetchPatientGeneralInfo($patientid){
       
       
       
        $sql = "select * from patient_general_info where status = 'Y' and patientid = :patientid";
      //  echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $patientData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $patientData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
       
   } 
    
  function fetchPatientMedicalInfo($patientid){
       
       
       
        $sql = "select * from patient_medical_info where status = 'Y' and patientid = :patientid";
      //  echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $patientData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $patientData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
       
   } 
   
   
    function updatePatientMedicalInfo($patientMedicalInfo){
         $sql = "UPDATE patient_medical_info SET paramname=:paramname,"
                 . "paramvalue=:paramvalue,observation=:observation,status='Y'"
                 . " WHERE id = :paramid";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("paramname", $patientMedicalInfo->paramname);    //echo "Hello ";
            $stmt->bindParam("paramvalue", $patientMedicalInfo->paramvalue); //   echo "Hello ";
            $stmt->bindParam("observation", $patientMedicalInfo->observation);   
           $stmt->bindParam("paramid", $patientMedicalInfo->paramid); 
            $stmt->execute();
        
    }
    
    function createPatientGroup($primaryUserid,$patientId){
        
        $sql = "insert into family_group(primary_id,member_id,status,requested_date) values(:primaryid,:memberid,'N',CURDATE())";
        $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("primaryid", $primaryUserid);    
            $stmt->bindParam("memberid", $patientId);
            $stmt->execute();
    }
    
     function acceptRejectGroupingRequest($primaryUserid,$requesterId){
        
        $sql = "update family_group set status = 'Y',accepted_date=CURDATE() where member_id = :memberid and primary_id = :primaryid";
        $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("primaryid", $requesterId);    
            $stmt->bindParam("memberid", $primaryUserid);
            $stmt->execute();
    } 
    
    function fetchGroupingRequesterData($primaryUserId){
        $sql = "select f.primary_id,u.name from family_group f,users u where u.ID = f.primary_id and f.member_id = :memberid and f.status = 'N' ";
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("memberid", $primaryUserId);
                $stmt->execute();
                $patientData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $patientData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
     function fetchGroupingUsersData($primaryUserId){
        $sql = "select distinct u.name,f.primary_id,u.ID from family_group f,users u where u.ID = f.member_id and f.primary_id = :primaryid and f.status = 'Y' ";
      // echo "primaryUserId : ".$primaryUserId;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("primaryid", $primaryUserId);
                $stmt->execute();
                $patientGroupData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            // print_r($patientGroupData);
                return $patientGroupData;

                

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function fetchPatientDetails($patientid){
       
        $sql = "select * from users where status = 'Y' and ID = :patientid";
      //  echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $patientData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $patientData;



           } catch(PDOException $e) {
		echo '{"error43":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error112":{"text11":'. $e1->getMessage() .'}}'; 
	} 
       
   } 
   
   
     function fetchPatientCardDetails($patientid){
       
        $sql = "select cardtype from users where status = 'Y' and ID = :patientid";
      //  echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $patientData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $patientData;



           } catch(PDOException $e) {
		echo '{"error43":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error112":{"text11":'. $e1->getMessage() .'}}'; 
	} 
       
   } 
   
   function fetchNonPrescriptionMedicines($patientid){
        
        $dbConnection = new HSMDatabase();
       $sql = "SELECT * from medicine_distribution_details where patientid = :patientid ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $userName = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($userName);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    
    function fetchExistingPatients($searchcriteria){
        
        $dbConnection = new HSMDatabase();
        
        $officeid = $_SESSION['officeid'];
        
       // if($officeid == "")
            $officeid = "54";
        
        $sql ="select distinct a.PatientName as name,a.doctorname as doctorname,a.pregnancy as ispregnant,a.amount as amount
                ,a.child as ischild,a.inpatient as doadmit,a.id as appointmentid,u.ID as patientid,u.address as address,u.mobile as mobile,u.dob as dob
                from appointment a,users u where u.ID = a.PatientId and a.inpatient = 'Y' and 
                  (u.name like '%$searchcriteria%' OR u.mobile like '%$searchcriteria%'"
               . " OR u.username = '$searchcriteria' OR u.ID = '%$searchcriteria%') and a.hosiptalid = $officeid order by a.id DESC ";
        
       // echo $sql;
       /* 
       $sql = "SELECT id,username,name,mobile,address,dob from users where status = 'Y' and profession = 'Others' and (name like '%$searchcriteria%' OR mobile like '%$searchcriteria%'"
               . " OR username = '$searchcriteria' OR ID = '%$searchcriteria%') ";
        
        */
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $userName = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($userName);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }

 
    function insertPatientDataDetails($newInPatientDetails){
        try{
           // var_dump(property_exists($newInPatientDetails, "isinsured"));
            if(!property_exists($newInPatientDetails, "isinsured"))
                $isInsured = "false";
            else
                  $isInsured = "true";
                  
            
            if($newInPatientDetails->ward == "WARD")      
                  $ward = "-";
            else 
                $ward = $newInPatientDetails->ward;
            
             if($newInPatientDetails->room == "ROOM")      
                  $room = "-";
            else 
                $room = $newInPatientDetails->room;
                  
            $sql = "insert into inpatient(patientid,department,referencedoctor,consultingdoctor,isinsured,sponsor,operation,"
                        . "ward,room,status,createddate,createdby,appointmentid) values($newInPatientDetails->patientid,'$newInPatientDetails->department',"
                        . " '$newInPatientDetails->refdoctor',
                            '$newInPatientDetails->consultdoctor','$isInsured','$newInPatientDetails->sponsor','$newInPatientDetails->operation',"
                        . "'$ward','$room','Y',CURDATE(),'Admin','$newInPatientDetails->appointmentid')";
              //  echo $sql;
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection(); 
                $stmt = $db->prepare($sql);  

               $stmt->execute();
                $finalUser= $db->lastInsertId();
               $db=null;
                if($newInPatientDetails->room != "ROOM" && $newInPatientDetails->ward == "WARD"){
                     $this->updateRoomOccupancy($newInPatientDetails->patientid,$newInPatientDetails->room);
                     $this->updatePatientWithOccupanyId($newInPatientDetails->appointmentid,$newInPatientDetails->room,"ROOM");
                } else {
                    $this->updateWardOccupancy($newInPatientDetails->patientid,$newInPatientDetails->ward);
                      $this->updatePatientWithOccupanyId($newInPatientDetails->appointmentid,$newInPatientDetails->ward,"WARD");
                }     
                
               
               
                return $finalUser;
                
        } catch(PDOException $pdoex) {
            throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
    }
    
    
    
    function updateRoomOccupancy($patientid,$roomid){
        
           try{
                $sql = "update rooms_details set occupancy = '$patientid' where id = $roomid";
               $dbConnection = new BusinessHSMDatabase();
                 $db = $dbConnection->getConnection(); 
                  $stmt = $db->prepare($sql);  
                   $stmt->execute();
                 $db = null;
                 $result = $this->fetchRoomIdBasedonRoomDetailsId($roomid);
                 $roomNameId = $result[0]->roomid;
                 $this->updateTotalRoomOccupied($patientid,$roomNameId);
                 
            } catch(PDOException $pdoex) {
           throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
    }
    
     function updateWardOccupancy($patientid,$wardid){
        
           try{
                $sql = "update wards_details set occupancy = '$patientid' where id = $wardid";
               $dbConnection = new BusinessHSMDatabase();
                 $db = $dbConnection->getConnection(); 
                  $stmt = $db->prepare($sql);  
                   $stmt->execute();
                 $db = null;
                 $result = $this->fetchWardIdBasedonWardDetailsId($wardid);
                 $wardNameId = $result[0]->wardid;
                 $this->updateTotalWardsOccupied($patientid,$wardNameId);
                 
            } catch(PDOException $pdoex) {
           throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
    }
    
   function updateTotalWardsOccupied($patientid,$wardid){
        
           try{
                $sql = "update ward set totaloccupied = (totaloccupied+1) where id = $wardid";
               $dbConnection = new BusinessHSMDatabase();
                 $db = $dbConnection->getConnection(); 
                  $stmt = $db->prepare($sql);  
                   $stmt->execute();
            
            } catch(PDOException $pdoex) {
           throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
    }
    
    function updateTotalRoomOccupied($patientid,$roomid){
        
           try{
                $sql = "update rooms set totaloccupied = (totaloccupied+1) where id = $roomid";
               $dbConnection = new BusinessHSMDatabase();
                 $db = $dbConnection->getConnection(); 
                  $stmt = $db->prepare($sql);  
                   $stmt->execute();
            
            } catch(PDOException $pdoex) {
           throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
    }
    
    function updatePatientWithOccupanyId($appointmentid,$occupancyid,$roomtype){
        
           try{
                $sql = "update appointment set occupancyid = $occupancyid,accomidationtype='$roomtype' where id = $appointmentid";
               $dbConnection = new BusinessHSMDatabase();
                 $db = $dbConnection->getConnection(); 
                  $stmt = $db->prepare($sql);  
                   $stmt->execute();
            
            } catch(PDOException $pdoex) {
           throw new Exception($pdoex);
         } catch(Exception $ex) {
            throw new Exception($ex);
         } 
    }
    
    function fetchRoomIdBasedonRoomDetailsId($roomdetailsid){
        
        $dbConnection = new HSMDatabase();
       $sql = "SELECT * from rooms_details where id = $roomdetailsid ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($roomDetails);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    
    function fetchWardIdBasedonWardDetailsId($warddetailsid){
        
        $dbConnection = new HSMDatabase();
       $sql = "SELECT * from wards_details where id = $warddetailsid ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($wardDetails);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function caluclatePatientBill($patientid,$appointmentid){
         $dbConnection = new HSMDatabase();
        $sql = "select * from inpatient where appointmentid = $appointmentid";
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($operationDetails);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function fetchWardChargesCostforGivenWardid($wardid){
        
        $sql = "select w.bedcost,cm.chargeid,cm.chargetype,e.chargetype,e.chargebleamount,
                sum(if(e.chargetype = 'Fixed',(w.bedcost+e.chargebleamount),w.bedcost+((w.bedcost*e.chargebleamount)/100))) as finalcost
                from charges_map cm,ward w,extracharges e where w.id = cm.applyid and w.id = $wardid and 
                e.id = cm.chargeid and cm.chargetype = 'CHARGES'   and cm.applyname = 'WARD'";
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardFinalCost = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($wardFinalCost[0]->finalcost);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function fetchWardTaxCostforGivenWardid($wardid){
        
        $sql = "select w.bedcost,cm.chargeid,cm.chargetype,t.taxrate,
                sum(w.bedcost+((w.bedcost*t.taxrate)/100)) as finalcost
                from charges_map cm,ward w,tax t where w.id = cm.applyid and w.id = $wardid and 
                t.id = cm.chargeid and cm.chargetype = 'TAX'  and cm.applyname = 'WARD'";
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxFinalCost = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($taxFinalCost[0]->finalcost);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function fetchRoomTaxCostforGivenWardid($roomid){
        
        $sql = "select r.roomcost,cm.chargeid,cm.chargetype,t.taxrate,
                sum(r.roomcost+((r.roomcost*t.taxrate)/100)) as finalcost
                from charges_map cm,rooms r,tax t where r.id = cm.applyid and r.id = $roomid and 
                t.id = cm.chargeid and cm.chargetype = 'TAX'  and cm.applyname = 'ROOM'";
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxFinalCost = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($taxFinalCost[0]->finalcost);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function fetchRoomChargesCostforGivenWardid($roomid){
        
        $sql = "select r.roomcost,cm.chargeid,cm.chargetype,e.chargetype,e.chargebleamount,
                (if(e.chargetype = 'Fixed',(r.roomcost+e.chargebleamount),r.roomcost+((r.roomcost*e.chargebleamount)/100))) as finalcost
                from charges_map cm,rooms r,extracharges e where r.id = cm.applyid and r.id = $roomid and 
                e.id = cm.chargeid and cm.chargetype = 'CHARGES'  and cm.applyname = 'ROOM' ";
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargesFinalCost = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($chargesFinalCost[0]->finalcost);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function fetchOperationChargesCostforGivenWardid($operationid){
        
        $sql = "select r.roomcost,cm.chargeid,cm.chargetype,e.chargetype,e.chargebleamount,
                (if(e.chargetype = 'Fixed',(r.roomcost+e.chargebleamount),r.roomcost+((r.roomcost*e.chargebleamount)/100))) as finalcost
                from charges_map cm,rooms r,extracharges e where r.id = cm.applyid and r.id = $roomid and 
                e.id = cm.chargeid and cm.chargetype = 'CHARGES' ";
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargesFinalCost = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($chargesFinalCost[0]->finalcost);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
    
    function fetchOperationforGivenAppointment($appointmentid){
        $dbConnection = new HSMDatabase();
        $sql = "select operation from inpatient where appointmentid = $appointmentid";
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              return ($operationDetails);
             } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
}
