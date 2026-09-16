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
        header("Location: admin_b_swab_a_zone-2.php");
        exit;
    }

    require_once("sql_connection.php");

    $POST_ID = $_POST["Edit_ID"];
    $POST_Analysis_Date = $_POST["Edit_Analysis_Date"];
    $POST_Area = $_POST["Edit_Area"];
    $POST_Zone_2_Machine = $_POST["Edit_Zone_2_Machine"];
    $POST_SWAB_Point = $_POST["Edit_SWAB_Point"];
    $POST_TPC = $_POST["Edit_TPC"];
    $POST_Enterobacteriaceae = $_POST["Edit_Enterobacteriaceae"];
    $POST_Notes = $_POST["Edit_Notes"];

    mysqli_query(
        $sql_connection,
        "UPDATE tb_b_swab_zone_2
        SET
            Analysis_Date = '$POST_Analysis_Date',
            Area = '$POST_Area',
            Zone_2_Machine = '$POST_Zone_2_Machine',
            SWAB_Point = '$POST_SWAB_Point',
            TPC = '$POST_TPC',
            Enterobacteriaceae = '$POST_Enterobacteriaceae',
            Notes = '$POST_Notes'
        WHERE ID = '$POST_ID'"
    );

    header("Location: admin_b_swab_a_zone-2.php");
    exit;
?>