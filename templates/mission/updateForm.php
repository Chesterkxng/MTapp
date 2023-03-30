<?php session_start() ?>
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
    <?php
    use Application\Lib\Database\DatabaseConnection;
    use Application\Model\Aeronef\AeronefRepository;
    use Application\Model\Personal\PersonalRepository;
    use Application\Model\Type\TypeRepository;
    $aeronefRepository = new AeronefRepository();
    $aeronefRepository->connection = new DatabaseConnection();
    $aeronefs = $aeronefRepository->getActiveAeronefs();
    $selected_aeronef = $aeronefRepository->getAeronef($mission->aeronef_id);
    $personalRepository = new PersonalRepository();
    $personalRepository->connection = new DatabaseConnection();
    $personnel = $personalRepository->getPersonals();
    $captain = $personalRepository->getPersonal($mission->personal_id);
    $typeRepository = new TypeRepository();
    $typeRepository->connection = new DatabaseConnection();
    $types = $typeRepository->getTypes();
    $selected_type = $typeRepository->getType($mission->type_id)
    ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Update mission</strong></h5>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h6 class="mb-4">MISSION</h6>
                    <form action="index.php?action=updateMission&mission_id=<?= $mission->mission_id ?>" method="post">
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="captain">CAPTAIN</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="captain" id="captain" required>
                                    <option value="<?= $captain->personal_id ?>"><?= $captain->grade . ' ' . $captain->surname . ' ' . $captain->first_name ?></option>
                                    <?php foreach ($personnel as $personal) { ?>
                                        <option value="<?= $personal->personal_id ?>"><?= $personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="type">TYPE</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="type" id="type" required>
                                    <option value="<?= $selected_type->type_id ?>"><?= $selected_type->type ?></option>
                                    <?php foreach ($types as $type) { ?>
                                        <option value="<?= $type->type_id ?>"><?= $type->type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="affected_aeronef">AFFECTED AERONEF</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="affected_aeronef" id="affected_aeronef" required>
                                    <option value="<?= $selected_aeronef->aeronef_id ?>"><?= $selected_aeronef->immatriculation ?></option>
                                    <?php foreach ($aeronefs as $aeronef) { ?>
                                        <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="destination">DESTINATION</label>
                            <div class="col-sm-5">
                                <textarea required type="text" class="form-control" rows="2" id="destination" name="destination"><?= $mission->destination ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="DEPARTURE_DATE">DEPARTURE DATE</label>
                            <div class="col-sm-5">
                                <input type="date" value="<?= $mission->departure_date ?>" class="form-control" id="DEPARTURE_DATE" name="DEPARTURE_DATE" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="RETURN_DATE">RETURN DATE</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="RETURN_DATE" name="RETURN_DATE" value="<?= $mission->return_date ?>" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="beneficiary">BENEFICIARY</label>
                            <div class="col-sm-5">
                                <textarea required type="text" class="form-control" rows="3" id="beneficiary" name="beneficiary"><?= $mission->beneficiary ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="BSM">NUMBER OF PASSENGERS</label>
                            <div class="col-sm-5">
                                <input type="number" value="<?= $mission->passengers_number ?>" class="form-control" id="passengers_number" name="passengers_number" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="mission_status">STATUS</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="mission_status" id="mission_status" required>
                                    <option value="">Status selection</option>
                                    <option value="2">Completed</option>
                                    <option value="1">Pending</option>
                                    <option value="00">Unstarted</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info btn-block">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require('templates/pagesComponents/popup/missionPopup.php') ?>
    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>