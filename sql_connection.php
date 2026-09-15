<?php
    if (basename($_SERVER["SCRIPT_FILENAME"]) === basename(__FILE__)) {
        header("Location: index.php");
        exit;
    }

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "nge-swab-yuk";

    $sql_connection = mysqli_connect($host, $username, $password, $database);

    if (!$sql_connection) {
        header("Location: index.php");
        exit;
    }
?>