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
    <link rel="icon" href="templates\pagesComponents\navbar\assets\img\insigneAir.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php require('templates/pagesComponents/navbar/navbarHeader.php'); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php require('templates/pagesComponents/navbar/navbar.php'); ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Defueling List</strong></h5>
        <div class="row mt-3">
            <div class="col-sm-12">
                <!--Striped table-->
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <table class="table table-striped" id="defuelings-table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>AFFECTED AERONEF </th>
                                <th>OPERATOR</th>
                                <th>QUANTITY</th>
                                <th>DEFUELING DATE</th>
                                <th>REASON</th>
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
                            foreach ($defuelings as $defueling) {
                                $aeronef = $aeronefRepository->getAeronef($defueling->aeronef_id);
                                $personal = $personalRepository->getPersonal($defueling->personal_id);
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($i) ?></td>
                                    <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                    <td><?= htmlspecialchars($personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name) ?></td>
                                    <td><?= htmlspecialchars($defueling->quantity) ?></td>
                                    <td><?= htmlspecialchars($defueling->defueling_date) ?></td>
                                    <td><?= htmlspecialchars($defueling->reason) ?></td>
                                    <td class="align-middle text-center">
                                        <form style="display:inline;" action="index.php?action=updateDefuelingForm&defueling_id=<?= $defueling->defueling_id ?>" method="post">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </form>
                                        <form style="display:inline;" action="index.php?action=deleteDefuelingPopup&defueling_id=<?= $defueling->defueling_id ?>" method="post">
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
                                <td>
                                    <form style="display:inline;" action="index.php?action=DefuelingAddingForm" method="post">
                                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--/Striped table-->
            </div>
            <?php require('templates/pagesComponents/popup/defuelingPopup.php'); ?>
            <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#defuelings-table').DataTable();
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#defuelingsHistory-table').DataTable();
                });
            </script>
</body>
</html>