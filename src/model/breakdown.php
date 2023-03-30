<?php 

namespace Application\Model\Breakdown; 

require_once('src/lib/database.php'); 

use Application\Lib\Database\DatabaseConnection;

class Breakdown
{
    public int $breakdown_id; 
    public int $aeronef_id; 
    public string $immatriculation; 
    public int $personal_id; 
    public string $name; 
    public int $bsm_number; 
    public string $description; 
    public string $action; 
    public string $finding_date; 
    public string $repair_end_date; 
    public int $repairing_status; 
    public int $removal_status; 
}

class BreakdownRepository
{
    public DatabaseConnection $connection; 

    public function getPendingBreakdowns(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM breakdown 
            WHERE REPAIRING_STATUS != 2 AND  REPAIR_END_DATE IS NULL 
            AND REMOVAL_STATUS = 0 "
        );

        $breakdowns = [];
        while ($row = $statement->fetch()){

            $breakdown = new Breakdown();
            $breakdown->breakdown_id = $row['BREAKDOWN_ID'];
            $breakdown->aeronef_id = $row['AERONEF_ID'];
            $breakdown->personal_id = $row['PERSONAL_ID'];
            $breakdown->name = $row['NAME'];
            $breakdown->bsm_number = $row['BSM_NUMBER'];
            $breakdown->description = $row['DESCRIPTION'];
            $breakdown->action = $row['ACTION'];
            $breakdown->finding_date = $row['FINDING_DATE'];
            $breakdown->repairing_status = $row['REPAIRING_STATUS'];

            $breakdowns[] = $breakdown;
        }
        return $breakdowns;
    }


    public function getBreakdowns(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM breakdown 
            WHERE  REMOVAL_STATUS = 0 "
        );

        $breakdowns = [];
        while ($row = $statement->fetch()){

            $breakdown = new Breakdown();
            $breakdown->breakdown_id = $row['BREAKDOWN_ID'];
            $breakdown->aeronef_id = $row['AERONEF_ID'];
            $breakdown->personal_id = $row['PERSONAL_ID'];
            $breakdown->name = $row['NAME'];
            $breakdown->bsm_number = $row['BSM_NUMBER'];
            $breakdown->description = $row['DESCRIPTION'];
            $breakdown->action = $row['ACTION'];
            $breakdown->finding_date = $row['FINDING_DATE'];
            $breakdown->repairing_status = $row['REPAIRING_STATUS'];

            $breakdowns[] = $breakdown;
        }
        return $breakdowns;
    }

    public function getBreakdowns2(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `breakdown` 
            INNER JOIN `aeronef`
            ON breakdown.AERONEF_ID = aeronef.AERONEF_ID
            WHERE  breakdown.REMOVAL_STATUS = 0 "
        );

        $breakdowns = [];
        while ($row = $statement->fetch()){

            $breakdown = new Breakdown();
            $breakdown->breakdown_id = $row['BREAKDOWN_ID'];
            $breakdown->aeronef_id = $row['AERONEF_ID'];
            $breakdown->immatriculation = $row['IMMATRICULATION'];
            $breakdown->personal_id = $row['PERSONAL_ID'];
            $breakdown->name = $row['NAME'];
            $breakdown->bsm_number = $row['BSM_NUMBER'];
            $breakdown->description = $row['DESCRIPTION'];
            $breakdown->action = $row['ACTION'];
            $breakdown->finding_date = $row['FINDING_DATE'];
            $breakdown->repairing_status = $row['REPAIRING_STATUS'];

            $breakdowns[] = $breakdown;
        }
        return $breakdowns;
    }


    public function getBreakdownsHistoric(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM breakdown 
            WHERE REPAIRING_STATUS = 2 AND  REPAIR_END_DATE IS NOT NULL 
            AND REMOVAL_STATUS = 0  "
        );

        $breakdowns = [];
        while ($row = $statement->fetch()){

            $breakdown = new Breakdown();
            $breakdown->breakdown_id = $row['BREAKDOWN_ID'];
            $breakdown->aeronef_id = $row['AERONEF_ID'];
            $breakdown->personal_id = $row['PERSONAL_ID'];
            $breakdown->name = $row['NAME'];
            $breakdown->bsm_number = $row['BSM_NUMBER'];
            $breakdown->description = $row['DESCRIPTION'];
            $breakdown->action = $row['ACTION'];
            $breakdown->finding_date = $row['FINDING_DATE'];
            $breakdown->repairing_status = $row['REPAIRING_STATUS'];
            $breakdown->repair_end_date = $row['REPAIR_END_DATE'];  

            $breakdowns[] = $breakdown;
        }
        return $breakdowns;
    }


    public function addBreakdown(string $name, int $bsm_number, int $aeronef_id,
     string $description, string $finding_date, int $found_by, string $action, int $repairing_status ): bool 
     {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `breakdown`( `AERONEF_ID`, `PERSONAL_ID`, `NAME`, `BSM_NUMBER`, `DESCRIPTION`, `ACTION`, `FINDING_DATE`,  `REPAIRING_STATUS`)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $statement->execute([$aeronef_id, intval($found_by), strtoupper($name), $bsm_number, strtoupper($description), strtoupper($action), $finding_date, $repairing_status]);

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }
     }

     public function getPendingBreakdown(int $breakdown_id): ?Breakdown
     {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM breakdown 
            WHERE BREAKDOWN_ID = ? "
        );
        $statement->execute([$breakdown_id]);

        while ($row = $statement->fetch()){

            $breakdown = new Breakdown();
            $breakdown->breakdown_id = $row['BREAKDOWN_ID'];
            $breakdown->aeronef_id = $row['AERONEF_ID'];
            $breakdown->personal_id = $row['PERSONAL_ID'];
            $breakdown->name = $row['NAME'];
            $breakdown->bsm_number = $row['BSM_NUMBER'];
            $breakdown->description = $row['DESCRIPTION'];
            $breakdown->action = $row['ACTION'];
            $breakdown->finding_date = $row['FINDING_DATE'];
            $breakdown->repairing_status = $row['REPAIRING_STATUS'];  

        }
        return $breakdown;

     }

     public function getHistoricalBreakdown(int $breakdown_id): ?Breakdown
     {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM breakdown 
            WHERE BREAKDOWN_ID = ? "
        );
        $statement->execute([$breakdown_id]);

        while ($row = $statement->fetch()){

            $breakdown = new Breakdown();
            $breakdown->breakdown_id = $row['BREAKDOWN_ID'];
            $breakdown->aeronef_id = $row['AERONEF_ID'];
            $breakdown->personal_id = $row['PERSONAL_ID'];
            $breakdown->name = $row['NAME'];
            $breakdown->bsm_number = $row['BSM_NUMBER'];
            $breakdown->description = $row['DESCRIPTION'];
            $breakdown->action = $row['ACTION'];
            $breakdown->finding_date = $row['FINDING_DATE'];
            $breakdown->repairing_status = $row['REPAIRING_STATUS'];
            $breakdown->repair_end_date = $row['REPAIR_END_DATE'];  

        }
        return $breakdown;

     }



     public function updateBreakdown(int $breakdown_id, string $name, int $bsm_number, int $aeronef_id,
     string $description, string $finding_date, int $found_by, string $action, int $repairing_status ): bool 
     {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `breakdown`
            SET `AERONEF_ID` = ?, 
            `PERSONAL_ID` = ?, 
            `NAME`= ?,
            `BSM_NUMBER` = ?,
            `DESCRIPTION` = ?,
            `ACTION` = ?,
            `FINDING_DATE` = ?, 
            `REPAIRING_STATUS`= ?
            WHERE BREAKDOWN_ID = ?"
        );
        $statement->execute([$aeronef_id, intval($found_by), strtoupper($name), $bsm_number, strtoupper($description), strtoupper($action), $finding_date, $repairing_status, $breakdown_id]);

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }
     } 

     public function addRepairEndDate(int $breakdown_id, string $repair_end_date):bool 
     {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `breakdown` SET REPAIR_END_DATE = ? 
            WHERE BREAKDOWN_ID = ?"
        );

        $statement->execute([$repair_end_date, $breakdown_id]);

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }
     }


     public function deletePermanentlyBreakdown(int $breakdown_id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM `breakdown`  WHERE `BREAKDOWN_ID`= ? "
        );
        $statement->execute([$breakdown_id]);

        $affectedLines = $statement->rowCount();
        if ($affectedLines == 1){
            return 1 ;
        }else{
            return 0;
        }

    }

    public function deleteApparentlyBreakdown(int $breakdown_id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `breakdown` 
            SET `REMOVAL_STATUS`= 1 WHERE `BREAKDOWN_ID`= ? "
        );
        $statement->execute([$breakdown_id]);
        
        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }

    }



}