<?php

$dsn = 'mysql:host=localhost;port=3306;dbname=flights_tracker';
$username = 'root';
$password = 'gruevski2000';


try{
    $db = new PDO($dsn, $username,$password);

} catch(PDOException $e){
    $error = "Database Error: ";
    $error .= $e->getMessage();
    error_log('PDO EXCEPTION: '.$error);
    include("view/error.php");
    exit();
}
?>