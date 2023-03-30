<?php 

namespace Application\Model\Order;

require_once('src/lib/database.php'); 

use Application\Lib\Database\DatabaseConnection; 

class Order 
{
    public int $order_id; 
    public int $aeronef_id; 
    public string $immatriculation; 
    public string $part_number; 
    public string $name; 
    public string $supplier;
    public float $price ; 
    public float $quantity;
    public string $order_date;  
    public int $delivery_status; 
    public string $delivery_date;
    public int $removal_status; 

}

class OrderRepository 
{
    public DatabaseConnection $connection; 

    public function getPendingOrders(): array 
    {
        $statement = $this->connection->getConnection()->query(
        "SELECT * FROM `orders` 
        WHERE REMOVAL_STATUS = 0 AND DELIVERY_STATUS != 2
        ORDER BY SUPPLIER");

        $orders = []; 
        while ($row = $statement->fetch()){
            $order = new Order(); 
            $order->order_id = $row['ORDER_ID']; 
            $order->aeronef_id = $row['AERONEF_ID'];
            $order->part_number = $row['PART_NUMBER'];
            $order->name = $row['NAME'];
            $order->supplier = $row['SUPPLIER'];
            $order->price = $row['PRICE'];
            $order->quantity = $row['QUANTITY'];
            $order->order_date = $row['ORDER_DATE'];
            $order->delivery_status = $row['DELIVERY_STATUS']; 
            $order->removal_status = $row['REMOVAL_STATUS'];

            $orders[] = $order;     
        }
        return $orders;
    }


    public function getOrders(): array 
    {
        $statement = $this->connection->getConnection()->query(
        "SELECT * FROM `orders` 
        WHERE REMOVAL_STATUS = 0 
        ORDER BY SUPPLIER");

        $orders = []; 
        while ($row = $statement->fetch()){
            $order = new Order(); 
            $order->order_id = $row['ORDER_ID']; 
            $order->aeronef_id = $row['AERONEF_ID'];
            $order->part_number = $row['PART_NUMBER'];
            $order->name = $row['NAME'];
            $order->supplier = $row['SUPPLIER'];
            $order->price = $row['PRICE'];
            $order->quantity = $row['QUANTITY'];
            $order->order_date = $row['ORDER_DATE'];
            $order->delivery_status = $row['DELIVERY_STATUS']; 
            $order->removal_status = $row['REMOVAL_STATUS'];

            $orders[] = $order;     
        }
        return $orders;
    }


    public function getOrders2(): array 
    {
        $statement = $this->connection->getConnection()->query(
        "SELECT * FROM `orders` INNER JOIN `aeronef`
        ON orders.AERONEF_ID = aeronef.AERONEF_ID 
        WHERE orders.REMOVAL_STATUS = 0 
        ORDER BY SUPPLIER");

        $orders = []; 
        while ($row = $statement->fetch()){
            $order = new Order(); 
            $order->order_id = $row['ORDER_ID']; 
            $order->aeronef_id = $row['AERONEF_ID'];
            $order->part_number = $row['PART_NUMBER'];
            $order->immatriculation = $row['IMMATRICULATION']; 
            $order->name = $row['NAME'];
            $order->supplier = $row['SUPPLIER'];
            $order->price = $row['PRICE'];
            $order->quantity = $row['QUANTITY'];
            $order->order_date = $row['ORDER_DATE'];
            $order->delivery_status = $row['DELIVERY_STATUS']; 
            $order->removal_status = $row['REMOVAL_STATUS'];

            $orders[] = $order;     
        }
        return $orders;
    }


    public function getHistoricalOrders(): array 
    {
        $statement = $this->connection->getConnection()->query(
        "SELECT * FROM `orders` 
        WHERE REMOVAL_STATUS = 0 AND DELIVERY_STATUS = 2
        ORDER BY SUPPLIER");

        $orders = []; 
        while ($row = $statement->fetch()){
            $order = new Order(); 
            $order->order_id = $row['ORDER_ID']; 
            $order->aeronef_id = $row['AERONEF_ID'];
            $order->part_number = $row['PART_NUMBER'];
            $order->name = $row['NAME'];
            $order->supplier = $row['SUPPLIER'];
            $order->price = $row['PRICE'];
            $order->quantity = $row['QUANTITY']; 
            $order->order_date = $row['ORDER_DATE'];
            $order->delivery_status = $row['DELIVERY_STATUS'];
            $order->delivery_date =  $row['DELIVERY_DATE'];
            $order->removal_status = $row['REMOVAL_STATUS'];

            $orders[] = $order;     
        }
        return $orders;
    }


    public function addNewPendingOrder(int $aeronef_id, string $part_number, string $name,
     string $supplier, float $price, float $quantity, string $order_date, int $delivery_status): bool 
    {   
       
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `orders`(`AERONEF_ID`, `PART_NUMBER`, `NAME`, `SUPPLIER`, `PRICE`, `QUANTITY`, `ORDER_DATE`, `DELIVERY_STATUS`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        ); 

        $statement->execute([$aeronef_id, $part_number, $name, $supplier, $price
        , $quantity, $order_date, $delivery_status]); 
        

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else {
            return 0;
        }

    }


    public function addNewDeliveredOrder(int $aeronef_id, string $part_number, string $name,
     string $supplier, float $price, float $quantity, string $order_date, int $delivery_status, string $delivery_date): bool 
    {   
        
        $statement = $this->connection->getConnection()->prepare(
        "INSERT INTO `orders`(`AERONEF_ID`, `PART_NUMBER`, `NAME`, `SUPPLIER`, `PRICE`, `QUANTITY`, `ORDER_DATE`, `DELIVERY_STATUS`,`DELIVERY_DATE`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        ); 

        $statement->execute([$aeronef_id, $part_number, $name, $supplier, $price
        , $quantity, $order_date, $delivery_status, $delivery_date]); 
        

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else {
            return 0;
        }

    }


    public function getOrder(int $order_id): ?Order
    {
        $statement = $this->connection->getConnection()->prepare(
        "SELECT * FROM `orders` 
        WHERE ORDER_ID = ? ");

        $statement->execute([$order_id]); 
        while ($row = $statement->fetch()){
            $order = new Order(); 
            $order->order_id = $row['ORDER_ID']; 
            $order->aeronef_id = $row['AERONEF_ID'];
            $order->part_number = $row['PART_NUMBER'];
            $order->name = $row['NAME'];
            $order->supplier = $row['SUPPLIER'];
            $order->price = $row['PRICE'];
            $order->quantity = $row['QUANTITY'];
            $order->order_date = $row['ORDER_DATE'];
            $order->delivery_status = $row['DELIVERY_STATUS']; 
            $order->removal_status = $row['REMOVAL_STATUS'];    
        }
        return $order;
    }

    public function updatePendingOrder(int $aeronef_id, string $part_number, string $name,
     string $supplier, float $price, float $quantity, string $order_date, int $delivery_status, int $order_id)
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `orders`
               SET `AERONEF_ID` = ?,
                `PART_NUMBER` = ?, 
                `NAME` = ?, 
                `SUPPLIER` = ?, 
                `PRICE` = ?, 
                `QUANTITY` = ?, 
                `ORDER_DATE` = ?, 
                `DELIVERY_STATUS`= ?
            WHERE `ORDER_ID` = ?"
            
        ); 

        $statement->execute([$aeronef_id, $part_number, $name, $supplier, $price
        , $quantity, $order_date, $delivery_status, $order_id]); 
        

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else {
            return 0;
        }
    }

    public function updateToSetDeliveredOrder(int $aeronef_id, string $part_number, string $name,
     string $supplier, float $price, float $quantity, string $order_date, int $delivery_status, string $delivery_date, int $order_id)
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `orders`
               SET `AERONEF_ID` = ?,
                `PART_NUMBER` = ?, 
                `NAME` = ?, 
                `SUPPLIER` =?, 
                `PRICE` = ?, 
                `QUANTITY` = ?, 
                `ORDER_DATE` = ?, 
                `DELIVERY_STATUS` = ?,
                `DELIVERY_DATE`= ?
            WHERE `ORDER_ID` = ?"
            
        ); 

        $statement->execute([$aeronef_id, $part_number, $name, $supplier, $price
        , $quantity, $order_date, $delivery_status,$delivery_date, $order_id]); 
        

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else {
            return 0;
        }
    }



    public function deletePermanentlyOrder(int $order_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "DELETE FROM `orders`  WHERE `ORDER_ID`= ? "
       );
       $statement->execute([$order_id]);

       $affectedLines = $statement->rowCount();
       if ($affectedLines == 1){
           return 1 ;
       }else{
           return 0;
       }

   }

   public function deleteApparentlyOrder(int $order_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "UPDATE `orders` 
           SET `REMOVAL_STATUS`= 1 WHERE `ORDER_ID`= ? "
       );
       $statement->execute([$order_id]);
       
       $affectedLine = $statement->rowCount();
       if ($affectedLine == 1){
           return 1 ;
       }else{
           return 0;
       }

   }




}