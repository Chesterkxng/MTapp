<?php
session_start();
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Aeronef\AeronefRepository;
use Application\Model\Personal\PersonalRepository;
use Application\Model\Type\TypeRepository;
?>
<!doctype html>
<html lang="en">
<head>
    <title>MTapp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="templates\pagesComponents\navbar\assets\img\insigneAir.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <?php require('templates/pagesComponents/navbar/navbarHeader.php'); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php require('templates/pagesComponents/navbar/navbar.php'); ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Missions List</strong></h5>
        <div class="row mt-3">
            <div class="col-sm-12">
                <!--Striped table-->
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <table class="table table-striped" id='missions-table'>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>CAPTAIN</th>
                                <th>TYPE</th>
                                <th>AFFECTED AERONEF </th>
                                <th>DESTINATION</th>
                                <th>DEPARTURE DATE</th>
                                <th>RETURN DATE</th>
                                <th>BENEFICIARY</th>
                                <th>NUMBERS OF PASSENGERS</th>
                                <th>STATUS</th>
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
                            $typeRepository = new TypeRepository();
                            $typeRepository->connection = new DatabaseConnection();
                            foreach ($missions as $mission) {
                                $aeronef = $aeronefRepository->getAeronef($mission->aeronef_id);
                                $personal = $personalRepository->getPersonal($mission->personal_id);
                                $type = $typeRepository->getType($mission->type_id)
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($i) ?></td>
                                    <td><?= htmlspecialchars($personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name) ?></td>
                                    <td><?= htmlspecialchars($type->type) ?></td>
                                    <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                    <td><?= htmlspecialchars($mission->destination) ?></td>
                                    <td><?= htmlspecialchars($mission->departure_date) ?></td>
                                    <td><?= htmlspecialchars($mission->return_date) ?></td>
                                    <td><?= htmlspecialchars($mission->beneficiary) ?></td>
                                    <td><?= htmlspecialchars($mission->passengers_number) ?></td>
                                    <?php switch ($mission->status) {
                                        case 0: ?>
                                            <td><label class="badge badge-danger badge-pill">Unstarted</label></td>
                                        <?php break;
                                        case 1: ?>
                                            <td><label class="badge badge-warning badge-pill">Pending</label></td>
                                    <?php break;
                                    } ?>
                                    <td class="align-middle text-center">
                                        <form style="display:inline;" action="index.php?action=updateMissionForm&mission_id=<?= $mission->mission_id ?>" method="post">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </form>
                                        <form style="display:inline;" action="index.php?action=deleteMissionPopup&mission_id=<?= $mission->mission_id ?>" method="post">
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
                                <td></td>
                                <td>
                                    <form style="display:inline;" action="index.php?action=MissionAddingForm" method="post">
                                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--/Striped table-->
                <h5 class="mb-3"><strong>Missions History</strong></h5>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Striped table-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <table class="table table-striped" id="missionsHistory-table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>CAPTAIN</th>
                                        <th>TYPE</th>
                                        <th>AFFECTED AERONEF </th>
                                        <th>DESTINATION</th>
                                        <th>DEPARTURE DATE</th>
                                        <th>RETURN DATE</th>
                                        <th>BENEFICIARY</th>
                                        <th>NUMBERS OF PASSENGERS</th>
                                        <th>STATUS</th>
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
                                    $typeRepository = new TypeRepository();
                                    $typeRepository->connection = new DatabaseConnection();
                                    foreach ($missionsHistory as $mission) {
                                        $aeronef = $aeronefRepository->getAeronef($mission->aeronef_id);
                                        $personal = $personalRepository->getPersonal($mission->personal_id);
                                        $type = $typeRepository->getType($mission->type_id)
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($i) ?></td>
                                            <td><?= htmlspecialchars($personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name) ?></td>
                                            <td><?= htmlspecialchars($type->type) ?></td>
                                            <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                            <td><?= htmlspecialchars($mission->destination) ?></td>
                                            <td><?= htmlspecialchars($mission->departure_date) ?></td>
                                            <td><?= htmlspecialchars($mission->return_date) ?></td>
                                            <td><?= htmlspecialchars($mission->beneficiary) ?></td>
                                            <td><?= htmlspecialchars($mission->passengers_number) ?></td>
                                            <td><label class="badge badge-success badge-pill">completed</label></td>
                                            <td class="align-middle text-center">
                                                <form style="display:inline;" action="index.php?action=deleteMissionPopup&mission_id=<?= $mission->mission_id ?>" method="post">
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
                    <?php require('templates/pagesComponents/popup/missionPopup.php'); ?>
                    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#missions-table').DataTable();
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#missionsHistory-table').DataTable();
                        });
                    </script>
</body>
</html>