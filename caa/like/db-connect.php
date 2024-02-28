<?php 
 
$host = "localhost"; 
$username = "root"; 
$pw = ""; 
$dbname = "galericaca";
 
$conn = new mysqli($host, $username, $pw, $dbname);
if(!$conn){
    die("Database connection failed. Error: " .$conn->error);
}