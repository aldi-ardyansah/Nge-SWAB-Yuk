<?php
    session_start();

    if (!isset($_SESSION["NIK"]) || $_SESSION["Access"] !== "Administrator") {
        header("Location: index.php");
        exit;
    }
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
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Zona 1</h5>
                            <p class="card-text">Permukaan kontak pangan (kontak langsung), misalnya pipa filling, tangki mixing, dll.</p>
                            <a href="admin_b_swab_a_zona-1.php" class="btn btn-danger">SWAB Zona 1</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Zona 2</h5>
                            <p class="card-text">Permukaan tidak kontak pangan yang dekat dengan pangan dan permukaan kontak pangan, misalnya bagian luar pipa filling, bagian luar tangki mixing, dll.</p>
                            <a href="admin_b_swab_a_zona-2.php" class="btn btn-warning">SWAB Zona 2</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Zona 3</h5>
                            <p class="card-text">Permukaan tidak kontak pangan yang jauh di dalam atau dekat area pengolahan, misalnya meja kerja filling dan meja kerja proses.</p>
                            <a href="admin_b_swab_a_zona-3.php" class="btn btn-success">SWAB Zona 3</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Zona 4</h5>
                            <p class="card-text">Permukaan tidak kontak pangan di luar area pengolahan, misalnya loker, kantin, dan kantor.</p>
                            <a href="admin_b_swab_a_zona-4.php" class="btn btn-primary">SWAB Zona 4</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>