<?php 

namespace Application\Model\Type; 

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection; 

class Type
{
    public int $type_id; 
    public string $type; 
}

class TypeRepository
{
    public DatabaseConnection $connection; 

    public function getTypes():array
    {
        $statement =  $this->connection->getConnection()->query(
            "SELECT * FROM `type`"
        ); 

        $types = []; 
        while ($row = $statement->fetch()){
            $type = new Type(); 
            $type->type_id = $row["TYPE_ID"]; 
            $type->type = $row['TYPE']; 

            $types[] = $type;  
        }
        return $types; 
    }

    public function getType(int $type_id):?Type
    {
        $statement =  $this->connection->getConnection()->prepare(
            "SELECT * FROM `type`
            WHERE TYPE_ID = ?"
        );
        
        $statement->execute([$type_id]); 

        while ($row = $statement->fetch()){
            $type = new Type(); 
            $type->type_id = $row["TYPE_ID"]; 
            $type->type = $row['TYPE'];   
        }
        return $type; 
    } 
}