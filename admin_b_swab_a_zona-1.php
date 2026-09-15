<?php
    session_start();

    if (
        !isset($_SESSION["NIK"], $_SESSION["Access"]) ||
        $_SESSION["Access"] !== "Administrator"
    ) {
        header("Location: index.php");
        exit;
    }

    require_once("sql_connection.php");

    $SQL_Query = mysqli_query(
        $sql_connection,
        "SELECT * FROM tb_b_swab_zona_1"
    );
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nge-SWAB Yuk!</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="assets/GDA.svg">
    </head>

    <body style="background-color: rgb(31 46 153);">
        <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;" data-bs-theme="light">
            <div class="container-fluid">
                <a class="navbar-brand">
                    <img src="assets/GDA.svg" alt="GDA" width="60" height="48">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_a_home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_b_swab.php">SWAB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_c_accounts.php">Accounts</a>
                        </li>
                    </ul>

                    <form action="logout.php" method="post" class="ms-auto">
                        <button type="submit" class="btn btn-secondary ms-lg-3 mt-3 mt-lg-0">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

<div class="container-fluid p-4" style="background-color: rgb(255 255 255);">
            <h2 class="text-center mb-4">SWAB Zona 1</h2>
            <hr>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccounts">
                    Add Accounts
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Area</th>
                            <th scope="col">Mesin Zona 1</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Tanggal Analisa</th>
                            <th scope="col">Titik SWAB</th>
                            <th scope="col">TPC</th>
                            <th scope="col">Enterobacteriaceae</th>
                            <th scope="col">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($SQL_Fetch = mysqli_fetch_array($SQL_Query)) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($SQL_Fetch["Area"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Mesin_Zona_1"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Bulan"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Tanggal_Analisa"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Titik_SWAB"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["TPC"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Enterobacteriaceae"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Notes"]) ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>