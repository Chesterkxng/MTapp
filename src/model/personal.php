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

    // return the list of all profiles registered in the database
    public function getProfiles(): array
    {
        $statement = $this->connection->getConnection()->query(
            " SELECT * FROM personal"
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
        $statement->execute([$login_id, $grade, $first_name, $surname, $function]); 

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

    


}