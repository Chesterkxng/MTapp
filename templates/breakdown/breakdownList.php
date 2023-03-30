<?php
session_start();
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Aeronef\AeronefRepository;
use Application\Model\Personal\PersonalRepository;
?>
<!doctype html>
<html lang="en">
<head>
    <title>MTapp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php require('templates/pagesComponents/navbar/navbarHeader.php'); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php require('templates/pagesComponents/navbar/navbar.php'); ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Breakdowns List</strong></h5>
        <div class="row mt-3">
            <div class="col-sm-12">
                <!--Striped table-->
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <table class="table table-striped" id="breakdowns-table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>NAME</th>
                                <th>BSM NUMBER</th>
                                <th>AFFECTED AERONEF </th>
                                <th>DESCRIPTION</th>
                                <th>FINDING DATE</th>
                                <th>FOUND BY</th>
                                <th>REPAIRING ACTION</th>
                                <th>REPAIRING STATUS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $aeronefRepository = new AeronefRepository();
                            $aeronefRepository->connection = new DatabaseConnection();
                            $personalRepository = new PersonalRepository();
                            $personalRepository->connection = new DatabaseConnection();
                            foreach ($breakdowns as $breakdown) {
                                $aeronef = $aeronefRepository->getAeronef($breakdown->aeronef_id);
                                $personal = $personalRepository->getPersonal($breakdown->personal_id);
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($i) ?></td>
                                    <td><?= htmlspecialchars($breakdown->name) ?></td>
                                    <td><?= htmlspecialchars($breakdown->bsm_number) ?></td>
                                    <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                    <td><?= htmlspecialchars($breakdown->description) ?></td>
                                    <td><?= htmlspecialchars($breakdown->finding_date) ?></td>
                                    <td><?= htmlspecialchars($personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name) ?></td>
                                    <td><?= htmlspecialchars($breakdown->action) ?></td>
                                    <?php switch ($breakdown->repairing_status) {
                                        case 0: ?>
                                            <td><label class="badge badge-danger badge-pill">Unstarted</label></td>
                                        <?php break;
                                        case 1: ?>
                                            <td><label class="badge badge-warning badge-pill">Pending</label></td>
                                    <?php break;
                                    } ?>
                                    <td class="align-middle text-center">
                                        <form style="display:inline;" action="index.php?action=updateBreakdownForm&breakdown_id=<?= $breakdown->breakdown_id ?>" method="post">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </form>
                                        <form style="display:inline;" action="index.php?action=deleteBreakdownPopup&breakdown_id=<?= $breakdown->breakdown_id ?>" method="post">
                                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                $i = $i + 1;
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <form style="display:inline;" action="index.php?action=breakdownAddingForm" method="post">
                                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--/Striped table-->
                <h5 class="mb-3"><strong>Breakdowns History</strong></h5>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Striped table-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <table class="table table-striped" id="breakdownsHistory-table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>NAME</th>
                                        <th>BSM NUMBER</th>
                                        <th>AFFECTED AERONEF </th>
                                        <th>DESCRIPTION</th>
                                        <th>FINDING DATE</th>
                                        <th>REPAIR END DATE</th>
                                        <th>FOUND BY</th>
                                        <th>REPAIRING ACTION</th>
                                        <th>REPAIRING STATUS</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $aeronefRepository = new AeronefRepository();
                                    $aeronefRepository->connection = new DatabaseConnection();
                                    $personalRepository = new PersonalRepository();
                                    $personalRepository->connection = new DatabaseConnection();
                                    foreach ($breakdownsHistory as $breakdown) {
                                        $aeronef = $aeronefRepository->getAeronef($breakdown->aeronef_id);
                                        $personal = $personalRepository->getPersonal($breakdown->personal_id);
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($i) ?></td>
                                            <td><?= htmlspecialchars($breakdown->name) ?></td>
                                            <td><?= htmlspecialchars($breakdown->bsm_number) ?></td>
                                            <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                            <td><?= htmlspecialchars($breakdown->description) ?></td>
                                            <td><?= htmlspecialchars($breakdown->finding_date) ?></td>
                                            <td><?= htmlspecialchars($breakdown->repair_end_date) ?></td>
                                            <td><?= htmlspecialchars($personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name) ?></td>
                                            <td><?= htmlspecialchars($breakdown->action) ?></td>
                                            <td><label class="badge badge-success badge-pill">repaired</label></td>
                                            <td class="align-middle text-center">
                                                <form style="display:inline;" action="index.php?action=deleteBreakdownPopup&breakdown_id=<?= $breakdown->breakdown_id ?>" method="post">
                                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                        $i = $i + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!--/Striped table-->
                    </div>
                    <?php require('templates/pagesComponents/popup/breakdownPopup.php'); ?>
                    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#breakdowns-table').DataTable();
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#breakdownsHistory-table').DataTable();
                        });
                    </script>
</body>
</html>