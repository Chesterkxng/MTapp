<?php 

namespace Application\Model\Login;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;


class Login
{
    public int $login_id; 
    public string $username; 
    public string $password;
    public string $security_question; 
    public string $security_answer;
}

class LoginRepository
{
    public DatabaseConnection $connection;



    //recuper l'id de l'utilisateur
    public function getLoginID(string $username): int
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT LOGIN_ID FROM `login` WHERE USERNAME = ?"
        );

        $statement->execute([$username]);
        while (($row = $statement->fetch()))
        {
            $identifer = $row['LOGIN_ID'];
        }
        return $identifer; 

    } 


    public function getLoginInfos(string $username): ?Login
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM `login` WHERE USERNAME = ?"
        );

        $statement->execute([$username]);
        while (($row = $statement->fetch()))
        {   
            $loginInfos = new Login(); 
            $loginInfos->login_id = $row['LOGIN_ID'];
            $loginInfos->username = $row['USERNAME'];
            $loginInfos->security_question = $row['SECURITY_QUESTION'];
            $loginInfos->security_answer = $row['SECURITY_ANSWER'];
        }
        return $loginInfos; 

    }



    // verifier si l'username existe 
    public function isUsernameExist(string $username): bool
    {
        
        $statement = $this->connection->getConnection()->prepare(
            "SELECT LOGIN_ID FROM login WHERE USERNAME = ?"
        );

        $statement->execute([$username]); 
       
        $affectedLines = $statement->rowCount();
        if ($affectedLines == 1){
            return 1 ;
        }else{
            return 0;
        }
    }

    // recuperer le mot de passe en fonction de l'utilisateur 
    public function getPassword(string $username): string 
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT `PASSWORD` FROM login WHERE USERNAME = ?"
        );

        $statement->execute([$username]);
        while (($row = $statement->fetch()))
        {
            $password = $row['PASSWORD'];
        }
        return $password; 

    }

    //ajouter un utilisateur 
    public function addUser(string $username, string $password, string $security_question, string $security_answer): bool 
    {
        
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO login(`USERNAME`, `PASSWORD`, `SECURITY_QUESTION`, `SECURITY_ANSWER`) VALUES(?, ?, ?, ?)"
        ); 
            
        $affectedLines = $statement->execute([$username, $password, $security_question, $security_answer]);      

        $affectedLines = $statement->rowCount();
        if ($affectedLines == 1){
            return 1 ;
        }else{
            return 0;
        }

    }

    //modifier un mot de passe d'utilisateur 
    public function modifyPassword(string $username, string $password): bool
    {
        
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `login` SET `PASSWORD` = ? WHERE USERNAME = ?"
        ); 
        
        $affectedLine = $statement->execute([$password, $username]); 

        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }

    }


    // ajouter la question et la reponse de securité de securité à un compte 
    public function modifySecurityQA(int $login_id , string $security_question, string $security_answer): bool 
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `login` SET SECURITY_QUESTION = ?, SECURITY_ANSWER = ? 
            WHERE LOGIN_ID = ?"
        ); 

        $affectedLine = $statement->execute([$security_question, $security_answer, $login_id]);

        if ($affectedLine == 1){
            return 1 ;
        }else{
            return 0;
        }

    }



    // ajouter la question et la reponse de securité de securité à un compte 
    public function getSecurityAnwer(string $username): string 
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT `SECURITY_ANSWER` FROM `login` 
            WHERE USERNAME = ?"
        ); 

        $statement->execute([$username]);

        while (($row = $statement->fetch()))
        {
            $security_answer = $row['SECURITY_ANSWER'];
        }
        return $security_answer; 

    }


}