<?php
    session_start();

    if (
        !isset($_SESSION["NIK"], $_SESSION["Access"]) ||
        $_SESSION["Access"] !== "User"
    ) {
        header("Location: index.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: user_b_swab_a_zone-1.php");
        exit;
    }

    require_once("sql_connection.php");

    $POST_ID = uniqid();
    $POST_Analysis_Date = $_POST["Add_Analysis_Date"];
    $POST_Area = $_POST["Add_Area"];
    $POST_Zone_1_Machine = $_POST["Add_Zone_1_Machine"];
    $POST_SWAB_Point = $_POST["Add_SWAB_Point"];
    $POST_TPC = $_POST["Add_TPC"];
    $POST_Enterobacteriaceae = $_POST["Add_Enterobacteriaceae"];
    $POST_Notes = $_POST["Add_Notes"];

    mysqli_query(
        $sql_connection,
        "INSERT INTO tb_b_swab_zone_1 (ID, Analysis_Date, Area, Zone_1_Machine, SWAB_Point, TPC, Enterobacteriaceae, Notes)
        VALUES ('$POST_ID','$POST_Analysis_Date', '$POST_Area', '$POST_Zone_1_Machine', '$POST_SWAB_Point', '$POST_TPC', '$POST_Enterobacteriaceae', '$POST_Notes')"
    );

    header("Location: user_b_swab_a_zone-1.php");
    exit;
?>