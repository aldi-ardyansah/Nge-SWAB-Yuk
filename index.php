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
                <form action="index_login.php" method="post">
                    <div class="mb-4">
                        <label for="NIK" class="form-label">NIK (Nomor Induk Karyawan)</label>
                        <input type="text" class="form-control" id="NIK" name="NIK" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" required>
                    </div>
                    <div class="d-grid">
                        <input class="btn btn-primary" type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>