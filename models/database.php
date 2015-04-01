<?php
    
$server ='localhost';
$dbname = 'waloneth_padawancomposer';
$dsn = 'mysql:host='.$server.';dbname='.$dbname;
$username = 'waloneth';
$password = 'David Tenent Number 10';

    try {
        $db = new PDO($dsn, $username, $password);
       
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('view/errors/db_error.php');
        exit();
    }
?>
