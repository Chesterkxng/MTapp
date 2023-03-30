<?php
session_start();
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Aeronef\AeronefRepository;
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
        <h5 class="mb-3"><strong>Orders List</strong></h5>
        <div class="row mt-3">
            <div class="col-sm-12">
                <!--Striped table-->
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <table class="table table-striped" id="orders-table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>PART NUMBER</th>
                                <th>NAME</th>
                                <th>SUPPLIER</th>
                                <th>QUANTITY</th>
                                <th>PRICE</th>
                                <th>AFFECTED AERONEF </th>
                                <th>ORDER DATE</th>
                                <th>STATUS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $aeronefRepository = new AeronefRepository();
                            $aeronefRepository->connection = new DatabaseConnection();
                            foreach ($orders as $order) {
                                $aeronef = $aeronefRepository->getAeronef($order->aeronef_id);
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($i) ?></td>
                                    <td><?= htmlspecialchars($order->part_number) ?></td>
                                    <td><?= htmlspecialchars($order->name) ?></td>
                                    <td><?= htmlspecialchars($order->supplier) ?></td>
                                    <td><?= htmlspecialchars($order->quantity) ?></td>
                                    <td><?= htmlspecialchars($order->price) ?></td>
                                    <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                    <td><?= htmlspecialchars($order->order_date) ?></td>
                                    <?php switch ($order->delivery_status) {
                                        case 1: ?>
                                            <td><label class="badge badge-warning badge-pill">Pending</label></td>
                                    <?php break;
                                    } ?>
                                    <td class="align-middle text-center">
                                        <form style="display:inline;" action="index.php?action=updateOrderForm&order_id=<?= $order->order_id ?>" method="post">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </form>
                                        <form style="display:inline;" action="index.php?action=deleteOrderPopup&order_id=<?= $order->order_id ?>" method="post">
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
                                <td>
                                    <form style="display:inline;" action="index.php?action=orderAddingForm" method="post">
                                        <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--/Striped table-->
                <h5 class="mb-3"><strong>Orders History</strong></h5>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Striped table-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <table class="table table-striped" id="ordersHistory-table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>PART NUMBER</th>
                                        <th>NAME</th>
                                        <th>SUPPLIER</th>
                                        <th>QUANTITY</th>
                                        <th>PRICE</th>
                                        <th>AFFECTED AERONEF </th>
                                        <th>ORDER DATE</th>
                                        <th>STATUS</th>
                                        <th>DELIVERY DATE</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $aeronefRepository = new AeronefRepository();
                                    $aeronefRepository->connection = new DatabaseConnection();
                                    foreach ($ordersHistory as $order) {
                                        $aeronef = $aeronefRepository->getAeronef($order->aeronef_id);
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($i) ?></td>
                                            <td><?= htmlspecialchars($order->part_number) ?></td>
                                            <td><?= htmlspecialchars($order->name) ?></td>
                                            <td><?= htmlspecialchars($order->supplier) ?></td>
                                            <td><?= htmlspecialchars($order->quantity) ?></td>
                                            <td><?= htmlspecialchars($order->price) ?></td>
                                            <td><?= htmlspecialchars($aeronef->immatriculation) ?></td>
                                            <td><?= htmlspecialchars($order->order_date) ?></td>
                                            <td><label class="badge badge-success badge-pill">delivered</label></td>
                                            <td><?= htmlspecialchars($order->delivery_date) ?></td>
                                            <td class="align-middle text-center">
                                                <form style="display:inline;" action="index.php?action=deleteOrderPopup&order_id=<?= $order->order_id ?>" method="post">
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
                    <?php require('templates/pagesComponents/popup/orderPopup.php'); ?>
                    <?php require('templates/pagesComponents/navbar/navbarFooter.php'); ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#orders-table').DataTable();
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#ordersHistory-table').DataTable();
                        });
                    </script>
</body>
</html>