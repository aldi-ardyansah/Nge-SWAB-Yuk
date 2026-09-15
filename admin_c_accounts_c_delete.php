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

    $POST_NIK = $_POST["NIK"];

    mysqli_query(
        $sql_connection,
        "DELETE FROM tb_a_accounts WHERE NIK = '$POST_NIK'"
    );

    header("Location: admin_c_accounts.php");
    exit;
?>