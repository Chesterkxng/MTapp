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
        if (!empty($row['PendingMissionsNumber'])){
            $pendingMissionsNumber = $row['PendingMissionsNumber'];
        } else {
            $pendingMissionsNumber = 0; 
        }
        return $pendingMissionsNumber; 
    }

    public function AvalaibleAeronefsNumber(): int 
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(AERONEF_ID) as AvalaibleAeronefsNumber FROM `aeronef` 
            WHERE AVAILABILITY_STATUS = 1  AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['AvalaibleAeronefsNumber'])){
            $AvalaibleAeronefsNumber = $row['AvalaibleAeronefsNumber'];
        } else {
            $AvalaibleAeronefsNumber = 0; 
        }
        return $AvalaibleAeronefsNumber; 
    }

    public function UnavalaibleAeronefsNumber(): int 
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(AERONEF_ID) as UnavalaibleAeronefsNumber FROM `aeronef` 
            WHERE AVAILABILITY_STATUS = 0  AND REMOVAL_STATUS = 0"
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['UnavalaibleAeronefsNumber'])){
            $UnavalaibleAeronefsNumber = $row['UnavalaibleAeronefsNumber'];
        } else {
            $UnavalaibleAeronefsNumber = 0; 
        }
        return $UnavalaibleAeronefsNumber; 
    }


    public function PendingBreakdownsNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(BREAKDOWN_ID) as PendingBreakdownsNumber FROM `breakdown` 
            WHERE REPAIRING_STATUS != 2 AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['PendingBreakdownsNumber'])){
            $pendingBreakdownsNumber = $row['PendingBreakdownsNumber'];
        } else {
            $pendingBreakdownsNumber = 0; 
        }
        return $pendingBreakdownsNumber; 
    }

    public function PendingOrdersNumber(): int
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT COUNT(ORDER_ID) as PendingOrdersNumber FROM `orders` 
            WHERE DELIVERY_STATUS != 2 AND REMOVAL_STATUS = 0 "
        ); 
        $row = $statement->fetch(); 
        if (!empty($row['PendingOrdersNumber'])){
            $pendingOrdersNumber = $row['PendingOrdersNumber'];
        } else {
            $pendingOrdersNumber = 0; 
        }
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
        if (!empty($row['RefuelingsNumber'])){
            $refuelingsNumber = $row['RefuelingsNumber'];
        } else {
            $refuelingsNumber = 0; 
        }
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
        if (!empty($row['MonthlyRefuelingsNumber'])){
            $MonthlyRefuelingsNumber = $row['MonthlyRefuelingsNumber'];
        } else {
            $MonthlyRefuelingsNumber = 0; 
        }
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
        if (!empty($row['RefuelingsQuantity'])){
            $refuelingQuantity = $row['RefuelingsQuantity'];
        } else {
            $refuelingQuantity = 0; 
        }
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
        if (!empty($row['DefuelingsNumber'])){
            $defuelingsNumber = $row['DefuelingsNumber'];
        } else {
            $defuelingsNumber = 0; 
        }
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