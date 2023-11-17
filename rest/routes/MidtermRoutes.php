<?php


Flight::route('GET /midterm/connection-check', function(){
    /** TODO
    * This endpoint prints the message from constructor within MidtermDao class
    * Goal is to check whether connection is successfully established or not
    * This endpoint does not have to return output in JSON format
    */

    $object = new MidtermDao;
});

Flight::route('POST /midterm/input_data', function(){
    /** TODO
    * This endpoint is used to insert IP2LOCATION.json file content to database table locations
    * This endpoint should return output in JSON format
    */

    echo'test';

    $json = file_get_contents('C:\xampp\htdocs\kerimceljo\IP2LOCATION.json');
    $json_decoded = json_decode( $json, true ); 

    // JSON_UNESCAPED_UNICODE

    $midtermDao = new MidtermDao;
    $midtermDao->input_data($json_decoded);
});


Flight::route('GET /midterm/summary', function(){
    /** TODO
    * This endpoint is used to return total number of countries, regions and cities from locations table
    * This endpoint should return output in JSON format
    */

    $object = new MidtermDao;  
    // var_dump($object->summary());
    Flight::json($object->summary());
});

Flight::route("GET /midterm/report_per_country", function(){
    /** TODO
    * This endpoint is used to create report that shows countries and
    * total number of cities in each country.
    * This report should be generated using single query.
    * This endpoint should return output in JSON format
    */

    $object = new MidtermDao;  
    // var_dump($object->summary());
    Flight::json($object->report_per_country());
});

Flight::route("GET /midterm/search(/@from/@to)", function($from, $to){
    /** TODO
    * This endpoint is used to return location or locations (country, region and city)
    * by given parameters 'from' and 'to'
    * Do not modify route by adding parameters to it
    * Parameters are not required
    * If parameters are not provided return all locations
    * This endpoint should return output in JSON format
    */

    $object = new MidtermDao;  
    // var_dump($object->summary());
    Flight::json($object->search($from, $to));


});

?>
