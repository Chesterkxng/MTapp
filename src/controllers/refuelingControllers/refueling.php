<?php
namespace Application\Controllers\RefuelingControllers\Refueling;
session_start();
require_once('src/lib/database.php');
require_once('src/model/refueling.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Refueling\RefuelingRepository;
class Refueling
{
    public function refuelingList()
    {
        $refuelingRespository = new RefuelingRepository();
        $refuelingRespository->connection = new DatabaseConnection();
        $refuelings = $refuelingRespository->getRefuelings();
        require('templates/refueling/refuelingList.php');
    }
    public function addingFormPage()
    {
        require('templates/refueling/addingForm.php');
    }
    public function addRefueling(array $input)
    {
        require('templates/refueling/addingForm.php');
        if ($input !== null) {
            $aeronef_id = null;
            $personal_id = null;
            $quantity = null;
            $refueling_date = null;
            if (
                !empty($input['affected_aeronef']) && !empty($input['operator'])
                && !empty($input['quantity']) && !empty($input['REFUELING_DATE'])
            ) {
                $aeronef_id = $input['affected_aeronef'];
                $personal_id = $input['operator'];
                $quantity = $input['quantity'];
                $refueling_date = $input['REFUELING_DATE'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $refuelingRespository = new RefuelingRepository();
            $refuelingRespository->connection = new DatabaseConnection();
            $success = $refuelingRespository->addRefueling($aeronef_id, $personal_id, $quantity, $refueling_date);
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
    public function updateRefuelingForm(int $refueling_id)
    {
        $refuelingRespository = new RefuelingRepository();
        $refuelingRespository->connection = new DatabaseConnection();
        $refueling = $refuelingRespository->getRefueling($refueling_id);
        require('templates/refueling/updateForm.php');
    }
    public function updateRefueling(array $input, int $refueling_id)
    {
        $refuelingRespository = new RefuelingRepository();
        $refuelingRespository->connection = new DatabaseConnection();
        $refueling = $refuelingRespository->getRefueling($refueling_id);
        require('templates/refueling/updateForm.php');
        if ($input !== null) {
            $aeronef_id = null;
            $personal_id = null;
            $quantity = null;
            $refueling_date = null;
            if (
                !empty($input['affected_aeronef']) && !empty($input['operator'])
                && !empty($input['quantity']) && !empty($input['REFUELING_DATE'])
            ) {
                $aeronef_id = $input['affected_aeronef'];
                $personal_id = $input['operator'];
                $quantity = $input['quantity'];
                $refueling_date = $input['REFUELING_DATE'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $refuelingRespository = new RefuelingRepository();
            $refuelingRespository->connection = new DatabaseConnection();
            $success = $refuelingRespository->updateRefueling($aeronef_id, $personal_id, $quantity, $refueling_date, $refueling_id);
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
    public function sendDeletePopup(int $refueling_id)
    {
        $refuelingRespository = new RefuelingRepository();
        $refuelingRespository->connection = new DatabaseConnection();
        $refuelings = $refuelingRespository->getRefuelings();
        require('templates/refueling/refuelingList.php');
        echo '<script type="text/javascript">
            deletingConfirmAlert()
        </script>';
    }
    public function setRefuelingInactive(int $refueling_id)
    {
        $refuelingRespository = new RefuelingRepository();
        $refuelingRespository->connection = new DatabaseConnection();
        $refuelings = $refuelingRespository->getRefuelings();
        require('templates/refueling/refuelingList.php');
        $bool = $refuelingRespository->deleteApparentlyRefueling($refueling_id);
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
