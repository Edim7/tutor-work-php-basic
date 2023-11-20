<?php
require_once "BaseDao.php";

class MidtermDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct();
    }

    /** TODO
     * Implement DAO method used to add content to database
     */
    public function input_data($data)
    {

        // Initial approach where we only used a for loop and addslashes function

        // try {

        //     for($i=0; $i<count($data); $i++) {
        //         $sql = "INSERT INTO locations (from_value, to_value, code, Country, Region, City)
        //         VALUES ( '" 
        //         .addslashes($data[$i]['from_value']). "', '"
        //         .addslashes($data[$i]['to_value'])."', '" 
        //         .addslashes($data[$i]['code']). "', '"
        //         .addslashes($data[$i]['Country']). "', '"
        //         .addslashes($data[$i]['Region']). "', '"
        //         .addslashes($data[$i]['City'])."');";


        //         $this->conn->exec($sql);
        //         echo "New record created successfully";
        //     }
        // } catch (PDOException $e) {
        //     echo "There was an error";
        //     echo $sql . "<br>" . $e->getMessage();
        // }



        
        // Better version of the code using parameterized query

        $sql = "INSERT INTO locations (from_value, to_value, code, Country, Region, City)
        VALUES (:from_value, :to_value, :code, :Country, :Region, :City)";

        $statement = $this->conn->prepare($sql);

        foreach ($data as $dataRow) {

            foreach ($dataRow as $key => $value) {
                    $statement->bindValue(":$key", $value);
            }
            
            // Execute the prepared statement (we preped this statement in the foreach above) 
            $statement->execute();

            // Reset the bindings for the next iteration
            $statement->closeCursor();
        }

    }

    /** TODO
     * Implement DAO method to return summary as requested within route /midterm/summary
     */
    public function summary()
    {

        // $sql = "SELECT count(select DISTINCT Country,Region,City) FROM `locations`;";
        // $this->conn->exec($sql);


        $stmt = $this->conn->prepare("select COUNT(DISTINCT Country, Region, City) as summary FROM locations;");
        $stmt->execute();  
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   


    }

    /** TODO
     * Implement DAO method to return report as requested within route /midterm/report_per_country
     */
    public function report_per_country()
    {

        $stmt = $this->conn->prepare("select Country, count(DISTINCT City) as total_cities from locations GROUP BY Country");
        $stmt->execute();  
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }

    /** TODO
     * Implement DAO method to return location as requested within route /midterm/search
     */
    public function search($from, $to)
    {
        $stmt = '';

        if($from & $to) {
        $stmt = $this->conn->prepare("SELECT Country, Region, City from locations
        WHERE from_value = 
        ".$from ." AND to_value = " 
        .$to .";");
        } else {
            $stmt = $this->conn->prepare("SELECT Country, Region, City from locations;");
        }
        $stmt->execute();  
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    }
}
?>