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
    $aeronefRepository = new AeronefRepository();
    $aeronefRepository->connection = new DatabaseConnection();
    $aeronefs = $aeronefRepository->getActiveAeronefs();
    ?>
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-3"><strong>Add a new order</strong></h5>
        <div class="row">
            <div class="col-sm-12">
                <div class="mt-4 mb-3 p-3  button-container bg-white border shadow-sm">
                    <h6 class="mb-4">ORDER</h6>
                    <form action="index.php?action=addOrder" method="post">
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="PN">PART NUMBER</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="PN" name="PN" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="NAME">NAME</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="name" name="name" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="supplier">SUPPLIER</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="supplier" name="supplier" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="quantity">QUANTITY</label>
                            <div class="col-sm-5">
                                <input type="number" min="0" class="form-control" id="quantity" name="quantity" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="price">PRICE</label>
                            <div class="col-sm-5">
                                <input type="number" min="0" class="form-control" id="price" name="price" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="affected_aeronef">AFFECTED AERONEF</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="affected_aeronef" id="affected_aeronef" required>
                                    <option value="">aeronef selection</option>
                                    <?php foreach ($aeronefs as $aeronef) { ?>
                                        <option value="<?= $aeronef->aeronef_id ?>"><?= $aeronef->immatriculation ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="ORDER_DATE">ORDER DATE</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="ORDER_DATE" name="ORDER_DATE" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="order_status">STATUS</label>
                            <div class="col-sm-5">
                                <select class="custom-select" name="order_status" id="order_status" required>
                                    <option value="">Status selection</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Delivered</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3" for="DELIVERY_DATE">DELIVERY DATE</label>
                            <div class="col-sm-5">
                                <input type="date" value="" class="form-control" id="DELIVERY_DATE" name="DELIVERY_DATE" />
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
    <?php require('templates/pagesComponents/popup/orderPopup.php') ?>
    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
</body>
</html>