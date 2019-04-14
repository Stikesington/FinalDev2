<?php
 define('DB_DSN','mysql:host=localhost;port=3306;dbname=dotahero;charset=utf8');
 define('DB_USER','admin1');
 define('DB_PASS','EZq4nwWbpHVAYn95');

    try{
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    }catch(PDOException $e){
        print "error:" . $e->getMessage();
        die(); //force execution to stop on errors


    }
?>