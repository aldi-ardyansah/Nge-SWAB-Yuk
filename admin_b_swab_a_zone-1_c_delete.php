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
        header("Location: admin_b_swab_a_zone-1.php");
        exit;
    }

    require_once("sql_connection.php");

    $POST_ID = $_POST["ID"];

    mysqli_query(
        $sql_connection,
        "DELETE FROM tb_b_swab_zone_1 WHERE ID = '$POST_ID'"
    );

    header("Location: admin_b_swab_a_zone-1.php");
    exit;
?>