<?php

require "../vendor/autoload.php";
require "./services/MidtermService.php";

Flight::register('midtermService', 'MidtermService');

Flight::route('/',function(){
    echo'Flight works';
    try {

        /** TODO
        * List parameters such as servername, username, password, schema. Make sure to use appropriate port
        */

        $servername = '127.0.0.1';
        $username = 'root' ;
        $password = '';
        $dbname = 'midterm-exam';


        /** TODO
        * Create new connection
        */
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


        // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    
});

require 'routes/MidtermRoutes.php';

Flight::start();
 ?>
