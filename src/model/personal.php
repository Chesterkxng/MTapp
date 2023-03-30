<?php 

namespace Application\Model\Personal; 

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Personal
{
    public int $personal_id; 
    public int $login_id;
    public string $grade; 
    public string $surname;
    public string $first_name; 
    public string $function; 
    

}

class PersonalRepository
{
    public DatabaseConnection $connection;

    // PROFILE SECTION 
        // return the list of all profiles registered in the database
        public function getProfiles(): array
        {
            $statement = $this->connection->getConnection()->query(
                " SELECT * FROM personal WHERE LOGIN_ID IS NOT NULL "
            );

            $personals = [];
            while($row = $statement->fetch()){

                $personal = new Personal(); 
                $personal->personal_id = $row['PERSONAL_ID'];
                $personal->login_id = $row['LOGIN_ID']; 
                $personal->grade = $row['GRADE'];
                $personal->surname = $row['SURNAME']; 
                $personal->first_name = $row['FIRST_NAME'];
                $personal->function = $row['FUNCTION'];

                $personals[] = $personal; 


            }
            return $personals;
        }

        public function getProfile(int $login_id): ?Personal
        {
            $statement = $this->connection->getConnection()->prepare(
                " SELECT * FROM personal WHERE `LOGIN_ID`= ? "
            );

            $statement->execute([$login_id]);
            while($row = $statement->fetch()){

                $personal = new Personal(); 
                $personal->personal_id = $row['PERSONAL_ID'];
                $personal->login_id = $row['LOGIN_ID']; 
                $personal->grade = $row['GRADE'];
                $personal->surname = $row['SURNAME']; 
                $personal->first_name = $row['FIRST_NAME'];
                $personal->function = $row['FUNCTION'];


            }
            return $personal;
        }

        public function addProfile(int $login_id, string $grade, string $first_name, string $surname, string $function): bool
        {
            $statement = $this->connection->getConnection()->prepare(
                "INSERT INTO personal(`LOGIN_ID`, `GRADE`, `FIRST_NAME`, `SURNAME`, `FUNCTION`) VALUES(?, ?, ?, ?, ?)"
            ); 
            $statement->execute([$login_id, strtoupper($grade), strtoupper($first_name), strtoupper($surname), strtoupper($function)]); 

            $affectedLine = $statement->rowCount();
            if ($affectedLine == 1){
                return 1 ;
            }else{
                return 0;
            }
        } 

        public function isProfileFilled(int $login_id): bool
        {
            $statement = $this->connection->getConnection()->prepare(
                "SELECT * FROM personal WHERE `LOGIN_ID` = ?"
            );
            $statement->execute([$login_id]);

            $affectedLine = $statement->rowCount();
            if ($affectedLine == 1){
                return 1 ;
            }else{
                return 0;
            }

        }





        public function updateProfile(string $grade, string $first_name, string $surname, string $function, int $login_id): bool
        {
            $statement = $this->connection->getConnection()->prepare(
                "UPDATE  personal
                SET `GRADE` = ?, 
                `FIRST_NAME` = ?, 
                `SURNAME` = ?, 
                `FUNCTION` = ?
                 WHERE LOGIN_ID = ?"
            ); 
            $statement->execute([strtoupper($grade), strtoupper($first_name), strtoupper($surname), strtoupper($function), $login_id]); 

            $affectedLine = $statement->rowCount();
            if ($affectedLine == 1){
                return 1 ;
            }else{
                return 0;
            }
        } 
    // END OF PROFILE SECTION




    // PERSONAL SECTION 

        public function addPersonal(string $grade, string $first_name, string $surname, string $function): bool
        {
            $statement = $this->connection->getConnection()->prepare(
                "INSERT INTO personal(`GRADE`, `FIRST_NAME`, `SURNAME`, `FUNCTION`) VALUES(?, ?, ?, ?)"
            ); 
            $statement->execute([strtoupper($grade), strtoupper($first_name), strtoupper($surname), strtoupper($function)]); 

            $affectedLine = $statement->rowCount();
            if ($affectedLine == 1){
                return 1 ;
            }else{
                return 0;
            }
        } 

        public function getPersonals(): array
        {
            $statement = $this->connection->getConnection()->query(
                " SELECT * FROM personal WHERE REMOVAL_STATUS = 0
                ORDER BY GRADE"
            );

            $personals = [];
            while($row = $statement->fetch()){

                $personal = new Personal(); 
                $personal->personal_id = $row['PERSONAL_ID'];
                $personal->grade = $row['GRADE'];
                $personal->surname = $row['SURNAME']; 
                $personal->first_name = $row['FIRST_NAME'];
                $personal->function = $row['FUNCTION'];

                $personals[] = $personal; 


            }
            return $personals;
        }


        public function getPersonal(int $personal_id): ?Personal
        {
            $statement = $this->connection->getConnection()->prepare(
                " SELECT * FROM personal 
                WHERE PERSONAL_ID = ?"
            );

            $statement->execute([$personal_id]);

            while($row = $statement->fetch()){

                $personal = new Personal(); 
                $personal->personal_id = $row['PERSONAL_ID'];
                $personal->grade = $row['GRADE'];
                $personal->surname = $row['SURNAME']; 
                $personal->first_name = $row['FIRST_NAME'];
                $personal->function = $row['FUNCTION'];

            }
            return $personal;
        }


        public function updatePersonal(string $grade, string $first_name, string $surname, string $function, int $personal_id): bool
        {
            $statement = $this->connection->getConnection()->prepare(
                "UPDATE  personal
                SET `GRADE` = ?, 
                `FIRST_NAME` = ?, 
                `SURNAME` = ?, 
                `FUNCTION` = ?
                 WHERE PERSONAL_ID = ?"
            ); 
            $statement->execute([strtoupper($grade), strtoupper($first_name), strtoupper($surname), strtoupper($function), $personal_id]); 

            $affectedLine = $statement->rowCount();
            if ($affectedLine == 1){
                return 1 ;
            }else{
                return 0;
            }
        } 

        public function isPersonalRegistered(int $personal_id): bool
        {
            $statement = $this->connection->getConnection()->prepare(
                "SELECT `LOGIN_ID` FROM personal 
                WHERE  PERSONAL_ID = ?"
            );
            $statement->execute([$personal_id]);
            $row = $statement->fetch();
            $login_id = $row['LOGIN_ID'];
            
            if ($login_id != null){
                return 1 ;
            }else{
                return 0;
            }

        }

        public function deleteApparentlyPersonal(int $personal_id)
        {
            $statement = $this->connection->getConnection()->prepare(
                "UPDATE `personal` 
                SET `REMOVAL_STATUS`= 1 WHERE `PERSONAL_ID`= ? "
            );
            $statement->execute([$personal_id]);
            
            $affectedLine = $statement->rowCount();
            if ($affectedLine == 1){
                return 1 ;
            }else{
                return 0;
            }
        }


        public function deletePermanentlyAeronef(int $personal_id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM `personal`  WHERE `PERSONAL_ID`= ? "
        );
        $statement->execute([$personal_id]);

        $affectedLines = $statement->rowCount();
        if ($affectedLines == 1){
            return 1 ;
        }else{
            return 0;
        }

    }

        


}