<?php
namespace Application\Controllers\DefuelingControllers\Defueling;
session_start();
require_once('src/lib/database.php');
require_once('src/model/defueling.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Defueling\DefuelingRepository;
class Defueling
{
    public function defuelingList()
    {
        $defuelingRespository = new DefuelingRepository();
        $defuelingRespository->connection = new DatabaseConnection();
        $defuelings = $defuelingRespository->getDefuelings();
        require('templates/defueling/defuelingList.php');
    }
    public function addingFormPage()
    {
        require('templates/defueling/addingForm.php');
    }
    public function addDefueling(array $input)
    {
        require('templates/defueling/addingForm.php');
        if ($input !== null) {
            $aeronef_id = null;
            $personal_id = null;
            $quantity = null;
            $defueling_date = null;
            $reason = null;
            if (
                !empty($input['affected_aeronef']) && !empty($input['operator'])
                && !empty($input['quantity']) && !empty($input['DEFUELING_DATE'])  && !empty($input['REASON'])
            ) {
                $aeronef_id = $input['affected_aeronef'];
                $personal_id = $input['operator'];
                $quantity = $input['quantity'];
                $defueling_date = $input['DEFUELING_DATE'];
                $reason = $input['REASON'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $defuelingRespository = new DefuelingRepository();
            $defuelingRespository->connection = new DatabaseConnection();
            $success = $defuelingRespository->addDefueling($aeronef_id, $personal_id, $quantity, $defueling_date, $reason);
            if ($success == 0) {
                echo '<script type="text/javascript">
                        addingErrorAlert()
                    </script>';
            } else {
                echo '<script type="text/javascript">
                        addingSuccessAlert()
                    </script>';
            }
        }
    }
    public function updateDefuelingForm(int $defueling_id)
    {
        $defuelingRespository = new DefuelingRepository();
        $defuelingRespository->connection = new DatabaseConnection();
        $defueling = $defuelingRespository->getDefueling($defueling_id);
        require('templates/defueling/updateForm.php');
    }
    public function updateDefueling(array $input, int $defueling_id)
    {
        $defuelingRespository = new DefuelingRepository();
        $defuelingRespository->connection = new DatabaseConnection();
        $defueling = $defuelingRespository->getDefueling($defueling_id);
        require('templates/defueling/updateForm.php');
        if ($input !== null) {
            $aeronef_id = null;
            $personal_id = null;
            $quantity = null;
            $defueling_date = null;
            $reason = null;
            if (
                !empty($input['affected_aeronef']) && !empty($input['operator'])
                && !empty($input['quantity']) && !empty($input['DEFUELING_DATE']) && !empty($input['REASON'])
            ) {
                $aeronef_id = $input['affected_aeronef'];
                $personal_id = $input['operator'];
                $quantity = $input['quantity'];
                $defueling_date = $input['DEFUELING_DATE'];
                $reason = $input['REASON'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $defuelingRespository = new DefuelingRepository();
            $defuelingRespository->connection = new DatabaseConnection();
            $success = $defuelingRespository->updateDefueling($aeronef_id, $personal_id, $quantity, $defueling_date, $reason, $defueling_id);
            if ($success == 0) {
                echo '<script type="text/javascript">
                        updateErrorAlert()
                    </script>';
            } else {
                echo '<script type="text/javascript">
                        updateSuccessAlert()
                    </script>';
            }
        }
    }
    public function sendDeletePopup(int $defueling_id)
    {
        $defuelingRespository = new DefuelingRepository();
        $defuelingRespository->connection = new DatabaseConnection();
        $defuelings = $defuelingRespository->getDefuelings();
        require('templates/defueling/defuelingList.php');
        echo '<script type="text/javascript">
            deletingConfirmAlert()
        </script>';
    }
    public function setDefuelingInactive(int $defueling_id)
    {
        $defuelingRespository = new DefuelingRepository();
        $defuelingRespository->connection = new DatabaseConnection();
        $defuelings = $defuelingRespository->getDefuelings();
        require('templates/defueling/defuelingList.php');
        $bool = $defuelingRespository->deleteApparentlyDefueling($defueling_id);
        if ($bool == 1) {
            echo '<script type="text/javascript">
                        deletingSuccessAlert()
                    </script>';
        } else {
            echo '<script type="text/javascript">
                    deletingErrorAlert()
                </script>';
        }
    }
}
