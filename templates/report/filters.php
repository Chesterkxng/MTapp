<?php
session_start();

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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

    <?php require('templates/pagesComponents/navbar/navbar.php'); ?>


    <?php

    use Application\Lib\Database\DatabaseConnection;
    use Application\Model\Aeronef\AeronefRepository;
    use Application\Model\Type\TypeRepository;

    use Application\Model\Mission\MissionRepository;
    use Application\Model\Refueling\RefuelingRepository;
    use Application\Model\Defueling\DefuelingRepository;
    use Application\Model\Breakdown\BreakdownRepository;
    use Application\Model\Order\OrderRepository;
    use Application\Model\Filter\FilterRepository;



    $aeronefRepository = new AeronefRepository();
    $aeronefRepository->connection = new DatabaseConnection();
    $aeronefs = $aeronefRepository->getActiveAeronefs();

    $typeRepository = new TypeRepository();
    $typeRepository->connection = new DatabaseConnection();
    $types = $typeRepository->getTypes();


    // missions call
    $missionRepository = new MissionRepository();
    $missionRepository->connection = new DatabaseConnection();
    $missions = $missionRepository->getMissions2();
    $missions_js = json_encode($missions);

    // refuelings call 
    $refuelingRespository = new RefuelingRepository();
    $refuelingRespository->connection = new DatabaseConnection();
    $refuelings = $refuelingRespository->getRefuelings2();
    $refuelings_js = json_encode($refuelings);

    // defuelings call 
    $defuelingRespository = new DefuelingRepository();
    $defuelingRespository->connection = new DatabaseConnection();
    $defuelings = $defuelingRespository->getDefuelings2();
    $defuelings_js = json_encode($defuelings);

    // aeronefs call 
    $aeronefRepositoty = new AeronefRepository();
    $aeronefRepositoty->connection = new DatabaseConnection();
    $aeronefs = $aeronefRepositoty->getActiveAeronefs();
    $aeronefs_js = json_encode($aeronefs);

    // breakdowns call 
    $breakdownRepository = new BreakdownRepository();
    $breakdownRepository->connection = new DatabaseConnection();
    $breakdowns = $breakdownRepository->getBreakdowns2();
    $breakdowns_js = json_encode($breakdowns);

    //orders call 

    $orderRepository = new OrderRepository();
    $orderRepository->connection = new DatabaseConnection();
    $orders = $orderRepository->getOrders2();
    $orders_js = json_encode($orders);
    ?>


    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>REPORT GENERATOR</strong></h5>
        <h5 class="mb-4"><strong>FILTERS</strong></h5>

        <div class="row">
            <div class="col-sm-12">

                <!-- MISSIONS  FILTER-->
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h5 class="mb-4"><strong>MISSIONS FILTER</strong></h5>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="selected_aeronef">SELECT AN AERONEF</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="missions_aeronef" id="missions_aeronef" required>
                                <option value="">Aeronef selection</option>
                                <?php foreach ($aeronefs as $aeronef) { ?>
                                    <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="type">SELECT A TYPE</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="type" id="type" required>
                                <option value="">Type selection</option>
                                <?php foreach ($types as $type) { ?>
                                    <option value="<?= $type->type_id ?>"><?= $type->type ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="PERIOD">PERIOD</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="missions_period" name="missions_period" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="mission_status">STATUS</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="mission_status" id="mission_status" required>
                                <option value="">Status selection</option>
                                <option value="2">completed</option>
                                <option value="1">Pending</option>
                                <option value="00">Unstarted</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-5">
                            <button onclick="missionsFilter()" class="btn btn-danger btn-block"><strong>GENERATE PDF</strong></button>
                        </div>
                    </div>

                </div>
                <!-- END OF MISSIONS FILTER-->


                <!-- REFUELING FILTER-->

                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h5 class="mb-4"><strong>REFUELINGS FILTER</strong></h5>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="selected_aeronef">SELECT AN AERONEF</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="refueled_aeronef" id="refueled_aeronef" required>
                                <option value="">Aeronef selection</option>
                                <?php foreach ($aeronefs as $aeronef) { ?>
                                    <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="refuelings_period">PERIOD</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="refuelings_period" name="refuelings_period" required />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-5">
                            <button type="submit" onclick="refuelingsFilter()" class="btn btn-danger btn-block"><strong>GENERATE PDF</strong></button>
                        </div>
                    </div>

                </div>
                <!-- END OF REFUELING FILTER-->

                <!-- DEFUELING FILTER-->

                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h5 class="mb-4"><strong>DEFUELINGS FILTER</strong></h5>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="defueled_aeronef">SELECT AN AERONEF</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="defueled_aeronef" id="defueled_aeronef" required>
                                <option value="">Aeronef selection</option>
                                <?php foreach ($aeronefs as $aeronef) { ?>
                                    <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="defuelings_period">PERIOD</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="defuelings_period" name="defuelings_period" required />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-5">
                            <button type="submit" onclick="defuelingsFilter()" class="btn btn-danger btn-block"><strong>GENERATE PDF</strong></button>
                        </div>
                    </div>

                </div>
                <!-- END OF DEFUELING FILTER-->


                <!-- AERONEF FILTER-->

                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h5 class="mb-4"><strong>AERONEFS FILTER</strong></h5>


                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="aeronef_availability">AVAILABILITY</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="aeronef_availability" id="aeronef_availability" required>
                                <option value="">Availabily selection</option>
                                <option value="1">Available</option>
                                <option value="00">Unavailable</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-5">
                            <button type="submit" onclick="aeronefsFilter()" class="btn btn-danger btn-block"><strong>GENERATE PDF</strong></button>
                        </div>
                    </div>

                </div>
                <!-- END OF AERONEF FILTER-->


                <!-- BREAKDOWNS  FILTER-->
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h5 class="mb-4"><strong>BREAKDOWNS FILTER</strong></h5>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="broken_aeronef">SELECT AN AERONEF</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="broken_aeronef" id="broken_aeronef" required>
                                <option value="">Aeronef selection</option>
                                <?php foreach ($aeronefs as $aeronef) { ?>
                                    <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="PERIOD">PERIOD</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="breakdowns_period" name="breakdowns_period" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="repairing_status">REPAIRING STATUS</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="repairing_status" id="repairing_status" required>
                                <option value="">Status selection</option>
                                <option value="2">repaired</option>
                                <option value="1">Pending</option>
                                <option value="00">Unstarted</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-5">
                            <button type="submit" onclick="breakdownsFilter()" class="btn btn-danger btn-block"><strong>GENERATE PDF</strong></button>
                        </div>
                    </div>

                </div>
                <!-- END OF MISSIONS FILTER-->



                <!-- MISSIONS  FILTER-->
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h5 class="mb-4"><strong>ORDERS FILTER</strong></h5>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="orders_aeronef">SELECT AN AERONEF</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="orders_aeronef" id="orders_aeronef" required>
                                <option value="">Aeronef selection</option>
                                <?php foreach ($aeronefs as $aeronef) { ?>
                                    <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="PERIOD">PERIOD</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="orders_period" name="orders_period" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3" for="orders_status">STATUS</label>
                        <div class="col-sm-5">
                            <select class="custom-select" name="orders_status" id="orders_status" required>
                                <option value="">Status selection</option>
                                <option value="2">delivered</option>
                                <option value="1">Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-5">
                            <button type="submit" onclick="ordersFilter()" class="btn btn-danger btn-block"><strong>GENERATE PDF</strong></button>
                        </div>
                    </div>

                </div>
                <!-- END OF MISSIONS FILTER-->


            </div>
        </div>



        <script type="text/javascript">
            $('input[name="missions_period"]').daterangepicker({
                locale: {
                    format: 'Y-MM-DD'
                }
            });
        </script>

        <script type="text/javascript">
            $('input[name="refuelings_period"]').daterangepicker({
                locale: {
                    format: 'Y-MM-DD'
                }
            });
        </script>
        <script type="text/javascript">
            $('input[name="defuelings_period"]').daterangepicker({
                locale: {
                    format: 'Y-MM-DD'
                }
            });
        </script>
        <script type="text/javascript">
            $('input[name="breakdowns_period"]').daterangepicker({
                locale: {
                    format: 'Y-MM-DD'
                }
            });
        </script>

        <script type="text/javascript">
            $('input[name="orders_period"]').daterangepicker({
                locale: {
                    format: 'Y-MM-DD'
                }
            });
        </script>


        <?php
        require('templates/report/assets/script/mission.php');
        require('templates/report/assets/script/refueling.php');
        require('templates/report/assets/script/defueling.php');
        require('templates/report/assets/script/aeronef.php');
        require('templates/report/assets/script/breakdown.php');
        require('templates/report/assets/script/order.php');
        require('templates/pagesComponents/navbar/navbarFooter.php'); ?>




</body>

</html>