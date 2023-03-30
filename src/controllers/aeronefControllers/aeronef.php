<?php
namespace Application\Controllers\AeronefControllers\Aeronef;
session_start();
require_once('src/lib/database.php');
require_once('src/model/aeronef.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Aeronef\AeronefRepository;
class Aeronef
{
    public DatabaseConnection $connection;
    // Get the list of active aeronefs (those which are not deleted or hidden)
    public function getActiveAeronefs()
    {
        $aeronefRepositoty = new AeronefRepository();
        $aeronefRepositoty->connection = new DatabaseConnection();
        $aeronefs = $aeronefRepositoty->getActiveAeronefs();
        require('templates/aeronef/aeronefList.php');
    }
    // load the updateForm of a selected aeronef
    public function updateAeronefPage(int $aeronef_id)
    {
        $aeronefRepositoty = new AeronefRepository();
        $aeronefRepositoty->connection = new DatabaseConnection();
        $aeronef = $aeronefRepositoty->getAeronef($aeronef_id);
        require('templates/aeronef/updateForm.php');
    }
    // udpate the selected aeronef with informations filled in the UpdateForm
    public function updateAeronef($aeronef_id, $input)
    {
        require('templates/aeronef/updateForm.php');
        if ($input !== null) {
            $immatriculation = null;
            $S_N = null;
            $fh = null;
            $ldgs = null;
            $rh_eng_dh = null;
            $lh_eng_dh = null;
            $availability = null;
            if (
                !empty($input['immatriculation']) && !empty($input['S_N']) && !empty($input['FH'])
                && !empty($input['LDGS']) && !empty($input['RH_ENG_DH']) && !empty($input['LH_ENG_DH']) && !empty($input['availability'])
            ) {
                $immatriculation = $input['immatriculation'];
                $S_N = $input['S_N'];
                $fh = $input['FH'];
                $ldgs = $input['LDGS'];
                $rh_eng_dh = $input['RH_ENG_DH'];
                $lh_eng_dh = $input['LH_ENG_DH'];
                $availability = $input['availability'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $aeronefRepositoty = new AeronefRepository();
            $aeronefRepositoty->connection = new DatabaseConnection();
            $success = $aeronefRepositoty->updateAeronef($aeronef_id, $immatriculation, $S_N, $fh, $ldgs, $rh_eng_dh, $lh_eng_dh, $availability);
            if ($success == 1) {
                echo '<script type="text/javascript">
                            updateSuccessAlert()
                        </script>';
            } else {
                echo '<script type="text/javascript">
                        updateErrorAlert()
                    </script>';
            }
        }
    }
    // load the aeronef's adding Form
    public function addingFormPage()
    {
        require('templates/aeronef/addingForm.php');
    }
    // when the information are filled in the form 
    public function addNewAeronef(array $input)
    {
        require('templates/aeronef/addingForm.php');
        if ($input !== null) {
            $immatriculation = null;
            $S_N = null;
            $fh = null;
            $ldgs = null;
            $rh_eng_dh = null;
            $lh_eng_dh = null;
            $commissioning_date = null;
            $availability = null;
            if (
                !empty($input['immatriculation']) && !empty($input['S_N']) && !empty($input['FH'])
                && !empty($input['LDGS']) && !empty($input['RH_ENG_DH']) && !empty($input['LH_ENG_DH'])
                && !empty($input['availability']) && !empty($input['COMMISSIONING_DATE'])
            ) {
                $immatriculation = $input['immatriculation'];
                $S_N = $input['S_N'];
                $fh = $input['FH'];
                $ldgs = $input['LDGS'];
                $rh_eng_dh = $input['RH_ENG_DH'];
                $lh_eng_dh = $input['LH_ENG_DH'];
                $commissioning_date = $input['COMMISSIONING_DATE'];
                $availability = $input['availability'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $aeronefRepositoty = new AeronefRepository();
            $aeronefRepositoty->connection = new DatabaseConnection();
            $bool = $aeronefRepositoty->addNewAeronef($immatriculation, $S_N, $fh, $ldgs, $rh_eng_dh, $lh_eng_dh, $commissioning_date, $availability);
            if ($bool == 1) {
                echo '<script type="text/javascript">
                            addingSuccessAlert()
                        </script>';
            } else {
                echo '<script type="text/javascript">
                        addingErrorAlert()
                    </script>';
            }
        }
    }
    public function sendDeletePopup(int $aeronef_id)
    {
        $aeronefRepositoty = new AeronefRepository();
        $aeronefRepositoty->connection = new DatabaseConnection();
        $aeronefs = $aeronefRepositoty->getActiveAeronefs();
        require('templates/aeronef/aeronefList.php');
        echo '<script type="text/javascript">
            deletingConfirmAlert()
        </script>';
    }
    public function setAeronefInactive(int $aeronef_id)
    {
        $aeronefRepositoty = new AeronefRepository();
        $aeronefRepositoty->connection = new DatabaseConnection();
        $aeronefs = $aeronefRepositoty->getActiveAeronefs();
        require('templates/aeronef/aeronefList.php');
        $bool = $aeronefRepositoty->deleteApparentlyAeronef($aeronef_id);
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
