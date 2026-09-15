<?php
    session_start();

    if (
        !isset($_SESSION["NIK"], $_SESSION["Access"]) ||
        $_SESSION["Access"] !== "Administrator"
    ) {
        header("Location: index.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: admin_c_accounts.php");
        exit;
    }

    require_once("sql_connection.php");

    $POST_NIK = $_POST["Edit_NIK"];
    $POST_Password = $_POST["Edit_Password"];
    $POST_Name = $_POST["Edit_Name"];
    $POST_Access = $_POST["Edit_Access"];

    mysqli_query(
        $sql_connection,
        "UPDATE tb_a_accounts
        SET
            Password = '$POST_Password',
            Name = '$POST_Name',
            Access = '$POST_Access'
        WHERE NIK = '$POST_NIK'"
    );

    header("Location: admin_c_accounts.php");
    exit;
?>