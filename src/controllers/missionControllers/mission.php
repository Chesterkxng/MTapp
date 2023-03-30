<?php
namespace Application\Controllers\MissionControllers\Mission;
session_start();
require_once('src/model/mission.php');
require_once('src/lib/database.php');
require_once('src/model/type.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Mission\MissionRepository;
use Application\Model\Type\TypeRepository;
class Mission
{
    public function missionList()
    {
        $missionRepository = new MissionRepository();
        $missionRepository->connection = new DatabaseConnection();
        $missions = $missionRepository->getPendingMissions();
        $missionsHistory = $missionRepository->getHistoricalMissions();
        require('templates/mission/missionList.php');
    }
    public function addingFormPage()
    {
        require('templates/mission/addingForm.php');
    }
    public function addMission(array $input)
    {
        require('templates/mission/addingForm.php');
        if ($input !== null) {
            $captain = null;
            $type_id = null;
            $aeronef_id = null;
            $destination = null;
            $departure_date = null;
            $return_date = null;
            $beneficiary = null;
            $passengers_number = null;
            $status = null;
            if (
                !empty($input['captain']) && !empty($input['type']) && !empty($input['affected_aeronef'])
                && !empty($input['destination']) && !empty($input['DEPARTURE_DATE']) && !empty($input['RETURN_DATE'])
                && !empty($input['beneficiary']) && !empty($input['passengers_number']) && !empty($input['mission_status'])
            ) {
                $captain = $input['captain'];
                $type_id = $input['type'];
                $aeronef_id = $input['affected_aeronef'];
                $destination = $input['destination'];
                $departure_date = $input['DEPARTURE_DATE'];
                $return_date = $input['RETURN_DATE'];
                $beneficiary = $input['beneficiary'];
                $passengers_number = $input['passengers_number'];
                $status = $input['mission_status'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $missionRepository = new MissionRepository();
            $missionRepository->connection = new DatabaseConnection();
            $success = $missionRepository->addMission(
                $captain,
                $type_id,
                $aeronef_id,
                $destination,
                $departure_date,
                $return_date,
                $passengers_number,
                $beneficiary,
                $status
            );
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
    public function updateFormPage(int $mission_id)
    {
        $missionRepository = new MissionRepository();
        $missionRepository->connection = new DatabaseConnection();
        $mission = $missionRepository->getMission($mission_id);
        require('templates/mission/updateForm.php');
    }
    public function updateMission(int $mission_id, array $input)
    {
        require('templates/mission/addingForm.php');
        if ($input !== null) {
            $captain = null;
            $type_id = null;
            $aeronef_id = null;
            $destination = null;
            $departure_date = null;
            $return_date = null;
            $beneficiary = null;
            $passengers_number = null;
            $status = null;
            if (
                !empty($input['captain']) && !empty($input['type']) && !empty($input['affected_aeronef'])
                && !empty($input['destination']) && !empty($input['DEPARTURE_DATE']) && !empty($input['RETURN_DATE'])
                && !empty($input['beneficiary']) && !empty($input['passengers_number']) && !empty($input['mission_status'])
            ) {
                $captain = $input['captain'];
                $type_id = $input['type'];
                $aeronef_id = $input['affected_aeronef'];
                $destination = $input['destination'];
                $departure_date = $input['DEPARTURE_DATE'];
                $return_date = $input['RETURN_DATE'];
                $beneficiary = $input['beneficiary'];
                $passengers_number = $input['passengers_number'];
                $status = $input['mission_status'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $missionRepository = new MissionRepository();
            $missionRepository->connection = new DatabaseConnection();
            $success = $missionRepository->updateMission(
                $captain,
                $type_id,
                $aeronef_id,
                $destination,
                $departure_date,
                $return_date,
                $passengers_number,
                $beneficiary,
                $status,
                $mission_id
            );
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
    public function sendDeletePopup(int $mission_id)
    {
        $missionRepository = new MissionRepository();
        $missionRepository->connection = new DatabaseConnection();
        $missions = $missionRepository->getPendingMissions();
        $missionsHistory = $missionRepository->getHistoricalMissions();
        require('templates/mission/missionList.php');
        echo '<script type="text/javascript">
            deletingConfirmAlert()
        </script>';
    }
    public function setMissionInactive(int $mission_id)
    {
        $missionRepository = new MissionRepository();
        $missionRepository->connection = new DatabaseConnection();
        $missions = $missionRepository->getPendingMissions();
        $missionsHistory = $missionRepository->getHistoricalMissions();
        require('templates/mission/missionList.php');
        $bool = $missionRepository->deleteApparentlyMission($mission_id);
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
