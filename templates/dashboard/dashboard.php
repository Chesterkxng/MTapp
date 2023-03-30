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
    <link rel="stylesheet" href="templates\login\css\style.css">
    <?php require('templates/pagesComponents/navbar/navbarHeader.php'); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php require('templates/pagesComponents/navbar/navbar.php'); ?>
    <!--Content right-->
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Dashboard</strong></h5>
        <div class="mt-1 mb-3 button-container">
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-success">
                                <i class="fa fa-plane"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $pendingMissionsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Pending Mission</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                <i class="fas fa-space-shuttle"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $AvalaibleAeronefsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Available Aeronefs</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-warning">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $pendingBreakdownsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Pending Breakdowns</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-dark">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $pendingOrdersNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Pending Orders</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                                <i class="fas fa-space-shuttle"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $UnavalaibleAeronefsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Unavailable Aeronefs</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="mb-3"><strong>FUEL MANAGEMENT REPORT</strong></h5>
            <h6 class="mb-3" style="color:darkblue"><strong>REFUELING REPORT</strong></h6>
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-success">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $refuelingsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Refueling Total Number</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $refuelingsTotalQuantity  ?></strong></h3>
                                <p><small class="text-muted bc-description">Refueling Total Quantity</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MONTHLY REPORT-->
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-info">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $MonthlyrefuelingsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Current Month Refueling Number</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-warning">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $MonthlyRefuelingsQuantity  ?></strong></h3>
                                <p><small class="text-muted bc-description">Current Month Refueling Quantity</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                <i class="fas fa-fighter-jet"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $MonthlyRefueledAeronef  ?></strong></h3>
                                <p><small class="text-muted bc-description">Refueled Aeronefs Number</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DEFUELING  REPORT-->
            <h6 class="mb-3" style="color:darkblue"><strong>DEFUELING REPORT</strong></h6>
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-success">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $defuelingsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Defueling Total Number</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $defuelingsTotalQuantity  ?></strong></h3>
                                <p><small class="text-muted bc-description">Defueling Total Quantity</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MONTHLY REPORT-->
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-info">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $MonthlyDefuelingsNumber  ?></strong></h3>
                                <p><small class="text-muted bc-description">Current Month Defueling Number</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-warning">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $MonthlyDefuelingsQuantity  ?></strong></h3>
                                <p><small class="text-muted bc-description">Current Month Defueling Quantity</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                <i class="fas fa-fighter-jet"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong><?= $MonthlyDefueledAeronef  ?></strong></h3>
                                <p><small class="text-muted bc-description">Defueled Aeronefs Number</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>