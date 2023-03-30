<?php session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <title>MTapp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="icon" href="templates\pagesComponents\navbar\assets\img\insigneAir.png" type="image/icon type">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php require('templates/pagesComponents/navbar/navbarHeader.php'); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php require('templates/pagesComponents/navbar/navbar.php'); ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Aeronefs List</strong></h5>
        <div class="row mt-3">
            <div class="col-sm-12">
                <!--Striped table-->
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <table class="table table-striped" id="project_table">
                        <thead>
                            <tr>
                                <th>Immatriculation</th>
                                <th>S/N</th>
                                <th>FH</th>
                                <th>LDGS</th>
                                <th>RH_ENG_DH</th>
                                <th>LH_ENG_DH</th>
                                <th>AVAILABILITY</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aeronefs as $aeronef) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                    <td><?= htmlspecialchars($aeronef->SN) ?></td>
                                    <td><?= htmlspecialchars($aeronef->fh) ?></td>
                                    <td><?= htmlspecialchars($aeronef->ldgs) ?></td>
                                    <td><?= htmlspecialchars($aeronef->rh_eng_fh) ?></td>
                                    <td><?= htmlspecialchars($aeronef->lh_eng_fh) ?></td>
                                    <?php switch ($aeronef->availability_status) {
                                        case 1: ?>
                                            <td><label class="badge badge-success badge-pill">Available</label></td>
                                        <?php break;
                                        case 0: ?>
                                            <td><label class="badge badge-danger badge-pill">Unavailable</label></td>
                                    <?php break;
                                    } ?>
                                    <td class="align-middle text-center">
                                        <form style="display:inline;" action="index.php?action=updateAeronefPage&aeronef_id=<?= $aeronef->aeronef_id ?>" method="post">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </form>
                                        <form style="display:inline;" action="index.php?action=deleteAeronefPopup&aeronef_id=<?= $aeronef->aeronef_id ?>" method="post">
                                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
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
                                <td>
                                    <form style="display:inline;" action="index.php?action=addingAeronefPage" method="post">
                                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--/Striped table-->
            </div>
            <?php require('templates/pagesComponents/popup/aeronefPopup.php'); ?>
            <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>