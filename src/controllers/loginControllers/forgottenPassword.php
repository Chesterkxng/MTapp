<?php
namespace Application\Controllers\LoginControllers\forgottenPassword;
session_start();
require_once('src/lib/database.php');
require_once('src/model/login.php');
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Login\LoginRepository;
class forgottenPassword
{
    public function forgottenPasswordPage()
    {
        require('templates/login/forgottenPassword.php');
    }
    public function redirectQA(array $input)
    {
        require('templates/login/forgottenPassword.php');
        if ($input !== null) {
            $username = null;
            $password = null;
            $password2 = null;
            if (!empty($input['Username']) && !empty($input['Password']) && !empty($input["Password2"])) {
                $username = $input['Username'];
                $password = $input['Password'];
                $password2 = $input['Password2'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
        }
        $loginRepository = new LoginRepository();
        $loginRepository->connection = new DatabaseConnection();
        $isUsernameExist = $loginRepository->isUsernameExist($username);
        if ($isUsernameExist == 1) {
            if ($password == $password2) {
                $_SESSION['USERNAME'] = $username;
                $_SESSION['NEW_PASSWORD'] = $password;
                echo '<script type="text/javascript">
                                redirectQAAlert()
                            </script>';
            } else {
                echo '<script type="text/javascript">
                                mismatchPasswordAlert()
                            </script>';
            }
        } else {
            echo '<script type="text/javascript">
                            userNotFoundAlert()
                    </script>';
        }
    }
}
