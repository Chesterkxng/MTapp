<?php
namespace Application\Controllers\PersonalControllers\Personal;
session_start();
require_once('src/lib/database.php');
require_once('src/model/personal.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Personal\PersonalRepository;
class Personal
{
    public function getPersonelList()
    {
        $personalRepository = new PersonalRepository();
        $personalRepository->connection = new DatabaseConnection;
        $personals = $personalRepository->getPersonals();
        require('templates/personal/personalList.php');
    }
    //Load the update form if the user has no account
    public function updatePersonalForm(int $personal_id)
    {
        $personalRepository = new PersonalRepository();
        $personalRepository->connection = new DatabaseConnection;
        $isPersonalRegistered = $personalRepository->isPersonalRegistered($personal_id);
        if ($isPersonalRegistered == 0) {
            $personal = $personalRepository->getPersonal($personal_id);
            require('templates/personal/updateForm.php');
        } else {
            $personals = $personalRepository->getPersonals();
            require('templates/personal/personalList.php');
            echo '<script type="text/javascript">
                            updateError2Alert()
                        </script>';
        }
    }
    // when the form is filled 
    public function updatePersonal(int $personal_id, array $input)
    {
        require('templates/personal/updateForm.php');
        if ($input !== null) {
            $grade = null;
            $surname = null;
            $first_name = null;
            $function = null;
            if (
                !empty($input['grade']) && !empty($input['surname']) && !empty($input["firstName"])
                && !empty($input["function"])
            ) {
                $grade = $input['grade'];
                $surname = $input['surname'];
                $first_name = $input['firstName'];
                $function = $input['function'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $personalRepository = new PersonalRepository();
            $personalRepository->connection = new DatabaseConnection;
            $bool = $personalRepository->updatePersonal($grade, $first_name, $surname, $function, $personal_id);
            if ($bool == 0) {
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
    public function updateCurrentProfilPage(int $login_id)
    {
        $personalRepository = new PersonalRepository();
        $personalRepository->connection = new DatabaseConnection;
        $personal = $personalRepository->getProfile($login_id);
        require('templates/personal/updateForm.php');
    }
    public function updateProfile(int $login_id, array $input)
    {
        require('templates/personal/updateForm.php');
        if ($input !== null) {
            $grade = null;
            $surname = null;
            $first_name = null;
            $function = null;
            if (
                !empty($input['grade']) && !empty($input['surname']) && !empty($input["firstName"])
                && !empty($input["function"])
            ) {
                $grade = $input['grade'];
                $surname = $input['surname'];
                $first_name = $input['firstName'];
                $function = $input['function'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $personalRepository = new PersonalRepository();
            $personalRepository->connection = new DatabaseConnection;
            $bool = $personalRepository->updateProfile($grade, $first_name, $surname, $function, $login_id);
            if ($bool == 0) {
                echo '<script type="text/javascript">
                            updateErrorAlert()
                        </script>';
            } else {
                echo '<script type="text/javascript">
                            updateProfileSuccessAlert()
                        </script>';
            }
        }
    }
    // load the adding form 
    public function addingPersonalPage()
    {
        require('templates/personal/addingForm.php');
    }
    public function addPersonal(array $input)
    {
        require('templates/personal/addingForm.php');
        if ($input !== null) {
            $grade = null;
            $surname = null;
            $first_name = null;
            $function = null;
            if (
                !empty($input['grade']) && !empty($input['surname']) && !empty($input["firstName"])
                && !empty($input["function"])
            ) {
                $grade = $input['grade'];
                $surname = $input['surname'];
                $first_name = $input['firstName'];
                $function = $input['function'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $personalRepository = new PersonalRepository();
            $personalRepository->connection = new DatabaseConnection;
            $bool = $personalRepository->addPersonal($grade, $first_name, $surname, $function);
            if ($bool == 0) {
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
    public function sendDeletePopup(int $personal_id)
    {
        $personalRepository = new PersonalRepository();
        $personalRepository->connection = new DatabaseConnection();
        $personals = $personalRepository->getPersonals();
        require('templates/personal/personalList.php');
        $isPersonalRegistered = $personalRepository->isPersonalRegistered($personal_id);
        if ($isPersonalRegistered == 0) {
            echo '<script type="text/javascript">
                    deletingConfirmAlert()
                </script>';
        } else {
            echo '<script type="text/javascript">
                    deleteError2Alert()
                </script>';
        }
    }
    public function setPersonalInactive(int $personal_id)
    {
        $personalRepository = new PersonalRepository();
        $personalRepository->connection = new DatabaseConnection();
        $personals = $personalRepository->getPersonals();
        require('templates/personal/personalList.php');
        $bool = $personalRepository->deleteApparentlyPersonal($personal_id);
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
