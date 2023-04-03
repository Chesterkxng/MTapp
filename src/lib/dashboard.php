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
            "SELECT COUNT(MISSION_ID) as PendingMissionsNumber FROM `mission` 
            WHERE STATUS != 2 AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        $pendingMissionsNumber = $row['PendingMissionsNumber'];
        return $pendingMissionsNumber; 
    }

    public function AvalaibleAeronefsNumber(): int 
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(AERONEF_ID) as AvalaibleAeronefsNumber FROM `aeronef` 
            WHERE AVAILABILITY_STATUS = 1  AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        $AvalaibleAeronefsNumber = $row['AvalaibleAeronefsNumber'];
        return $AvalaibleAeronefsNumber; 
    }

    public function UnavalaibleAeronefsNumber(): int 
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(AERONEF_ID) as UnavalaibleAeronefsNumber FROM `aeronef` 
            WHERE AVAILABILITY_STATUS = 0  AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        $UnavalaibleAeronefsNumber = $row['UnavalaibleAeronefsNumber'];
        return $UnavalaibleAeronefsNumber; 
    }


    public function PendingBreakdownsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(BREAKDOWN_ID) as PendingBreakdownsNumber FROM `breakdown` 
            WHERE REPAIRING_STATUS != 2 AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $pendingBreakdownsNumber = $row['PendingBreakdownsNumber'];
        return $pendingBreakdownsNumber; 
    }

    public function PendingOrdersNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(ORDER_ID) as PendingOrdersNumber FROM `orders` 
            WHERE DELIVERY_STATUS != 2 AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $pendingOrdersNumber = $row['PendingOrdersNumber'];
        return $pendingOrdersNumber; 
    }


    // REFUELING REPORT 

    // total report 
    public function RefuelingsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(REFUELING_ID) as RefuelingsNumber FROM `refueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $refuelingsNumber = $row['RefuelingsNumber'];
        return $refuelingsNumber; 
    }

    // Monthly report 
    public function MonthlyRefuelingsNumber(): int
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(REFUELING_ID) as MonthlyRefuelingsNumber FROM `refueling` 
            WHERE REFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyRefuelingsNumber = $row['MonthlyRefuelingsNumber'];
        return $MonthlyRefuelingsNumber; 
    }   


    // total report 
    public function RefuelingsQuantity(): float
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY)  as RefuelingsQuantity FROM `refueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $refuelingQuantity = $row['RefuelingsQuantity'];
        return $refuelingQuantity; 
    }

    // monthly report 
    public function MonthlyRefuelingsQuantity(): float
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) as MonthlyRefuelingsQuantity FROM `refueling` 
            WHERE REFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['MonthlyRefuelingsQuantity'])){
            $MonthlyRefuelingsQuantity = $row['MonthlyRefuelingsQuantity'];
        } else {
            $MonthlyRefuelingsQuantity = 0; 
        }
        
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
        if (!empty($row['REFUELED_AERONEF'])){
            $MonthlyRefueledAeronef = $row['REFUELED_AERONEF'];
        } else {
            $MonthlyRefueledAeronef = 0; 
        }

        return $MonthlyRefueledAeronef; 
    } 


    // DEFUELING REPORT 


    public function DefuelingsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(DEFUELING_ID) as DefuelingsNumber FROM `defueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $defuelingsNumber = $row['DefuelingsNumber'];
        return $defuelingsNumber; 
    }

    // Monthly report 
    public function MonthlyDefuelingsNumber(): int
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(DEFUELING_ID) as MonthlyDefuelingsNumber FROM `defueling` 
            WHERE DEFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        if (!empty( $row['MonthlyDefuelingsNumber'])){
            $MonthlyDefuelingsNumber = $row['MonthlyDefuelingsNumber'];
        } else {
            $MonthlyDefuelingsNumber = 0; 
        }
        return $MonthlyDefuelingsNumber; 
    }   


    // total report 
    public function DefuelingsQuantity(): float
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) as DefuelingsQuantity FROM `defueling` 
            WHERE REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['DefuelingsQuantity'])){
            $defuelingQuantity = $row['DefuelingsQuantity'];
        } else {
            $defuelingQuantity = 0; 
        }

        return $defuelingQuantity; 
    }

    // monthly report 
    public function MonthlyDefuelingsQuantity(): float
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT SUM(QUANTITY) as MonthlyDefuelingsQuantity FROM `defueling` 
            WHERE DEFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['MonthlyDefuelingsQuantity'])){
            $MonthlyDefuelingsQuantity = $row['MonthlyDefuelingsQuantity'];
        } else {
            $MonthlyDefuelingsQuantity = 0; 
        }

        return $MonthlyDefuelingsQuantity; 
    } 

    public function MonthlyDefueledAeronef(): int
    {
        $date = date('Y-m'); 
        $statement = $this->connection->getConnection()->query(
            "SELECT  COUNT(DISTINCT AERONEF_ID) AS DEFUELED_AERONEF FROM `defueling` 
            WHERE DEFUELING_DATE LIKE '$date%' AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        $MonthlyDefueledAeronef = $row['DEFUELED_AERONEF'];

        if (!empty($row['DEFUELED_AERONEF'])){
            $MonthlyDefueledAeronef = $row['DEFUELED_AERONEF'];
        } else {
            $MonthlyDefueledAeronef = 0; 
        }
        return $MonthlyDefueledAeronef; 
    } 


    // order 


}