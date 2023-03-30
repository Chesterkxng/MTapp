<?php
namespace Application\Controllers\OrderControllers\Order;
session_start();
require_once('src/lib/database.php');
require_once('src/model/order.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Order\OrderRepository;
class Order
{
    public function orderList()
    {
        $orderRepository = new OrderRepository();
        $orderRepository->connection = new DatabaseConnection();
        $orders = $orderRepository->getPendingOrders();
        $ordersHistory = $orderRepository->getHistoricalOrders();
        require('templates/order/orderList.php');
    }
    public function addingFormPage()
    {
        require('templates/order/addingForm.php');
    }
    public function addOrder(array $input)
    {
        require('templates/order/addingForm.php');
        if ($input !== null) {
            $part_number = null;
            $name = null;
            $supplier = null;
            $quantity = null;
            $price = null;
            $aeronef_id = null;
            $orderDate = null;
            $status = null;
            $deliveryDate = null;
            if (
                !empty($input['PN']) && !empty($input['name']) && !empty($input['supplier'])
                && !empty($input['quantity']) && !empty($input['price']) && !empty($input['affected_aeronef'])
                && !empty($input['ORDER_DATE']) && !empty($input['order_status'])
            ) {
                $part_number = $input['PN'];
                $name = $input['name'];
                $supplier = $input['supplier'];
                $quantity = $input['quantity'];
                $price = $input['price'];
                $aeronef_id = $input['affected_aeronef'];
                $orderDate = $input['ORDER_DATE'];
                $status = $input['order_status'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $orderRepository = new OrderRepository();
            $orderRepository->connection = new DatabaseConnection();
            if ($status == 2 && $input['DELIVERY_DATE'] != '') {
                $deliveryDate = $input['DELIVERY_DATE'];
                $success = $orderRepository->addNewDeliveredOrder(
                    $aeronef_id,
                    $part_number,
                    $name,
                    $supplier,
                    $price,
                    $quantity,
                    $orderDate,
                    $status,
                    $deliveryDate
                );
                if ($success == 0) {
                    echo '<script type="text/javascript">
                            addingErrorAlert()
                        </script>';
                } else {
                    echo '<script type="text/javascript">
                            addingSuccessAlert()
                        </script>';
                }
            } elseif ($status == 2 && $input['DELIVERY_DATE'] == '') {
                echo '<script type="text/javascript">
                            addingErrorAlert2()
                        </script>';
            } else {
                $success = $orderRepository->addNewPendingOrder(
                    $aeronef_id,
                    $part_number,
                    $name,
                    $supplier,
                    $price,
                    $quantity,
                    $orderDate,
                    $status
                );
                if ($success == 0) {
                    echo '<script type="text/javascript">
                            addingErrorAlert()
                        </script>';
                } else {
                    echo '<script type="text/javascript">
                            addingSuccessAlert()
                        </script>';
                }
            }
        }
    }
    public function updateFormPage(int $order_id)
    {
        $orderRepository = new OrderRepository();
        $orderRepository->connection = new DatabaseConnection();
        $order = $orderRepository->getOrder($order_id);
        require('templates/order/updateForm.php');
    }
    public function updateOrder(array $input, int $order_id)
    {
        $orderRepository = new OrderRepository();
        $orderRepository->connection = new DatabaseConnection();
        $order = $orderRepository->getOrder($order_id);
        require('templates/order/updateForm.php');
        if ($input !== null) {
            $part_number = null;
            $name = null;
            $supplier = null;
            $quantity = null;
            $price = null;
            $aeronef_id = null;
            $orderDate = null;
            $status = null;
            $deliveryDate = null;
            if (
                !empty($input['PN']) && !empty($input['name']) && !empty($input['supplier'])
                && !empty($input['quantity']) && !empty($input['price']) && !empty($input['affected_aeronef'])
                && !empty($input['ORDER_DATE']) && !empty($input['order_status'])
            ) {
                $part_number = $input['PN'];
                $name = $input['name'];
                $supplier = $input['supplier'];
                $quantity = $input['quantity'];
                $price = $input['price'];
                $aeronef_id = $input['affected_aeronef'];
                $orderDate = $input['ORDER_DATE'];
                $status = $input['order_status'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $orderRepository = new OrderRepository();
            $orderRepository->connection = new DatabaseConnection();
            if ($status == 2 && $input['DELIVERY_DATE'] != '') {
                $deliveryDate = $input['DELIVERY_DATE'];
                $success = $orderRepository->updateToSetDeliveredOrder(
                    $aeronef_id,
                    $part_number,
                    $name,
                    $supplier,
                    $price,
                    $quantity,
                    $orderDate,
                    $status,
                    $deliveryDate,
                    $order_id
                );
                if ($success == 0) {
                    echo '<script type="text/javascript">
                            updateErrorAlert()
                        </script>';
                } else {
                    echo '<script type="text/javascript">
                            updateSuccessAlert()
                        </script>';
                }
            } elseif ($status == 2 && $input['DELIVERY_DATE'] == '') {
                echo '<script type="text/javascript">
                            updateErrorAlert2()
                        </script>';
            } else {
                $success = $orderRepository->updatePendingOrder(
                    $aeronef_id,
                    $part_number,
                    $name,
                    $supplier,
                    $price,
                    $quantity,
                    $orderDate,
                    $status,
                    $order_id
                );
                if ($success == 0) {
                    echo '<script type="text/javascript">
                            updateErrorAlert()
                        </script>';
                } else {
                    echo '<script type="text/javascript">
                            updateSuccessAlert()
                        </script>';
                }
            }
        }
    }
    public function sendDeletePopup(int $order_id)
    {
        $orderRepository = new OrderRepository();
        $orderRepository->connection = new DatabaseConnection();
        $orders = $orderRepository->getPendingOrders();
        $ordersHistory = $orderRepository->getHistoricalOrders();
        require('templates/order/orderList.php');
        echo '<script type="text/javascript">
            deletingConfirmAlert()
        </script>';
    }
    public function setOrderInactive(int $order_id)
    {
        $orderRepository = new OrderRepository();
        $orderRepository->connection = new DatabaseConnection();
        $orders = $orderRepository->getPendingOrders();
        $ordersHistory = $orderRepository->getHistoricalOrders();
        require('templates/order/orderList.php');;
        $bool = $orderRepository->deleteApparentlyOrder($order_id);
        if ($bool == 1) {
            echo '<script type="text/javascript">
                        deletingSuccessAlert()
                    </script>';
        } else {
            echo '<script type="text/javascript">
                    deletingErrorAlert()
                </script>';
        }
    }
}
