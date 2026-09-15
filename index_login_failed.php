<?php
    session_start();

    if (!isset($_SESSION["Failed"])) {
        header("Location: index.php");
        exit;
    }

    $failed = $_SESSION["Failed"];
    unset($_SESSION["Failed"]);
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
        <div class="container min-vh-100 d-flex align-items-center justify-content-center">
            <div class="card p-4" style="width: 800px; background-color: #e3f2fd;" data-bs-theme="light">
                <img src="assets/GDA.svg" class="card-img-top mx-auto mb-4" alt="Global Diari Alami" style="width: 18rem;">
                <h2 class="text-center mb-4">Nge-SWAB Yuk!</h2>
                <?php
                    if ($failed === "NIK") {
                        echo '<h4 class="text-danger mb-4">NIK Tidak Ditemukan!</h2>';
                    }
                    elseif ($failed === "Password") {
                        echo '<h4 class="text-danger mb-4">Password Salah!</h2>';
                    }
                ?>
                <a href="index.php" class="btn btn-secondary">
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>