<?php 

namespace Application\Model\Defueling;

require_once('src/lib/database.php'); 
use Application\Lib\Database\DatabaseConnection; 

class Defueling
{
    public int $defueling_id; 
    public int $aeronef_id; 
    public string $immatriculation; 
    public int $personal_id; 
    public float $quantity; 
    public string $defueling_date; 
    public string $reason; 
    public int $removal_status; 
}

class DefuelingRepository 
{
    public DatabaseConnection $connection; 
    
    public function getDefuelings(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `defueling` WHERE REMOVAL_STATUS = 0
            ORDER BY DEFUELING_DATE DESC"
        ); 

        $defuelings = [];

        while($row = $statement->fetch()){

            $defueling = new Defueling(); 
            $defueling->defueling_id = $row['DEFUELING_ID'];
            $defueling->aeronef_id = $row['AERONEF_ID'];
            $defueling->personal_id = $row['PERSONAL_ID'];
            $defueling->quantity = $row['QUANTITY'];
            $defueling->defueling_date = $row['DEFUELING_DATE'];
            $defueling->reason = $row['REASON']; 
            $defueling->removal_status = $row['REMOVAL_STATUS'];

            $defuelings[] = $defueling;
        }
        return $defuelings; 
    }


    public function getDefuelings2(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `defueling` 
            INNER JOIN `aeronef`
            ON defueling.AERONEF_ID = aeronef.AERONEF_ID
            WHERE defueling.REMOVAL_STATUS = 0
            ORDER BY DEFUELING_DATE DESC"
        ); 

        $defuelings = [];

        while($row = $statement->fetch()){

            $defueling = new Defueling(); 
            $defueling->defueling_id = $row['DEFUELING_ID'];
            $defueling->aeronef_id = $row['AERONEF_ID'];
            $defueling->immatriculation = $row['IMMATRICULATION']; 
            $defueling->personal_id = $row['PERSONAL_ID'];
            $defueling->quantity = $row['QUANTITY'];
            $defueling->defueling_date = $row['DEFUELING_DATE'];
            $defueling->reason = $row['REASON']; 
            $defueling->removal_status = $row['REMOVAL_STATUS'];

            $defuelings[] = $defueling;
        }
        return $defuelings; 
    }

    public function addDefueling(int $aeronef_id, int $personal_id, float $quantity, string $defueling_date, string $reason): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `defueling`(`AERONEF_ID`, `PERSONAL_ID`, `QUANTITY`, `DEFUELING_DATE`, `REASON`) 
            VALUES (? , ?, ?, ?, ?)"
        ); 

        $statement->execute([$aeronef_id, $personal_id, $quantity, $defueling_date, $reason]); 

        
        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else {
            return 0;
        }

    }

    public function deletePermanentlyDefueling(int $defueling_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "DELETE FROM `defueling`  WHERE `DEFUELING_ID`= ? "
       );
       $statement->execute([$defueling_id]);

       $affectedLines = $statement->rowCount();
       if ($affectedLines == 1){
           return 1 ;
       }else{
           return 0;
       }

   }

   public function deleteApparentlyDefueling(int $defueling_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "UPDATE `defueling` 
           SET `REMOVAL_STATUS`= 1 WHERE `DEFUELING_ID`= ? "
       );
       $statement->execute([$defueling_id]);
       
       $affectedLine = $statement->rowCount();
       if ($affectedLine == 1){
           return 1 ;
       }else{
           return 0;
       }

   }


   public function getDefueling(int $defueling_id) : ?Defueling
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM `defueling` WHERE DEFUELING_ID = ?"
        ); 

        $statement->execute([$defueling_id]); 

        while($row = $statement->fetch()){

            $defueling = new Defueling(); 
            $defueling->defueling_id = $row['DEFUELING_ID'];
            $defueling->aeronef_id = $row['AERONEF_ID'];
            $defueling->personal_id = $row['PERSONAL_ID'];
            $defueling->quantity = $row['QUANTITY'];
            $defueling->defueling_date = $row['DEFUELING_DATE'];
            $defueling->reason = $row['REASON']; 
            $defueling->removal_status = $row['REMOVAL_STATUS'];
        }
        return $defueling; 
    }


    public function updateDefueling(int $aeronef_id, int $personal_id, float $quantity, string $defueling_date, string $reason, int $defueling_id) : bool 
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `Defueling` 
            SET  `AERONEF_ID`= ?,
            `PERSONAL_ID`= ?,
            `QUANTITY`= ? ,
            `DEFUELING_DATE`= ?,
            `REASON` = ?
             WHERE DEFUELING_ID = ?"
        );
        $statement->execute([$aeronef_id, $personal_id, $quantity, $defueling_date, $reason, $defueling_id]); 
        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else{
            return 0;
        }
    }

}