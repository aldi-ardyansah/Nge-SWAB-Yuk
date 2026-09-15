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
    $POST_Analysis_Date = $_POST["Analysis_Date"];
    $POST_Area = $_POST["Area"];
    $POST_Zone_1_Machine = $_POST["Zone_1_Machine"];
    $POST_SWAB_Point = $_POST["SWAB_Point"];
    $POST_TPC = $_POST["TPC"];
    $POST_Enterobacteriaceae = $_POST["Enterobacteriaceae"];
    $POST_Notes = $_POST["Notes"];

    mysqli_query(
        $sql_connection,
        "UPDATE tb_b_swab_zone_1
        SET
            Analysis_Date = '$POST_ID',
            Analysis_Date = '$POST_Analysis_Date',
            Area = '$POST_Area',
            Zone_1_Machine = '$POST_Zone_1_Machine',
            SWAB_Point = '$POST_SWAB_Point',
            TPC = '$POST_TPC',
            Enterobacteriaceae = '$POST_Enterobacteriaceae',
            Notes = '$POST_Notes'
        WHERE ID = '$POST_ID'"
    );

    header("Location: admin_b_swab_a_zone-1.php");
    exit;
?>