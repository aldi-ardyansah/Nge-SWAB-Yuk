<?php
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: index.php");
        exit;
    }

    session_start();

    require_once("sql_connection.php");

    $POST_NIK = $_POST["NIK"];
    $POST_Password = $_POST["Password"];

    $SQL_Query = mysqli_query(
        $sql_connection,
        "SELECT * FROM tb_a_accounts WHERE NIK = '$POST_NIK'"
    );

    if (mysqli_num_rows($SQL_Query) > 0) {
        $SQL_Fetch = mysqli_fetch_array($SQL_Query);

        if ($SQL_Fetch["Password"] === $POST_Password) {
            $_SESSION["NIK"] = $SQL_Fetch["NIK"];
            $_SESSION["Name"] = $SQL_Fetch["Name"];
            $_SESSION["Access"] = $SQL_Fetch["Access"];
            if ($SQL_Fetch["Access"] === "Administrator") {
                header("Location: admin_a_home.php");
                exit;
            }
            elseif ($SQL_Fetch["Access"] === "User") {
                header("Location: user_a_home.php");
                exit;
            }
        }
        else {
            $_SESSION["Failed"] = "Password";
            header("Location: index_login_failed.php");
            exit;
        }
    }
    else {
        $_SESSION["Failed"] = "NIK";
        header("Location: index_login_failed.php");
        exit;
    }
?>