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
        "SELECT * FROM tb_b_swab_zone_2"
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
            <h2 class="text-center mb-4">SWAB Zone 2</h2>
            <hr>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSWABZone2">
                    Add SWAB Zone 2
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Analysis Date</th>
                            <th scope="col">Area</th>
                            <th scope="col">Zone 2 Machine</th>
                            <th scope="col">SWAB Point</th>
                            <th scope="col">TPC (100 CFU/100 cm²)</th>
                            <th scope="col">Enterobacteriaceae (10 CFU/100 cm²)</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($SQL_Fetch = mysqli_fetch_array($SQL_Query)) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($SQL_Fetch["Analysis_Date"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Area"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Zone_2_Machine"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["SWAB_Point"]) ?></td>
                                <td class="<?= $SQL_Fetch["TPC"] < 100 ? 'table-success' : 'table-danger' ?>">
                                    <?= htmlspecialchars($SQL_Fetch["TPC"]) ?>
                                </td>
                                <td class="<?= $SQL_Fetch["Enterobacteriaceae"] < 10 ? 'table-success' : 'table-danger' ?>">
                                    <?= htmlspecialchars($SQL_Fetch["Enterobacteriaceae"]) ?>
                                </td>
                                <td><?= htmlspecialchars($SQL_Fetch["Notes"]) ?></td>
                                <td>
                                    <div class="d-flex flex-nowrap gap-1">
                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editSWABZone2"
                                            data-id="<?= htmlspecialchars($SQL_Fetch["ID"]) ?>"
                                            data-analysis-date="<?= htmlspecialchars($SQL_Fetch["Analysis_Date"]) ?>"
                                            data-area="<?= htmlspecialchars($SQL_Fetch["Area"]) ?>"
                                            data-zone-two-machine="<?= htmlspecialchars($SQL_Fetch["Zone_2_Machine"]) ?>"
                                            data-swab-point="<?= htmlspecialchars($SQL_Fetch["SWAB_Point"]) ?>"
                                            data-tpc="<?= htmlspecialchars($SQL_Fetch["TPC"]) ?>"
                                            data-enterobacteriaceae="<?= htmlspecialchars($SQL_Fetch["Enterobacteriaceae"]) ?>"
                                            data-notes="<?= htmlspecialchars($SQL_Fetch["Notes"]) ?>">
                                            Edit
                                        </button>

                                        <form action="admin_b_swab_a_zone-2_c_delete.php" method="post">
                                            <input type="hidden" name="ID"
                                                value="<?= htmlspecialchars($SQL_Fetch["ID"]) ?>">
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

        <!-- Modal addSWABZone2 -->
        <div class="modal fade" id="addSWABZone2" tabindex="-1" aria-labelledby="addSWABZone2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="admin_b_swab_a_zone-2_a_add.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addSWABZone2Label">Add SWAB Zone 2</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Add_Analysis_Date" class="form-label">Analysis Date</label>
                                <input type="date" class="form-control" id="Add_Analysis_Date" name="Add_Analysis_Date" required>
                            </div>
                            <div class="mb-3">
                                <label for="Add_Area" class="form-label">Area</label>
                                <select class="form-select" id="Add_Area" aria-label="Add_Area" name="Add_Area" required>
                                    <option value="">- Select -</option>
                                    <option value="Process">Process</option>
                                    <option value="Filling">Filling</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Add_Zone_2_Machine" class="form-label">Zone 2 Machine</label>
                                <select class="form-select" id="Add_Zone_2_Machine" aria-label="Add_Zone_2_Machine" name="Add_Zone_2_Machine" required>
                                    <option value="">- Select -</option>
                                    <option value="A3CF Machine">A3CF Machine</option>
                                    <option value="A3S Machine">A3S Machine</option>
                                    <option value="IPI Machine">IPI Machine</option>
                                    <option value="Milk Sterilizer ESL">Milk Sterilizer ESL</option>
                                    <option value="Milk Sterilizer UHT">Milk Sterilizer UHT</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Add_SWAB_Point" class="form-label">SWAB Point</label>
                                <select class="form-select" id="Add_SWAB_Point" aria-label="Add_SWAB_Point" name="Add_SWAB_Point" required>
                                    <option value="">- Select -</option>
                                    <option value="Final Folder A3CF">Final Folder A3CF</option>
                                    <option value="Final Folder A3S">Final Folder A3S</option>
                                    <option value="Inlet Chiller ESL">Inlet Chiller ESL</option>
                                    <option value="Inlet Chiller UHT">Inlet Chiller UHT</option>
                                    <option value="Jaw A3CF">Jaw A3CF</option>
                                    <option value="Jaw A3S">Jaw A3S</option>
                                    <option value="Pressure Roller IPI">Pressure Roller IPI</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Add_TPC" class="form-label">TPC (100 CFU/100 cm²)</label>
                                <input type="number" class="form-control" id="Add_TPC" name="Add_TPC" required>
                            </div>
                            <div class="mb-3">
                                <label for="Add_Enterobacteriaceae" class="form-label">Enterobacteriaceae (10 CFU/100 cm²)</label>
                                <input type="number" class="form-control" id="Add_Enterobacteriaceae" name="Add_Enterobacteriaceae" required>
                            </div>
                            <div class="mb-3">
                                <label for="Add_Notes" class="form-label">Notes</label>
                                <input type="text" class="form-control" id="Add_Notes" name="Add_Notes" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add SWAB Zone 2</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editSWABZone2 -->
        <div class="modal fade" id="editSWABZone2" tabindex="-1" aria-labelledby="editSWABZone2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="admin_b_swab_a_zone-2_b_edit.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editSWABZone2Label">Edit SWAB Zone 2</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="Edit_ID" name="Edit_ID" required hidden>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Analysis_Date" class="form-label">Analysis Date</label>
                                <input type="date" class="form-control" id="Edit_Analysis_Date" name="Edit_Analysis_Date" required>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Area" class="form-label">Area</label>
                                <select class="form-select" id="Edit_Area" aria-label="Edit_Area" name="Edit_Area" required>
                                    <option value="">- Select -</option>
                                    <option value="Process">Process</option>
                                    <option value="Filling">Filling</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Zone_2_Machine" class="form-label">Zone 2 Machine</label>
                                <select class="form-select" id="Edit_Zone_2_Machine" aria-label="Edit_Zone_2_Machine" name="Edit_Zone_2_Machine" required>
                                    <option value="">- Select -</option>
                                    <option value="A3CF Machine">A3CF Machine</option>
                                    <option value="A3S Machine">A3S Machine</option>
                                    <option value="IPI Machine">IPI Machine</option>
                                    <option value="Milk Sterilizer ESL">Milk Sterilizer ESL</option>
                                    <option value="Milk Sterilizer UHT">Milk Sterilizer UHT</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_SWAB_Point" class="form-label">SWAB Point</label>
                                <select class="form-select" id="Edit_SWAB_Point" aria-label="Edit_SWAB_Point" name="Edit_SWAB_Point" required>
                                    <option value="">- Select -</option>
                                    <option value="Final Folder A3CF">Final Folder A3CF</option>
                                    <option value="Final Folder A3S">Final Folder A3S</option>
                                    <option value="Inlet Chiller ESL">Inlet Chiller ESL</option>
                                    <option value="Inlet Chiller UHT">Inlet Chiller UHT</option>
                                    <option value="Jaw A3CF">Jaw A3CF</option>
                                    <option value="Jaw A3S">Jaw A3S</option>
                                    <option value="Pressure Roller IPI">Pressure Roller IPI</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_TPC" class="form-label">TPC (100 CFU/100 cm²)</label>
                                <input type="number" class="form-control" id="Edit_TPC" name="Edit_TPC" required>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Enterobacteriaceae" class="form-label">Enterobacteriaceae (10 CFU/100 cm²)</label>
                                <input type="number" class="form-control" id="Edit_Enterobacteriaceae" name="Edit_Enterobacteriaceae" required>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_Notes" class="form-label">Notes</label>
                                <input type="text" class="form-control" id="Edit_Notes" name="Edit_Notes" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Edit SWAB Zone 2</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>

        <script>
            const addSWABZone2Modal = document.getElementById("addSWABZone2");

            addSWABZone2Modal.addEventListener("shown.bs.modal", function () {
                document.getElementById("Add_Analysis_Date").focus();
            });
        </script>

        <script>
            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    document.getElementById("Edit_ID").value = this.dataset.id;
                    document.getElementById("Edit_Analysis_Date").value = this.dataset.analysisDate;
                    document.getElementById("Edit_Area").value = this.dataset.area;
                    document.getElementById("Edit_Zone_2_Machine").value = this.dataset.zoneTwoMachine;
                    document.getElementById("Edit_SWAB_Point").value = this.dataset.swabPoint;
                    document.getElementById("Edit_TPC").value = this.dataset.tpc;
                    document.getElementById("Edit_Enterobacteriaceae").value = this.dataset.enterobacteriaceae;
                    document.getElementById("Edit_Notes").value = this.dataset.notes;
                });
            });
        </script>
    </body>
</html>