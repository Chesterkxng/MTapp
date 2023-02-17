<?php 

namespace Application\Model\Breakdown; 

require_once('src/lib/database.php'); 

use Application\Lib\Database\DatabaseConnection;

class Breakdown
{
    public int $breakdonw_id; 
    public int $aeronef_id; 
    public int $personal_id; 
    public string $name; 
    public int $bsm_number; 
    public string $description; 
    public string $action; 
    public string $found_date; 
    public string $repair_end_date; 
    public int $repairing_status; 
    public int $removal_status; 

}