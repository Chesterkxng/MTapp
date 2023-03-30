<?php
namespace Application\Controllers\BreakdownControllers\Breakdown;
session_start();
require_once('src/lib/database.php');
require_once('src/model/breakdown.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Breakdown\BreakdownRepository;
class Breakdown
{
    public function breakdownList()
    {
        $breakdownRepository = new BreakdownRepository();
        $breakdownRepository->connection = new DatabaseConnection();
        $breakdowns = $breakdownRepository->getPendingBreakdowns();
        $breakdownsHistory = $breakdownRepository->getBreakdownsHistoric();
        require('templates/breakdown/breakdownList.php');
    }
    public function addingFormPage()
    {
        require('templates/breakdown/addingForm.php');
    }
    public function addBreakdown(array $input)
    {
        require('templates/breakdown/addingForm.php');
        if ($input !== null) {
            $name = null;
            $bsm_number = null;
            $aeronef_id = null;
            $description = null;
            $finding_date = null;
            $found_by = null;
            $action = null;
            $repairing_status = null;
            if (
                !empty($input['name']) && !empty($input['BSM']) && !empty($input['affected_aeronef'])
                && !empty($input['description']) && !empty($input['FINDING_DATE']) && !empty($input['found_by'])
                && !empty($input['action']) && !empty($input['repairing_status'])
            ) {
                $name = $input['name'];
                $bsm_number = $input['BSM'];
                $aeronef_id = $input['affected_aeronef'];
                $description = $input['description'];
                $finding_date = $input['FINDING_DATE'];
                $found_by = $input['found_by'];
                $action = $input['action'];
                $repairing_status = $input['repairing_status'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $breakdownRepository = new BreakdownRepository();
            $breakdownRepository->connection = new DatabaseConnection();
            $success = $breakdownRepository->addBreakdown($name, $bsm_number, $aeronef_id, $description, $finding_date, $found_by, $action, $repairing_status);
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
    public function updateBreakdownPage(int $breakdown_id)
    {
        $breakdownRepository = new BreakdownRepository();
        $breakdownRepository->connection = new DatabaseConnection();
        $breakdown = $breakdownRepository->getPendingBreakdown($breakdown_id);
        require('templates/breakdown/updateForm.php');
    }
    public function updateBreakdown(int $breakdown_id, array $input)
    {
        $breakdownRepository = new BreakdownRepository();
        $breakdownRepository->connection = new DatabaseConnection();
        $breakdown = $breakdownRepository->getPendingBreakdown($breakdown_id);
        require('templates/breakdown/updateForm.php');
        if ($input !== null) {
            $name = null;
            $bsm_number = null;
            $aeronef_id = null;
            $description = null;
            $finding_date = null;
            $found_by = null;
            $action = null;
            $repairing_status = null;
            $repair_end_date = null;
            if (
                !empty($input['name']) && !empty($input['BSM']) && !empty($input['affected_aeronef'])
                && !empty($input['description']) && !empty($input['FINDING_DATE']) && !empty($input['found_by'])
                && !empty($input['action']) && !empty($input['repairing_status'])
            ) {
                $name = $input['name'];
                $bsm_number = $input['BSM'];
                $aeronef_id = $input['affected_aeronef'];
                $description = $input['description'];
                $finding_date = $input['FINDING_DATE'];
                $found_by = $input['found_by'];
                $action = $input['action'];
                $repairing_status = $input['repairing_status'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $breakdownRepository = new BreakdownRepository();
            $breakdownRepository->connection = new DatabaseConnection();
            if ($repairing_status == 2) {
                if (!empty($input['REPAIR_END_DATE'])) {
                    $repair_end_date = $input['REPAIR_END_DATE'];
                    $bool = $breakdownRepository->updateBreakdown($breakdown_id, $name, $bsm_number, $aeronef_id, $description, $finding_date, $found_by, $action, $repairing_status);
                    $bool1 = $breakdownRepository->addRepairEndDate($breakdown_id, $repair_end_date);
                    if ($bool == 1 && $bool1 == 1) {
                        echo '<script type="text/javascript">
                            updateSuccessAlert()
                        </script>';
                    } else {
                        echo '<script type="text/javascript">
                            updateErrorAlert()
                        </script>';
                    }
                } else {
                    echo '<script type="text/javascript">
                            updateErrorAlert2()
                        </script>';
                }
            } else {
                $bool = $breakdownRepository->updateBreakdown($breakdown_id, $name, $bsm_number, $aeronef_id, $description, $finding_date, $found_by, $action, $repairing_status);
                if ($bool == 1) {
                    echo '<script type="text/javascript">
                        updateSuccessAlert()
                    </script>';
                }
            }
        }
    }
    public function sendDeletePopup(int $breakdown_id)
    {
        $breakdownRepository = new BreakdownRepository();
        $breakdownRepository->connection = new DatabaseConnection();
        $breakdowns = $breakdownRepository->getPendingBreakdowns();
        $breakdownsHistory = $breakdownRepository->getBreakdownsHistoric();
        require('templates/breakdown/breakdownList.php');
        echo '<script type="text/javascript">
            deletingConfirmAlert()
        </script>';
    }
    public function setBreakdownInactive(int $breakdown_id)
    {
        $breakdownRepository = new BreakdownRepository();
        $breakdownRepository->connection = new DatabaseConnection();
        $breakdowns = $breakdownRepository->getPendingBreakdowns();
        $breakdownsHistory = $breakdownRepository->getBreakdownsHistoric();
        require('templates/breakdown/breakdownList.php');
        $bool = $breakdownRepository->deleteApparentlyBreakdown($breakdown_id);
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
