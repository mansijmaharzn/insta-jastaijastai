<?php
    // host
    $host = "localhost";
    // database name
    $dbname = "insta-jastaijastai";
    // user
    $user = "root";
    // password
    $pass = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

    // if($conn == true) {
    //     echo "database is working";
    // } else {
    //     echo "database connection is wrong";
    // }
?>