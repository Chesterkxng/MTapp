<?php
namespace Application\Controllers\LoginControllers\SignIn;
session_start();
require_once('src/lib/database.php');
require_once('src/model/login.php');
require_once('src/model/personal.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Login\LoginRepository;
use Application\Model\Personal\PersonalRepository;
class SignIn
{
    public function signInPage()
    {
        require('templates/login/signIn.php');
    }
    public function connect(array $input)    // modifier le html pour que les valeurs puisse etre recus 
    {
        require('templates/login/signIn.php');
        if ($input !== null) {
            $username = null;
            $password = null;
            if (!empty($input['Username']) && !empty($input['Password'])) {
                $username = $input['Username'];
                $password = $input['Password'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $loginRepository = new LoginRepository();
            $loginRepository->connection = new DatabaseConnection();
            $bool = $loginRepository->isUsernameExist($username);
            if ($bool == 1) {
                $hashed_password = hash('sha256', $password);
                $passW = $loginRepository->getPassword($username);
                if ($passW == $hashed_password) {
                    $login_id = $loginRepository->getLoginID($username);
                    $profileRepository = new PersonalRepository();
                    $profileRepository->connection = new DatabaseConnection();
                    $isFilledProfile = $profileRepository->isProfileFilled($login_id);
                    $_SESSION['LOGIN_ID'] = $login_id;
                    $_SESSION['ISAUTH'] = 1;
                    if ($isFilledProfile == 1) {
                        echo '<script type="text/javascript">
                                loginSuccesAlert()
                            </script>';
                    } else {
                        echo '<script type="text/javascript">
                                redirectProfileAlert()
                            </script>';
                    }
                } else {
                    echo '<script type="text/javascript">
                            incorrectPasswordAlert()
                            </script>';
                }
            } else {
                echo '<script type="text/javascript">
                        userNotFoundAlert()
                        </script>';
            }
        }
    }
}
