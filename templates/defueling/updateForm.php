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
    $aeronefRepository = new AeronefRepository();
    $aeronefRepository->connection = new DatabaseConnection();
    $aeronefs = $aeronefRepository->getActiveAeronefs();
    $personalRepository = new PersonalRepository();
    $personalRepository->connection = new DatabaseConnection();
    $personnel = $personalRepository->getPersonals();
    $operator = $personalRepository->getPersonal($defueling->personal_id);
    $affected_aeronef = $aeronefRepository->getAeronef($defueling->aeronef_id);
    ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Update defueling</strong></h5>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h6 class="mb-4">DEFUELING</h6>
                    <form action="index.php?action=updateDefueling&defueling_id=<?= $defueling->defueling_id ?>" method="post">
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
                            <label class="control-label col-sm-3" for="operator">OPERATOR</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="operator" id="operator" required>
                                    <option value="<?= $operator->personal_id ?>"><?= $operator->grade . ' ' . $operator->surname . ' ' . $operator->first_name ?></option>
                                    <?php foreach ($personnel as $personal) { ?>
                                        <option value="<?= $personal->personal_id ?>"><?= $personal->grade . ' ' . $personal->surname . ' ' . $personal->first_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="quantity">QUANTITY</label>
                            <div class="col-sm-5">
                                <input type="number" step="any" value='<?= $defueling->quantity ?>' class="form-control" id="quantity" name="quantity" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="DEFUELING_DATE">DEFUELING DATE</label>
                            <div class="col-sm-5">
                                <input type="date" value='<?= $defueling->defueling_date ?>' class="form-control" id="DEFUELING_DATE" name="DEFUELING_DATE" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="REASON">REASON</label>
                            <div class="col-sm-5">
                                <textarea required type="text" value='<?= $defueling->reason ?>' class="form-control" rows="3" id="REASON" name="REASON"><?= $defueling->reason ?></textarea>
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
    <?php require('templates/pagesComponents/popup/defuelingPopup.php') ?>
    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>