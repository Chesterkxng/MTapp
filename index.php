<?php 
error_reporting(E_ALL & ~E_NOTICE);
session_start();    


// LOGIN CONTROLLERS IMPORT 
require_once('src/controllers/loginControllers/SignUp.php');
require_once('src/controllers/loginControllers/profile.php');
require_once('src/controllers/loginControllers/signIn.php'); 
require_once('src/controllers/loginControllers/forgottenPassword.php');
require_once('src/controllers/loginControllers/securityQA.php');

//DASHBOARD CONTROLLERS IMPORT 
require_once('src/controllers/dashboardControllers/dashboard.php');


// AERONEF CONTROLLERS IMPORT

//require_once('src/controllers/aeronefControllers/aeronef.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Personal\PersonalRepository;

use Application\Controllers\LoginControllers\SignUp\SignUp;
use Application\Controllers\LoginControllers\Profile\Profile;
use Application\Controllers\LoginControllers\SignIn\SignIn; 
use Application\Controllers\LoginControllers\forgottenPassword\forgottenPassword;
use Application\Controllers\LoginControllers\SecurityQA\SecurityQA;

use Application\Controllers\DashboardControllers\Dashboard\Dashboard;







//use Application\Controllers\AeronefControllers\Aeronef\Aeronef;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        

        // LOGIN ROUTER

            // SIGN UP PART (ROUTEUR
        
                // when the form for creating a new account is filled and the submit button is clicked 
        if ($_GET['action'] === 'signUp'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new SignUp())->signUp($input);
             }

                // after the popup the user is redirected to the profile informations completion's page  
                // Or when a registered account doesn't have the profile's informations filled    
        } elseif($_GET['action'] === 'signUpProfilePage'){
            $personalRepository = new PersonalRepository();
            $personalRepository->connection = new DatabaseConnection();


            if(isset($_SESSION['LOGIN_ID'])){
                $login_id = $_SESSION['LOGIN_ID'];
                $isProfileFilled = $personalRepository->isProfileFilled($login_id);
                if ($isProfileFilled == 0){
                    (new Profile())->signUpProfilePage();
                }
            }
            

                // once the profile informations Form is filled and the 'complete your profile' button is clicked 
        } elseif($_GET['action'] === 'profileCompletion'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new Profile())->profileCompletion($input);
             }

                // when the 'signIn button is clicked from the sign Up page 
        } elseif ($_GET['action'] === 'signInPage'){
            (new SignIn())->signInPage();
        }

            // END OF SIGN UP ROUTER

            // SIGN IN PART ROUTER
        if($_GET['action'] === 'signIn'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new SignIn())->connect($input);
             }

                // when the forgotten password link is cliked
        } elseif($_GET['action'] === 'forgottenPasswordPage'){

            (new forgottenPassword())->forgottenPasswordPage();

                // when the informations are filled in the form and the password reset's button is pressed 
        } elseif($_GET['action'] === 'redirectQA'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new forgottenPassword())->redirectQA($input);
             }
                // if the informations filled are correct the popup will directly redirect to the security QA verification
        } elseif ($_GET['action'] === 'securityQAPage'){
            (new SecurityQA())->SecurityQAPage();

                // when the security answer is set, the 
        } elseif($_GET['action'] === 'verifyQA'){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new SecurityQA())->VerifiyQA($input);
             }
             // if the informations filled are correct the popup will directly redirect to the security QA verification
        }
            // END OF SIGN IN ROUTEUR 



        // END OF LOGIN ROUTER
        

        // DASHBOARD ROUTER 

        if($_GET['action'] === 'DashboardPage'){
            if(isset($_SESSION['ISAUTH'])){
                $isAuth = $_SESSION['ISAUTH'];
                if($isAuth == 1){
                    (new Dashboard())->DashboardPage();
                }
            }else {
                (new SignIn())->signInPage();
            }
        }

        // END OF DASHBOARD ROUTEUR 



        // MISSION MANAGEMENT ROUTER






        // END OF MISSION MANAGEMENT ROUTER



        // FUEL MANAGEMENT ROUTER





        // END OF FUEL MANAGEMENT ROUTER



        // TECHNICAL MANAGEMENT ROUTER




        // END OF TECHNICAL MANAGEMENT ROUTEUR 



        // ORDER MANAGEMENT ROUTER





        // END ORDER MANAGEMENT ROUTER






        // PERSONAL 

           
















    } else {    
        (new SignUp())->signUpPage();
    }

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}