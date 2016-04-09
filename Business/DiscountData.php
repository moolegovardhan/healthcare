<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiscountData
 *
 * @author pkumarku
 */
class DiscountData {
    
    
    function createDiscount($discounttype,$instType,$discAmount,$instId,$cgsdiscount){
        echo "Inst id .......".$instId;echo "<br/>";
           $cardType = "ALL";
           $discounttype = "Percent";
      try{
                $dbConnection = new BusinessHSMDatabase();   
              $sql = "INSERT INTO discounts (discounttype, endtype,endid,discpercent,status,createddate,createdby,cardtype,cgsdiscount)"
                      . " VALUES (:discounttype, :endtype, :endid, :discpercent, 'Y',CURDATE(),:userid,:cardtype,:cgsdiscount)";
                        $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);
                        $userid = $_SESSION['userid'];
                        $stmt->bindParam("discounttype", $discounttype);
                        $stmt->bindParam("endtype", $instType);
                        $stmt->bindParam("endid", $instId);
                        $stmt->bindParam("discpercent", $discAmount);
                        $stmt->bindParam("userid", $userid);
                        $stmt->bindParam("cardtype", $cardType);
                        $stmt->bindParam("cgsdiscount", $cgsdiscount);
                        $stmt->execute();
                //echo "Last Insert Id".$db->lastInsertId();
                        $user = $db->lastInsertId();
                        //var_dump($user);
                        $db = null;
                        return ($user);

              } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                } 

    }
    
    function updateDiscountPercentage($instId,$discAmount,$cgsdiscount){
         echo "Inst id .......".$instId;echo "<br/>";
         $dbConnection = new BusinessHSMDatabase();   
         
         $sql = "update discounts set discpercent = :discpercent,createdby = :createdby,cgsdiscount = $cgsdiscount where endid = :endid";
         try{
        //   echo $sql;  
            $userid = $_SESSION['userid'];
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("discpercent", $discAmount); 
             $stmt->bindParam("endid", $instId);
              $stmt->bindParam("createdby", $userid);
             $stmt->execute();  
               $db = null;
                return "Success";
            
            
        } catch(PDOException $pdoex) {
            echo $pdoex->getMessage();
            throw new Exception($pdoex);
         } catch(Exception $ex) {
             echo $ex->getMessage();
            throw new Exception($ex);
         } 
    }
    
    
    function fetchInstitution($instid){
        
         $dbConnection = new BusinessHSMDatabase();
       
         $sql = "SELECT * from discounts where status = 'Y' and endid = :instid";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("instid", $instid); 
                $stmt->execute();
                $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return ($diagnostics);



            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
                echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            } 
        
        
    }
}
