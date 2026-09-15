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

    $POST_ID = uniqid();
    $POST_Analysis_Date = $_POST["Analysis_Date"];
    $POST_Area = $_POST["Area"];
    $POST_Zone_1_Machine = $_POST["Zone_1_Machine"];
    $POST_SWAB_Point = $_POST["SWAB_Point"];
    $POST_TPC = $_POST["TPC"];
    $POST_Enterobacteriaceae = $_POST["Enterobacteriaceae"];
    $POST_Notes = $_POST["Notes"];

    mysqli_query(
        $sql_connection,
        "INSERT INTO tb_b_swab_zone_1 (ID, Analysis_Date, Area, Zone_1_Machine, SWAB_Point, TPC, Enterobacteriaceae, Notes)
        VALUES ('$POST_ID','$POST_Analysis_Date', '$POST_Area', '$POST_Zone_1_Machine', '$POST_SWAB_Point', '$POST_TPC', '$POST_Enterobacteriaceae', '$POST_Notes')"
    );

    header("Location: admin_b_swab_a_zone-1.php");
    exit;
?>