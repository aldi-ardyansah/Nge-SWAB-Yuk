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

    $POST_NIK = $_POST["Add_NIK"];
    $POST_Password = $_POST["Add_Password"];
    $POST_Name = $_POST["Add_Name"];
    $POST_Access = $_POST["Add_Access"];

    mysqli_query(
        $sql_connection,
        "INSERT INTO tb_a_accounts (NIK, Password, Name, Access)
        VALUES ('$POST_NIK', '$POST_Password', '$POST_Name', '$POST_Access')"
    );

    header("Location: admin_c_accounts.php");
    exit;
?>