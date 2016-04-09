<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSMRegistrationLogin
 *
 * @author pkumarku
 */
class HSMRegistrationLogin {
    
    
    function authenticateUser($userId,$password){
        $decryptPassword = new EncryptDecryptData();
        
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.username = :username";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                //$stmt->bindParam("password", $password);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
               
                if(count($userDetails) > 0){
                    
                    $fetchedPassword = $userDetails[0]->password;
                    $decodedPassword = $decryptPassword->decryptData($fetchedPassword);
                     if($password == $decodedPassword){
                         return  $userDetails;
                     }else {
                        
                         return new ArrayObject();
                     }
                }else{
                    return new ArrayObject();
                }
                
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}
 /*
        function dumpData($data){
             $log = new Logging();
             $log->lfile('../Errors/error_log.log');
             $log->lwrite($data);
        }

       function writeLogs($e,$type){
             $log = new Logging();
             $log->lfile('../Errors/error_log.log');
             
            $log->lwrite($e->getMessage());

            if($type == "Exception"){
                $log->lwrite("REST FILE");
                $log->lwrite($e->getFile());
                $log->lwrite($e->getLine());
                $log->lwrite($e->getTraceAsString());

            }
        } 
        */
function authenticateUseridandMobile($userId,$mobile){
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.username = :username and u.mobile = :mobile";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                $stmt->bindParam("mobile", $mobile);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
                return $userDetails;
           } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}

function changePassword($userid,$password){
    $encryptPassword = new EncryptDecryptData();
    $password = $encryptPassword->encryptData($password);
     $sql = "update users set password = :password where username = :userid";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $stmt->bindParam("userid", $userid);    //echo "Hello ";
            $stmt->bindParam("password", $password); //   echo "Hello ";
           
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
}

function  activateUser($userid){
    
     $encryptPassword = new EncryptDecryptData();
    $password = $encryptPassword->encryptData($password);
     $sql = "update users set status = 'Y' where username = :userid ";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $stmt->bindParam("userid", $userid); 
           
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
    
    
}

function checkOTP($userId,$otp){
    
    $sql = "select * from users where  username = :userid and otp = :otp";
    $dbConnection = new HSMDatabase();
    $db = $dbConnection->getConnection(); 
     $stmt = $db->prepare($sql);
     $stmt->bindParam("userid", $userId);    //echo "Hello ";
     $stmt->bindParam("otp", $otp); //   echo "Hello ";
     $stmt->execute();
     $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     
     return $userDetails;
     
}


function authenticateUserForIOS($userId,$password){
        $decryptPassword = new EncryptDecryptData();
        
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.username = :username";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                //$stmt->bindParam("password", $password);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
               
                if(count($userDetails) > 0){
                    
                    $fetchedPassword = $userDetails[0]->password;
                  //  echo "Fetched Password ".$fetchedPassword;echo "<br/>";
                    // echo "Passed Password ".$password;echo "<br/>";
                     $decodedPassword = $decryptPassword->decryptData($fetchedPassword);
                   // echo "decoded  Password ".$decodedPassword;echo "<br/>";
                     if($password == $decodedPassword){
                      //   echo "In success";echo "<br/>";
                      $userDetails[0]->password = $decodedPassword;
                         return  $userDetails;
                     }else {
                        // echo "Thanks Fail";
                         return new ArrayObject();
                     }
                }else{
                    return new ArrayObject();
                }
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}

}
