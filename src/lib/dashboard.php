<?php 

namespace Application\lib\Dashboard; 

require_once('src/lib/database.php'); 
use Application\Lib\Database\DatabaseConnection; 

class DashboardRepository
{
    public DatabaseConnection $connection; 

    public function PendingMissionsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(MISSION_ID) FROM `mission` 
            WHERE STATUS != 2 AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        $pendingMissionsNumber = $row['COUNT(MISSION_ID)'];
        return $pendingMissionsNumber; 
    }

    public function AvalaibleAeronefsNumber(): int 
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(AERONEF_ID) FROM `aeronef` 
            WHERE AVAILABILITY_STATUS = 1  AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        $AvalaibleAeronefsNumber = $row['COUNT(AERONEF_ID)'];
        return $AvalaibleAeronefsNumber; 
    }

    public function UnavalaibleAeronefsNumber(): int 
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(AERONEF_ID) FROM `aeronef` 
            WHERE AVAILABILITY_STATUS = 0  AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        $UnavalaibleAeronefsNumber = $row['COUNT(AERONEF_ID)'];
        return $UnavalaibleAeronefsNumber; 
    }


    public function PendingBreakdownsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(BREAKDOWN_ID) FROM `breakdown` 
            WHERE REPAIRING_STATUS != 2 AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $pendingBreakdownsNumber = $row['COUNT(BREAKDOWN_ID)'];
        return $pendingBreakdownsNumber; 
    }

    public function PendingOrdersNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(ORDER_ID) FROM `orders` 
            WHERE DELIVERY_STATUS != 2 AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $pendingOrdersNumber = $row['COUNT(ORDER_ID)'];
        return $pendingOrdersNumber; 
    }


    // REFUELING REPORT 

    // total report 
    public function RefuelingsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(REFUELING_ID) FROM `refueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $refuelingsNumber = $row['COUNT(REFUELING_ID)'];
        return $refuelingsNumber; 
    }

    // Monthly report 
    public function MonthlyRefuelingsNumber(): int
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(REFUELING_ID) FROM `refueling` 
            WHERE REFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyRefuelingsNumber = $row['COUNT(REFUELING_ID)'];
        return $MonthlyRefuelingsNumber; 
    }   


    // total report 
    public function RefuelingsQuantity(): float
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) FROM `refueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $refuelingQuantity = $row['SUM(QUANTITY)'];
        return $refuelingQuantity; 
    }

    // monthly report 
    public function MonthlyRefuelingsQuantity(): float
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) FROM `refueling` 
            WHERE REFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyRefuelingsQuantity = $row['SUM(QUANTITY)'];
        return $MonthlyRefuelingsQuantity; 
    } 

    public function MonthlyRefueledAeronef(): float
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT  COUNT(DISTINCT AERONEF_ID) AS REFUELED_AERONEF FROM `refueling` 
            WHERE REFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyRefueledAeronef = $row['REFUELED_AERONEF'];
        return $MonthlyRefueledAeronef; 
    } 


    // DEFUELING REPORT 


    public function DefuelingsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(DEFUELING_ID) FROM `defueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $defuelingsNumber = $row['COUNT(DEFUELING_ID)'];
        return $defuelingsNumber; 
    }

    // Monthly report 
    public function MonthlyDefuelingsNumber(): int
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(DEFUELING_ID) FROM `defueling` 
            WHERE DEFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyDefuelingsNumber = $row['COUNT(DEFUELING_ID)'];
        return $MonthlyDefuelingsNumber; 
    }   


    // total report 
    public function DefuelingsQuantity(): float
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) FROM `defueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $defuelingQuantity = $row['SUM(QUANTITY)'];
        return $defuelingQuantity; 
    }

    // monthly report 
    public function MonthlyDefuelingsQuantity(): float
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) FROM `defueling` 
            WHERE DEFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyDefuelingsQuantity = $row['SUM(QUANTITY)'];
        return $MonthlyDefuelingsQuantity; 
    } 

    public function MonthlyDefueledAeronef(): float
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT  COUNT(DISTINCT AERONEF_ID) AS DEFUELED_AERONEF FROM `defueling` 
            WHERE DEFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyDefueledAeronef = $row['DEFUELED_AERONEF'];
        return $MonthlyDefueledAeronef; 
    } 


    // order 


}