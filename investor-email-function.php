<?php
require_once "BaseDao.php";

class MidtermDao extends BaseDao {

    public function __construct(){
        parent::__construct();
    }

    /** TODO
    * Implement DAO method used add new investor to investor table and cap-table
    */
    public function investor(){

    }

    /** TODO
    * Implement DAO method to validate email format and check if email exists
    */
    public function investor_email($email){

        
        // Using PHP built in filter_var function we are checking if mail
        // is invalid to return the error and continue on otherwise  
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return "Bad email";
        }
    
        $stmt = $this->conn->prepare("SELECT * FROM investors where email = '$email';");
        $stmt->execute();
        $result = $stmt->fetchAll();
       
        // Using PHP built in function empty we are checking if our results are empty
        if(!empty($result)){ 
            
            // we are accessing the 0 index because mail is
            // unique and only one user can have that email if its found
            $first_name = $result[0]["first_name"];
            $last_name = $result[0]["last_name"];

            return "Investor $first_name $last_name' uses this email address";
        }


        return "Investor with this email does not exists in database";

    }

    /** TODO
    * Implement DAO method to return list of investors according to instruction in MidtermRoutes.php
    */
    public function investors(){

    }

}
?>
