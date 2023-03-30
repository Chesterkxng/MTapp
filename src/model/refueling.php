<?php 

namespace Application\Model\Refueling;

require_once('src/lib/database.php'); 
use Application\Lib\Database\DatabaseConnection; 

class Refueling
{
    public int $refueling_id; 
    public int $aeronef_id; 
    public int $personal_id; 
    public string $immatriculation; 
    public float $quantity; 
    public string $refueling_date; 
    public int $removal_status; 
}

class RefuelingRepository 
{
    public DatabaseConnection $connection; 
    
    public function getRefuelings(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `refueling` WHERE REMOVAL_STATUS = 0
            ORDER BY REFUELING_DATE DESC"
        ); 

        $refuelings = [];

        while($row = $statement->fetch()){

            $refueling = new Refueling(); 
            $refueling->refueling_id = $row['REFUELING_ID'];
            $refueling->aeronef_id = $row['AERONEF_ID'];
            $refueling->personal_id = $row['PERSONAL_ID'];
            $refueling->quantity = $row['QUANTITY'];
            $refueling->refueling_date = $row['REFUELING_DATE'];
            $refueling->removal_status = $row['REMOVAL_STATUS'];

            $refuelings[] = $refueling;
        }
        return $refuelings; 
    }



    public function getRefuelings2(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `refueling` INNER JOIN `aeronef`
            ON refueling.AERONEF_ID = aeronef.AERONEF_ID
            WHERE refueling.REMOVAL_STATUS = 0
            ORDER BY REFUELING_DATE DESC"
        ); 

        $refuelings = [];

        while($row = $statement->fetch()){

            $refueling = new Refueling(); 
            $refueling->refueling_id = $row['REFUELING_ID'];
            $refueling->aeronef_id = $row['AERONEF_ID'];
            $refueling->personal_id = $row['PERSONAL_ID'];
            $refueling->quantity = $row['QUANTITY'];
            $refueling->immatriculation = $row['IMMATRICULATION']; 
            $refueling->refueling_date = $row['REFUELING_DATE'];
            $refueling->removal_status = $row['REMOVAL_STATUS'];

            $refuelings[] = $refueling;
        }
        return $refuelings; 
    }

    public function addRefueling(int $aeronef_id, int $personal_id, float $quantity, string $refueling_date): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `refueling`(`AERONEF_ID`, `PERSONAL_ID`, `QUANTITY`, `REFUELING_DATE`) 
            VALUES (? , ?, ?, ?)"
        ); 

        $statement->execute([$aeronef_id, $personal_id, $quantity, $refueling_date]); 

        
        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else {
            return 0;
        }

    }

    public function deletePermanentlyRefueling(int $refueling_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "DELETE FROM `refueling`  WHERE `REFUELING_ID`= ? "
       );
       $statement->execute([$refueling_id]);

       $affectedLines = $statement->rowCount();
       if ($affectedLines == 1){
           return 1 ;
       }else{
           return 0;
       }

   }

   public function deleteApparentlyRefueling(int $refueling_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "UPDATE `refueling` 
           SET `REMOVAL_STATUS`= 1 WHERE `REFUELING_ID`= ? "
       );
       $statement->execute([$refueling_id]);
       
       $affectedLine = $statement->rowCount();
       if ($affectedLine == 1){
           return 1 ;
       }else{
           return 0;
       }

   }


   public function getRefueling(int $refueling_id) : ?Refueling
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM `refueling` WHERE REFUELING_ID = ?"
        ); 

        $statement->execute([$refueling_id]); 

        while($row = $statement->fetch()){

            $refueling = new Refueling(); 
            $refueling->refueling_id = $row['REFUELING_ID'];
            $refueling->aeronef_id = $row['AERONEF_ID'];
            $refueling->personal_id = $row['PERSONAL_ID'];
            $refueling->quantity = $row['QUANTITY'];
            $refueling->refueling_date = $row['REFUELING_DATE'];
            $refueling->removal_status = $row['REMOVAL_STATUS'];
        }
        return $refueling; 
    }


    public function updateRefueling(int $aeronef_id, int $personal_id, float $quantity, string $refueling_date, int $refueling_id) : bool 
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `refueling` 
            SET  `AERONEF_ID`= ?,
            `PERSONAL_ID`= ?,
            `QUANTITY`= ? ,
            `REFUELING_DATE`= ?
             WHERE REFUELING_ID = ?"
        );
        $statement->execute([$aeronef_id, $personal_id, $quantity, $refueling_date, $refueling_id]); 
        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        } else{
            return 0;
        }
    }

}