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
    <?php
    use Application\Lib\Database\DatabaseConnection;
    use Application\Model\Aeronef\AeronefRepository;
    use Application\Model\Personal\PersonalRepository;
    $aeronefRepository = new AeronefRepository();
    $aeronefRepository->connection = new DatabaseConnection();
    $aeronefs = $aeronefRepository->getActiveAeronefs();
    $affected_aeronef = $aeronefRepository->getAeronef($breakdown->aeronef_id);
    $personalRepository = new PersonalRepository();
    $personalRepository->connection = new DatabaseConnection();
    $personnel = $personalRepository->getPersonals();
    $found_by = $personalRepository->getPersonal($breakdown->personal_id);
    ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Update a breakdown</strong></h5>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h6 class="mb-4">BREAKDOWN</h6>
                    <form action="index.php?action=updateBreakdown&breakdown_id=<?= $breakdown->breakdown_id ?>" method="post">
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="name">NAME</label>
                            <div class="col-sm-5">
                                <input type="text" style="text-transform: uppercase;" class="form-control" id="name" name="name" value="<?= $breakdown->name ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="BSM">BSM NUMBER</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="BSM" name="BSM" value="<?= $breakdown->bsm_number ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="affected_aeronef">AFFECTED AERONEF</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="affected_aeronef" id="affected_aeronef" required>
                                    <option value="<?= $affected_aeronef->aeronef_id ?>"><?= $affected_aeronef->immatriculation ?></option>
                                    <?php foreach ($aeronefs as $aeronef) { ?>
                                        <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="description">DESCRIPTION</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" rows="5" id="description" name="description"><?= $breakdown->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="FINDING_DATE">FINDING DATE</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="FINDING_DATE" name="FINDING_DATE" value="<?= $breakdown->finding_date ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="found_by">FOUND BY</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="found_by" id="found_by" required>
                                    <option value="<?= $found_by->personal_id ?>"><?= $found_by->grade . ' ' . $found_by->surname . ' ' . $found_by->first_name ?></option>
                                    <?php foreach ($personnel as $personal) { ?>
                                        <option value="<?= $personal->personal_id ?>"><?= $personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="action">REPAIRING ACTION</label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" rows="3" id="action" name="action"><?= $breakdown->action ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="repairing_status">REPAIRING STATUS</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="repairing_status" id="repairing_status" required>
                                    <option value="">Status selection</option>
                                    <option value="2">Repaired</option>
                                    <option value="1">Pending</option>
                                    <option value="00">Unstarted</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="REPAIR_END_DATE">REPAIR END DATE</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="REPAIR_END_DATE" name="REPAIR_END_DATE" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require('templates/pagesComponents/popup/breakdownPopup.php') ?>
    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>