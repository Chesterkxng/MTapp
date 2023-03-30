<?php

namespace Application\Model\Mission;

require_once('src/lib/database.php'); 

use Application\Lib\Database\DatabaseConnection; 

class Mission
{
    public int $mission_id; 
    public int $personal_id;
    public int $type_id; 
    public string $type;
    public int $aeronef_id;
    public string $captain; 
    public string $destination; 
    public string $departure_date; 
    public string $immatriculation; 
    public string $return_date; 
    public int $passengers_number; 
    public string $beneficiary; 
    public int $status; 
    public int $removal_status; 
}

class MissionRepository
{
    public DatabaseConnection $connection; 

    public function getPendingMissions(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `mission` 
            WHERE STATUS != 2 AND REMOVAL_STATUS = 0"
        );

        $missions = []; 
        while ($row = $statement->fetch()){
            $mission = new Mission(); 
            $mission->mission_id = $row['MISSION_ID']; 
            $mission->personal_id = $row['PERSONAL_ID'];
            $mission->type_id = $row['TYPE_ID']; 
            $mission->aeronef_id = $row['AERONEF_ID']; 
            $mission->destination = $row['DESTINATION']; 
            $mission->departure_date = $row['DEPARTURE_DATE'];  
            $mission->return_date= $row['RETURN_DATE']; 
            $mission->passengers_number = $row['PASSENGERS_NUMBER']; 
            $mission->beneficiary = $row['BENEFICIARY']; 
            $mission->status = $row['STATUS']; 
            $mission->removal_status = $row['REMOVAL_STATUS']; 

            $missions[] = $mission;
        }

        return $missions;
    }



    public function getHistoricalMissions(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `mission` 
            WHERE STATUS = 2 AND REMOVAL_STATUS = 0"
        );

        $missions = []; 
        while ($row = $statement->fetch()){
            $mission = new Mission(); 
            $mission->mission_id = $row['MISSION_ID']; 
            $mission->personal_id = $row['PERSONAL_ID'];
            $mission->type_id = $row['TYPE_ID']; 
            $mission->aeronef_id = $row['AERONEF_ID']; 
            $mission->destination = $row['DESTINATION']; 
            $mission->departure_date = $row['DEPARTURE_DATE'];  
            $mission->return_date= $row['RETURN_DATE']; 
            $mission->passengers_number = $row['PASSENGERS_NUMBER']; 
            $mission->beneficiary = $row['BENEFICIARY']; 
            $mission->status = $row['STATUS']; 
            $mission->removal_status = $row['REMOVAL_STATUS']; 

            $missions[] = $mission;
        }

        return $missions;
    }


    public function getMissions(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM `mission` 
            WHERE REMOVAL_STATUS = 0"
        );

        $missions = []; 
        while ($row = $statement->fetch()){
            $mission = new Mission(); 
            $mission->mission_id = $row['MISSION_ID']; 
            $mission->personal_id = $row['PERSONAL_ID'];
            $mission->type_id = $row['TYPE_ID']; 
            $mission->aeronef_id = $row['AERONEF_ID']; 
            $mission->destination = $row['DESTINATION']; 
            $mission->departure_date = $row['DEPARTURE_DATE'];  
            $mission->return_date= $row['RETURN_DATE']; 
            $mission->passengers_number = $row['PASSENGERS_NUMBER']; 
            $mission->beneficiary = $row['BENEFICIARY']; 
            $mission->status = $row['STATUS']; 
            $mission->removal_status = $row['REMOVAL_STATUS']; 

            $missions[] = $mission;
        }

        return $missions;
    }

    public function getMissions2(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT mission.MISSION_ID, personal.PERSONAL_ID, personal.GRADE, personal.SURNAME, personal.FIRST_NAME, 
            mission.TYPE_ID, type.TYPE, mission.AERONEF_ID, aeronef.IMMATRICULATION, mission.DESTINATION, 
            mission.DEPARTURE_DATE , mission.RETURN_DATE, mission.STATUS
            
            FROM `mission` INNER JOIN `aeronef` 
                        INNER JOIN `personal`
                        INNER JOIN `type`
                        ON mission.AERONEF_ID = aeronef.AERONEF_ID
                        AND mission.PERSONAL_ID = personal.PERSONAL_ID
                        AND mission.TYPE_ID = type.TYPE_ID
                        WHERE mission.REMOVAL_STATUS = 0"
        );

        $missions = []; 
        while ($row = $statement->fetch()){
            $mission = new Mission(); 
            $mission->mission_id = $row['MISSION_ID']; 
            $mission->personal_id = $row['PERSONAL_ID']; 
            $mission->captain = $row['GRADE'].' '.$row['SURNAME'].' '.$row['FIRST_NAME']; 
            $mission->type_id = $row['TYPE_ID']; 
            $mission->type = $row['TYPE']; 
            $mission->aeronef_id = $row['AERONEF_ID']; 
            $mission->immatriculation = $row['IMMATRICULATION']; 
            $mission->destination = $row['DESTINATION']; 
            $mission->departure_date = $row['DEPARTURE_DATE']; 
            $mission->return_date = $row['RETURN_DATE']; 
            $mission->status = $row['STATUS']; 

            $missions[] = $mission; 

           
        }

        return $missions;
    }





    public function addMission(int $personal_id,int $type_id, int $aeronef_id, string $destination,
     string $departure_date, string $return_date, int $passengers_number, string $beneficiary, int $status): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `mission`(`PERSONAL_ID`, `TYPE_ID`, `AERONEF_ID`, `DESTINATION`,
             `DEPARTURE_DATE`, `RETURN_DATE`, `PASSENGERS_NUMBER`, `BENEFICIARY`, `STATUS`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $statement->execute([$personal_id, $type_id, $aeronef_id, $destination, 
        $departure_date, $return_date, $passengers_number, $beneficiary, $status]); 

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }
    }


    public function updateMission(int $personal_id,int $type_id, int $aeronef_id, string $destination,
    string $departure_date, string $return_date, int $passengers_number, string $beneficiary, int $status, $mission_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "UPDATE `mission`
           SET `PERSONAL_ID` = ?,
            `TYPE_ID`= ?,
            `AERONEF_ID`= ?,
            `DESTINATION` = ?,
            `DEPARTURE_DATE` = ?,
            `RETURN_DATE` = ?, 
            `PASSENGERS_NUMBER` = ?,
            `BENEFICIARY` = ?,
            `STATUS`= ? 
            WHERE MISSION_ID = ?"
       );

       $statement->execute([$personal_id, $type_id, $aeronef_id, $destination, 
       $departure_date, $return_date, $passengers_number, $beneficiary, $status, $mission_id]); 

       $affectedLine = $statement->rowCount();
       if ($affectedLine == 1){
           return 1 ;
       }else{
           return 0;
       }
   }
   

   public function getMission(int $mission_id): ?Mission
   {
       $statement = $this->connection->getConnection()->prepare(
           "SELECT * FROM `mission` 
           WHERE  MISSION_ID = ?"
       );

       $statement->execute([$mission_id]);
 
       while ($row = $statement->fetch()){
           $mission = new Mission(); 
           $mission->mission_id = $row['MISSION_ID']; 
           $mission->personal_id = $row['PERSONAL_ID'];
           $mission->type_id = $row['TYPE_ID']; 
           $mission->aeronef_id = $row['AERONEF_ID']; 
           $mission->destination = $row['DESTINATION']; 
           $mission->departure_date = $row['DEPARTURE_DATE'];  
           $mission->return_date= $row['RETURN_DATE']; 
           $mission->passengers_number = $row['PASSENGERS_NUMBER']; 
           $mission->beneficiary = $row['BENEFICIARY']; 
           $mission->status = $row['STATUS']; 
           $mission->removal_status = $row['REMOVAL_STATUS']; 

       }

       return $mission;
   }

   public function deletePermanentlyMission(int $mission_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "DELETE FROM `mission`  WHERE `MISSION_ID`= ? "
       );
       $statement->execute([$mission_id]);

       $affectedLines = $statement->rowCount();
       if ($affectedLines == 1){
           return 1 ;
       }else{
           return 0;
       }

   }

   public function deleteApparentlyMission(int $mission_id): bool
   {
       $statement = $this->connection->getConnection()->prepare(
           "UPDATE `mission` 
           SET `REMOVAL_STATUS`= 1 WHERE `MISSION_ID`= ? "
       );
       $statement->execute([$mission_id]);
       
       $affectedLine = $statement->rowCount();
       if ($affectedLine == 1){
           return 1 ;
       }else{
           return 0;
       }

   }


}