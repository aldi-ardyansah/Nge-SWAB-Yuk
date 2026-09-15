<?php
    session_start();

    if (!isset($_SESSION["NIK"]) || $_SESSION["Access"] !== "Administrator") {
        header("Location: index.php");
        exit;
    }

    require_once("sql_connection.php");

    $Session_NIK = $_SESSION["NIK"];

    $SQL_Query = mysqli_query(
        $sql_connection,
        "SELECT * FROM tb_a_accounts WHERE NIK = '$Session_NIK'"
    );

    $SQL_Fetch = mysqli_fetch_array($SQL_Query);
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
                            <a class="nav-link active" href="admin_a_home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_b_swab.php">SWAB</a>
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
            <h2 class="text-center mb-4">Home</h2>
            <hr>
            <p>
                Prosedur EMP (Environment Monitoring Program) bertujuan untuk memverifikasi tindakan pencegahan kontaminasi dari lingkungan yang dilakukan. Tindakan pencegahan kontaminasi dari lingkungan dipersyaratkan dalam GMP (Good Manufacturing Practices). EMP dapat dijadikan sebagai pengingat dini adanya mikroorganisme patogen pada lokasi pengolahan pangan yang berpotensi mengontaminasi produk.
            </p>
            <p>Berdasarkan:</p>
            <ol>
                <li>Quality Management System (ISO 22000:2018).</li>
                <li>Manual PRP PT Global Dairi Alami.</li>
            </ol>
        </div>
        <div class="container-fluid p-4 text-white" style="background-color: rgb(31 46 153);">
            <div class="row">
                <div class="col-5 col-sm-2">
                    <h5>Accounts</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-2">
                    <h6>NIK:</h6>
                </div>
                <div class="col-7 col-sm-10">
                    <h6><?php echo $SQL_Fetch["NIK"]; ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-2">
                    <h6>Password:</h6>
                </div>
                <div class="col-7 col-sm-10">
                    <h6>
                        <span
                            id="passwordText"
                            data-password="<?php echo htmlspecialchars($SQL_Fetch["Password"], ENT_QUOTES, "UTF-8"); ?>"
                        >
                            ********
                        </span>

                        <span
                            id="passwordButton"
                            onclick="togglePassword()"
                            style="cursor: pointer; margin-left: 8px;"
                        >
                            👁
                        </span>
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-2">
                    <h6>Name:</h6>
                </div>
                <div class="col-7 col-sm-10">
                    <h6><?php echo $SQL_Fetch["Name"]; ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-2">
                    <h6>Access:</h6>
                </div>
                <div class="col-7 col-sm-10">
                    <h6><?php echo $SQL_Fetch["Access"]; ?></h6>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>

        <script>
            function togglePassword() {
                const passwordText = document.getElementById("passwordText");
                const passwordButton = document.getElementById("passwordButton");
                const password = passwordText.dataset.password;

                if (passwordText.textContent === "********") {
                    passwordText.textContent = password;
                    passwordButton.textContent = "🔒";
                } else {
                    passwordText.textContent = "********";
                    passwordButton.textContent = "👁";
                }
            }
        </script>
    </body>
</html>