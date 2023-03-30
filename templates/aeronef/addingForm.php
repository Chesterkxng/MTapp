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
    ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Add a new aeronef</strong></h5>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h6 class="mb-4">AERONEF</h6>
                    <form action="index.php?action=addNewAeronef" method="post">
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="immatriculation">Immatriculation</label>
                            <div class="col-sm-5">
                                <input type="text" style="text-transform: uppercase;" class="form-control" id="immatriculation" name="immatriculation" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="S_N">S/N</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="S_N" name="S_N" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="FH">FH</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="FH" name="FH" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="LDGS">LDGS</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="LDGS" name="LDGS" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="RH_ENG_DH">RH_ENG_DH</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="RH_ENG_DH" name="RH_ENG_DH" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="LH_ENG_DH">LH_ENG_DH</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="LH_ENG_DH" name="LH_ENG_DH" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="COMMISSIONING_DATE">COMMISSIONING DATE</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="COMMISSIONING_DATE" name="COMMISSIONING_DATE" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="availability">AVAILABILITY</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="availability" id="availability" required>
                                    <option value="">Availability selection</option>
                                    <option value="1">Availability</option>
                                    <option value="00">Unavailable</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info btn-block">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require('templates/pagesComponents/popup/aeronefPopup.php') ?>
    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>