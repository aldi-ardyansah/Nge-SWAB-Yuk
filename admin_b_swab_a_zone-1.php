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
        "SELECT * FROM tb_b_swab_zone_1"
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
            <h2 class="text-center mb-4">SWAB Zone 1</h2>
            <hr>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSWABZone1">
                    Add SWAB Zone 1
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Analysis Date</th>
                            <th scope="col">Area</th>
                            <th scope="col">Zone 1 Machine</th>
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
                                <td><?= htmlspecialchars($SQL_Fetch["Zone_1_Machine"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["SWAB_Point"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["TPC"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Enterobacteriaceae"]) ?></td>
                                <td><?= htmlspecialchars($SQL_Fetch["Notes"]) ?></td>
                                <td>
                                    <div class="d-flex flex-nowrap gap-1">
                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editSWABZone1"
                                            data-id="<?= htmlspecialchars($SQL_Fetch["ID"]) ?>"
                                            data-analysis-date="<?= htmlspecialchars($SQL_Fetch["Analysis_Date"]) ?>"
                                            data-area="<?= htmlspecialchars($SQL_Fetch["Area"]) ?>"
                                            data-zone-one-machine="<?= htmlspecialchars($SQL_Fetch["Zone_1_Machine"]) ?>"
                                            data-swab-point="<?= htmlspecialchars($SQL_Fetch["SWAB_Point"]) ?>"
                                            data-tpc="<?= htmlspecialchars($SQL_Fetch["TPC"]) ?>"
                                            data-enterobacteriaceae="<?= htmlspecialchars($SQL_Fetch["Enterobacteriaceae"]) ?>"
                                            data-notes="<?= htmlspecialchars($SQL_Fetch["Notes"]) ?>">
                                            Edit
                                        </button>

                                        <form action="admin_b_swab_a_zone-1_c_delete.php" method="post">
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

        <!-- Modal addSWABZone1 -->
        <div class="modal fade" id="addSWABZone1" tabindex="-1" aria-labelledby="addSWABZone1Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="admin_b_swab_a_zone-1_a_add.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addSWABZone1Label">Add SWAB Zone 1</h1>
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
                                <label for="Add_Zone_1_Machine" class="form-label">Zone 1 Machine</label>
                                <select class="form-select" id="Add_Zone_1_Machine" aria-label="Add_Zone_1_Machine" name="Add_Zone_1_Machine" required>
                                    <option value="">- Select -</option>
                                    <option value="A3CF Machine">A3CF Machine</option>
                                    <option value="A3S Machine">A3S Machine</option>
                                    <option value="Aseptic Tank">Aseptic Tank</option>
                                    <option value="Cream Sterilizer">Cream Sterilizer</option>
                                    <option value="Filling TT3">Filling TT3</option>
                                    <option value="Homogenizer Cream">Homogenizer Cream</option>
                                    <option value="Homogenizer ESL">Homogenizer ESL</option>
                                    <option value="Homogenizer UHT">Homogenizer UHT</option>
                                    <option value="IPI Machine">IPI Machine</option>
                                    <option value="Milk Sterilizer ESL">Milk Sterilizer ESL</option>
                                    <option value="Milk Sterilizer UHT">Milk Sterilizer UHT</option>
                                    <option value="Mixing">Mixing</option>
                                    <option value="Product Line">Product Line</option>
                                    <option value="Silo">Silo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Add_SWAB_Point" class="form-label">SWAB Point</label>
                                <select class="form-select" id="Add_SWAB_Point" aria-label="Add_SWAB_Point" name="Add_SWAB_Point" required>
                                    <option value="">- Select -</option>
                                    <option value="A3CF Line Filter">A3CF Line Filter</option>
                                    <option value="Air Sterilization Valve">Air Sterilization Valve</option>
                                    <option value="A3Speed Line Filter">A3Speed Line Filter</option>
                                    <option value="A3S Encluster">A3S Encluster</option>
                                    <option value="Bulkline Filter">Bulkline Filter</option>
                                    <option value="Cook Silo Tank 1 Sample">Cook Silo Tank 1 Sample</option>
                                    <option value="Cook Silo Tank 2 Sample">Cook Silo Tank 2 Sample</option>
                                    <option value="Cook Silo Tank 3 Sample">Cook Silo Tank 3 Sample</option>
                                    <option value="Cook Silo Tank 4 Sample">Cook Silo Tank 4 Sample</option>
                                    <option value="Cook Silo Tank 5 Sample">Cook Silo Tank 5 Sample</option>
                                    <option value="Cook T411 Sample">Cook T411 Sample</option>
                                    <option value="Cook T412 Sample">Cook T412 Sample</option>
                                    <option value="Cook T413 Sample">Cook T413 Sample</option>
                                    <option value="Cook T414 Sample">Cook T414 Sample</option>
                                    <option value="Cream Aseptic Tank (T602)">Cream Aseptic Tank (T602)</option>
                                    <option value="Cream Homogenizer Inlet">Cream Homogenizer Inlet</option>
                                    <option value="Cream Homogenizer Outlet">Cream Homogenizer Outlet</option>
                                    <option value="Cream Sterilizer Balance Tank">Cream Sterilizer Balance Tank</option>
                                    <option value="Cream Sterilizer Inlet">Cream Sterilizer Inlet</option>
                                    <option value="Cream Sterilizer Outlet">Cream Sterilizer Outlet</option>
                                    <option value="Cream Tank">Cream Tank</option>
                                    <option value="ESL Balance Tank">ESL Balance Tank</option>
                                    <option value="ESL Homogenizer Inlet">ESL Homogenizer Inlet</option>
                                    <option value="ESL Homogenizer Outlet">ESL Homogenizer Outlet</option>
                                    <option value="ESL Sterilizer Filter">ESL Sterilizer Filter</option>
                                    <option value="ESL Sterilizer Inlet">ESL Sterilizer Inlet</option>
                                    <option value="ESL Sterilizer Outlet">ESL Sterilizer Outlet</option>
                                    <option value="Filling Pipe">Filling Pipe</option>
                                    <option value="HI Housing">HI Housing</option>
                                    <option value="HI Nozzle">HI Nozzle</option>
                                    <option value="Lower Filling Tube">A3CF Lower Filling Tube</option>
                                    <option value="Milk Aseptic Tank (T601)">Milk Aseptic Tank (T601)</option>
                                    <option value="Milk Aseptic Tank (T603/T604)">Milk Aseptic Tank (T603/T604)</option>
                                    <option value="Nozzle Side 1.1">Nozzle Side 1.1</option>
                                    <option value="Nozzle Side 1.2">Nozzle Side 1.2</option>
                                    <option value="Nozzle Side 2.1">Nozzle Side 2.1</option>
                                    <option value="Nozzle Side 2.2">Nozzle Side 2.2</option>
                                    <option value="Outline Line T411">Outline Line T411</option>
                                    <option value="Outline Line T412">Outline Line T412</option>
                                    <option value="Outline Line T413">Outline Line T413</option>
                                    <option value="Outline Line T414">Outline Line T414</option>
                                    <option value="PHE Line to Homogenizer">PHE Line to Homogenizer</option>
                                    <option value="PHE Outlet to Homogenizer">PHE Outlet to Homogenizer</option>
                                    <option value="T401 Inlet PHE Line">T401 Inlet PHE Line</option>
                                    <option value="T401 Outlet PHE Line">T401 Outlet PHE Line</option>
                                    <option value="T402 Inlet PHE Line">T402 Inlet PHE Line</option>
                                    <option value="T402 Outlet PHE Line">T402 Outlet PHE Line</option>
                                    <option value="TT3-1 Line Filter">TT3-1 Line Filter</option>
                                    <option value="TT3-2 Line Filter">TT3-2 Line Filter</option>
                                    <option value="UHT Balance Tank">UHT Balance Tank</option>
                                    <option value="UHT Homogenizer Inlet">UHT Homogenizer Inlet</option>
                                    <option value="UHT Homogenizer Outlet">UHT Homogenizer Outlet</option>
                                    <option value="UHT Sterilizer Filter">UHT Sterilizer Filter</option>
                                    <option value="UHT Sterilizer Inlet">UHT Sterilizer Inlet</option>
                                    <option value="UHT Sterilizer Outlet">UHT Sterilizer Outlet</option>
                                    <option value="UHT Temperature Transmitter">UHT Temperature Transmitter</option>
                                    <option value="Upper Filling Tube">A3CF Upper Filling Tube</option>
                                    <option value="V1">V1</option>
                                    <option value="V2">V2</option>
                                    <option value="V3">V3</option>
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
                            <button type="submit" class="btn btn-primary">Add SWAB Zone 1</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editSWABZone1 -->
        <div class="modal fade" id="editSWABZone1" tabindex="-1" aria-labelledby="editSWABZone1Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="admin_b_swab_a_zone-1_b_edit.php" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editSWABZone1Label">Edit SWAB Zone 1</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Edit_ID" class="form-label">ID</label>
                                <input type="text" class="form-control" id="Edit_ID" name="Edit_ID" required readonly>
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
                                <label for="Edit_Zone_1_Machine" class="form-label">Zone 1 Machine</label>
                                <select class="form-select" id="Edit_Zone_1_Machine" aria-label="Edit_Zone_1_Machine" name="Edit_Zone_1_Machine" required>
                                    <option value="">- Select -</option>
                                    <option value="A3CF Machine">A3CF Machine</option>
                                    <option value="A3S Machine">A3S Machine</option>
                                    <option value="Aseptic Tank">Aseptic Tank</option>
                                    <option value="Cream Sterilizer">Cream Sterilizer</option>
                                    <option value="Filling TT3">Filling TT3</option>
                                    <option value="Homogenizer Cream">Homogenizer Cream</option>
                                    <option value="Homogenizer ESL">Homogenizer ESL</option>
                                    <option value="Homogenizer UHT">Homogenizer UHT</option>
                                    <option value="IPI Machine">IPI Machine</option>
                                    <option value="Milk Sterilizer ESL">Milk Sterilizer ESL</option>
                                    <option value="Milk Sterilizer UHT">Milk Sterilizer UHT</option>
                                    <option value="Mixing">Mixing</option>
                                    <option value="Product Line">Product Line</option>
                                    <option value="Silo">Silo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Edit_SWAB_Point" class="form-label">SWAB Point</label>
                                <select class="form-select" id="Edit_SWAB_Point" aria-label="Edit_SWAB_Point" name="Edit_SWAB_Point" required>
                                    <option value="">- Select -</option>
                                    <option value="A3CF Line Filter">A3CF Line Filter</option>
                                    <option value="Air Sterilization Valve">Air Sterilization Valve</option>
                                    <option value="A3Speed Line Filter">A3Speed Line Filter</option>
                                    <option value="A3S Encluster">A3S Encluster</option>
                                    <option value="Bulkline Filter">Bulkline Filter</option>
                                    <option value="Cook Silo Tank 1 Sample">Cook Silo Tank 1 Sample</option>
                                    <option value="Cook Silo Tank 2 Sample">Cook Silo Tank 2 Sample</option>
                                    <option value="Cook Silo Tank 3 Sample">Cook Silo Tank 3 Sample</option>
                                    <option value="Cook Silo Tank 4 Sample">Cook Silo Tank 4 Sample</option>
                                    <option value="Cook Silo Tank 5 Sample">Cook Silo Tank 5 Sample</option>
                                    <option value="Cook T411 Sample">Cook T411 Sample</option>
                                    <option value="Cook T412 Sample">Cook T412 Sample</option>
                                    <option value="Cook T413 Sample">Cook T413 Sample</option>
                                    <option value="Cook T414 Sample">Cook T414 Sample</option>
                                    <option value="Cream Aseptic Tank (T602)">Cream Aseptic Tank (T602)</option>
                                    <option value="Cream Homogenizer Inlet">Cream Homogenizer Inlet</option>
                                    <option value="Cream Homogenizer Outlet">Cream Homogenizer Outlet</option>
                                    <option value="Cream Sterilizer Balance Tank">Cream Sterilizer Balance Tank</option>
                                    <option value="Cream Sterilizer Inlet">Cream Sterilizer Inlet</option>
                                    <option value="Cream Sterilizer Outlet">Cream Sterilizer Outlet</option>
                                    <option value="Cream Tank">Cream Tank</option>
                                    <option value="ESL Balance Tank">ESL Balance Tank</option>
                                    <option value="ESL Homogenizer Inlet">ESL Homogenizer Inlet</option>
                                    <option value="ESL Homogenizer Outlet">ESL Homogenizer Outlet</option>
                                    <option value="ESL Sterilizer Filter">ESL Sterilizer Filter</option>
                                    <option value="ESL Sterilizer Inlet">ESL Sterilizer Inlet</option>
                                    <option value="ESL Sterilizer Outlet">ESL Sterilizer Outlet</option>
                                    <option value="Filling Pipe">Filling Pipe</option>
                                    <option value="HI Housing">HI Housing</option>
                                    <option value="HI Nozzle">HI Nozzle</option>
                                    <option value="Lower Filling Tube">A3CF Lower Filling Tube</option>
                                    <option value="Milk Aseptic Tank (T601)">Milk Aseptic Tank (T601)</option>
                                    <option value="Milk Aseptic Tank (T603/T604)">Milk Aseptic Tank (T603/T604)</option>
                                    <option value="Nozzle Side 1.1">Nozzle Side 1.1</option>
                                    <option value="Nozzle Side 1.2">Nozzle Side 1.2</option>
                                    <option value="Nozzle Side 2.1">Nozzle Side 2.1</option>
                                    <option value="Nozzle Side 2.2">Nozzle Side 2.2</option>
                                    <option value="Outline Line T411">Outline Line T411</option>
                                    <option value="Outline Line T412">Outline Line T412</option>
                                    <option value="Outline Line T413">Outline Line T413</option>
                                    <option value="Outline Line T414">Outline Line T414</option>
                                    <option value="PHE Line to Homogenizer">PHE Line to Homogenizer</option>
                                    <option value="PHE Outlet to Homogenizer">PHE Outlet to Homogenizer</option>
                                    <option value="T401 Inlet PHE Line">T401 Inlet PHE Line</option>
                                    <option value="T401 Outlet PHE Line">T401 Outlet PHE Line</option>
                                    <option value="T402 Inlet PHE Line">T402 Inlet PHE Line</option>
                                    <option value="T402 Outlet PHE Line">T402 Outlet PHE Line</option>
                                    <option value="TT3-1 Line Filter">TT3-1 Line Filter</option>
                                    <option value="TT3-2 Line Filter">TT3-2 Line Filter</option>
                                    <option value="UHT Balance Tank">UHT Balance Tank</option>
                                    <option value="UHT Homogenizer Inlet">UHT Homogenizer Inlet</option>
                                    <option value="UHT Homogenizer Outlet">UHT Homogenizer Outlet</option>
                                    <option value="UHT Sterilizer Filter">UHT Sterilizer Filter</option>
                                    <option value="UHT Sterilizer Inlet">UHT Sterilizer Inlet</option>
                                    <option value="UHT Sterilizer Outlet">UHT Sterilizer Outlet</option>
                                    <option value="UHT Temperature Transmitter">UHT Temperature Transmitter</option>
                                    <option value="Upper Filling Tube">A3CF Upper Filling Tube</option>
                                    <option value="V1">V1</option>
                                    <option value="V2">V2</option>
                                    <option value="V3">V3</option>
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
                            <button type="submit" class="btn btn-warning">Edit SWAB Zone 1</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>

        <script>
            const addSWABZone1Modal = document.getElementById("addSWABZone1");

            addSWABZone1Modal.addEventListener("shown.bs.modal", function () {
                document.getElementById("Add_Analysis_Date").focus();
            });
        </script>

        <script>
            document.querySelectorAll(".btn-edit").forEach(function (button) {
                button.addEventListener("click", function () {
                    document.getElementById("Edit_ID").value = this.dataset.id;
                    document.getElementById("Edit_Analysis_Date").value = this.dataset.analysisDate;
                    document.getElementById("Edit_Area").value = this.dataset.area;
                    document.getElementById("Edit_Zone_1_Machine").value = this.dataset.zoneOneMachine;
                    document.getElementById("Edit_SWAB_Point").value = this.dataset.swabPoint;
                    document.getElementById("Edit_TPC").value = this.dataset.tpc;
                    document.getElementById("Edit_Enterobacteriaceae").value = this.dataset.enterobacteriaceae;
                    document.getElementById("Edit_Notes").value = this.dataset.notes;
                });
            });
        </script>
    </body>
</html>