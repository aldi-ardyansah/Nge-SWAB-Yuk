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
        "SELECT * FROM tb_a_accounts"
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
                            <a class="nav-link" href="admin_b_swab.php">SWAB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_c_accounts.php">Accounts</a>
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
            <h2 class="text-center mb-4">Accounts</h2>
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
                            <th scope="col">NIK</th>
                            <th scope="col">Password</th>
                            <th scope="col">Name</th>
                            <th scope="col">Access</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($SQL_Fetch = mysqli_fetch_array($SQL_Query)) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($SQL_Fetch["NIK"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Password"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Name"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Access"]) ?></td>
                                <td>
                                    <div class="d-flex flex-nowrap gap-1">
                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editAccounts"
                                            data-nik="<?= htmlspecialchars($SQL_Fetch["NIK"]) ?>"
                                            data-password="<?= htmlspecialchars($SQL_Fetch["Password"]) ?>"
                                            data-name="<?= htmlspecialchars($SQL_Fetch["Name"]) ?>"
                                            data-access="<?= htmlspecialchars($SQL_Fetch["Access"]) ?>">
                                            Edit
                                        </button>

                                        <form action="admin_c_accounts_c_delete.php" method="post">
                                            <input type="hidden" name="NIK"
                                                value="<?= htmlspecialchars($SQL_Fetch["NIK"]) ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal addAccounts -->
        <div class="modal fade" id="addAccounts" tabindex="-1" aria-labelledby="addAccountsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="admin_c_accounts_a_add.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addAccountsLabel">Add Accounts</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="NIK" class="form-label">NIK</label>
                                <input type="number" class="form-control" id="NIK" name="NIK" required>
                            </div>
                            <div class="mb-3">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="Name" name="Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="Access" class="form-label">Access</label>
                                <select class="form-select" aria-label="Access" name="Access" required>
                                    <option value="Administrator">Administrator</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Accounts</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editAccounts -->
        <div class="modal fade" id="editAccounts" tabindex="-1" aria-labelledby="editAccountsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="admin_c_accounts_b_edit.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editAccountsLabel">Edit Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Edit_NIK" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="Edit_NIK" name="NIK" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="Edit_Password" name="Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="Edit_Name" name="Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Access" class="form-label">Access</label>
                                <select class="form-select" id="Edit_Access"
                                        name="Access" required>
                                    <option value="Administrator">Administrator</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit Accounts</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>

        <script>
            const addAccountsModal = document.getElementById("addAccounts");

            addAccountsModal.addEventListener("shown.bs.modal", function () {
                document.getElementById("NIK").focus();
            });
        </script>

        <script>
            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    document.getElementById("Edit_NIK").value = this.dataset.nik;
                    document.getElementById("Edit_Password").value = this.dataset.password;
                    document.getElementById("Edit_Name").value = this.dataset.name;
                    document.getElementById("Edit_Access").value = this.dataset.access;
                });
            });
        </script>
    </body>
</html>