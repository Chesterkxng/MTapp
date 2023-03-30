<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();


// LOGIN CONTROLLERS IMPORT 
require_once('src/controllers/loginControllers/SignUp.php');
require_once('src/controllers/loginControllers/profile.php');
require_once('src/controllers/loginControllers/signIn.php');
require_once('src/controllers/loginControllers/forgottenPassword.php');
require_once('src/controllers/loginControllers/securityQA.php');
require_once('src/controllers/loginControllers/signOut.php');

//DASHBOARD CONTROLLERS IMPORT 
require_once('src/controllers/dashboardControllers/dashboard.php');


// AERONEF CONTROLLERS IMPORT
require_once('src/controllers/aeronefControllers/aeronef.php');

// PERSONAL CONTROLLERS IMPORT 
require_once('src/controllers/personalControllers/personal.php');

// BREAKDOWN CONTROLLERS IMPORT 
require_once('src/controllers/breakdownControllers/breakdown.php');

// MISSION CONTROLLERS IMPORT 
require_once('src/controllers/missionControllers/mission.php');

// ORDER CONTROLLERS IMPORT
require_once('src/controllers/orderControllers/order.php');

// FUEL CONTROLLERS IMPORT 
require_once('src/controllers/refuelingControllers/refueling.php');
require_once('src/controllers/defuelingControllers/defueling.php');

// REPORT CONTROLLERS IMPORT 
require_once('src/controllers/filterControllers/filter.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Personal\PersonalRepository;
use Application\Model\Mission\MissionRepository;

use Application\Controllers\LoginControllers\SignUp\SignUp;
use Application\Controllers\LoginControllers\Profile\Profile;
use Application\Controllers\LoginControllers\SignIn\SignIn;
use Application\Controllers\LoginControllers\forgottenPassword\forgottenPassword;
use Application\Controllers\LoginControllers\SecurityQA\SecurityQA;
use Application\Controllers\LoginControllers\SignOut\SignOut;

use Application\Controllers\DashboardControllers\Dashboard\Dashboard;
use Application\Controllers\AeronefControllers\Aeronef\Aeronef;
use Application\Controllers\PersonalControllers\Personal\Personal;
use Application\Controllers\BreakdownControllers\Breakdown\Breakdown;
use Application\Controllers\MissionControllers\Mission\Mission;

use Application\Controllers\OrderControllers\Order\Order;
use Application\Controllers\RefuelingControllers\Refueling\Refueling;
use Application\Controllers\DefuelingControllers\Defueling\Defueling;
use Application\Controllers\FilterControllers\Filter\Filter;
use Application\Model\Order\OrderRepository;

//use Application\Controllers\AeronefControllers\Aeronef\Aeronef;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {


        // LOGIN ROUTER

        // SIGN UP ROUTER

        // when the form for creating a new account is filled and the submit button is clicked 
        if ($_GET['action'] === 'signUp') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new SignUp())->signUp($input);
            }

            // after the popup the user is redirected to the profile informations completion's page  
            // Or when a registered account doesn't have the profile's informations filled    
        } elseif ($_GET['action'] === 'signUpProfilePage') {
            $personalRepository = new PersonalRepository();
            $personalRepository->connection = new DatabaseConnection();


            if (isset($_SESSION['LOGIN_ID'])) {
                $login_id = $_SESSION['LOGIN_ID'];
                $isProfileFilled = $personalRepository->isProfileFilled($login_id);
                if ($isProfileFilled == 0) {
                    (new Profile())->signUpProfilePage();
                }
            }


            // once the profile informations Form is filled and the 'complete your profile' button is clicked 
        } elseif ($_GET['action'] === 'profileCompletion') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new Profile())->profileCompletion($input);
            }

            // when the 'signIn button is clicked from the sign Up page 
        } elseif ($_GET['action'] === 'signInPage') {
            (new SignIn())->signInPage();
        }

        // END OF SIGN UP ROUTER

        // SIGN IN ROUTER

        //sign In controller
        if ($_GET['action'] === 'signIn') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new SignIn())->connect($input);
            }

            // when the forgotten password link is cliked
        } elseif ($_GET['action'] === 'forgottenPasswordPage') {

            (new forgottenPassword())->forgottenPasswordPage();

            // when the informations are filled in the form and the password reset's button is pressed 
        } elseif ($_GET['action'] === 'redirectQA') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new forgottenPassword())->redirectQA($input);
            }
            // if the informations filled are correct the popup will directly redirect to the security QA verification
        } elseif ($_GET['action'] === 'securityQAPage') {
            (new SecurityQA())->SecurityQAPage();

            // when the security answer is set
        } elseif ($_GET['action'] === 'verifyQA') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                (new SecurityQA())->VerifiyQA($input);
            }
        } elseif ($_GET['action'] === 'signUpPage') {

            (new SignUp())->signUpPage();
        }
        // END OF SIGN IN ROUTEUR 

        // SIGN OUT ROUTER 
        if ($_GET['action'] === 'signOut') {
            (new SignOut())->signOut();
        }





        // END OF SIGN OUT ROUTER



        // END OF LOGIN ROUTER


        // DASHBOARD ROUTER 

        //load the dasboardPage
        if ($_GET['action'] === 'DashboardPage') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Dashboard())->DashboardPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
        }

        // END OF DASHBOARD ROUTEUR 



        // MISSION MANAGEMENT ROUTER
        // redirect to the missions List
        if ($_GET['action'] === 'missionList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Mission())->missionList();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // once the adding button is clicked the user is redirected on the adding form
        } elseif ($_GET['action'] === 'MissionAddingForm') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Mission())->addingFormPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // add the new mission based on the informations filled in the form
        } elseif ($_GET['action'] === 'addMission') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Mission())->addMission($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }

            //load the update form for a selected mission 
        } elseif ($_GET['action'] === 'updateMissionForm') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mission_id = $_GET['mission_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Mission())->updateFormPage($mission_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }

            // update the selected mission with informations filled 
        } elseif ($_GET['action'] === 'updateMission') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mission_id = $_GET['mission_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Mission())->updateMission($mission_id, $input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // delete mission Popup  
        } elseif ($_GET['action'] === 'deleteMissionPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mission_id = $_GET['mission_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Mission())->sendDeletePopup($mission_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // delete mission  
        } elseif ($_GET['action'] === 'deleteMission') {
            $mission_id = $_GET['mission_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Mission())->setMissionInactive($mission_id);
                }
            } else {
                (new SignIn())->signInPage();
            }
            // delete mission Popup  
        }





        // END OF MISSION MANAGEMENT ROUTER



        // FUEL MANAGEMENT ROUTER

        // REFUELING ROUTER 

        // load the refueling List 
        if ($_GET['action'] === 'refuelingsList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Refueling())->refuelingList();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // load the adding form 
        } elseif ($_GET['action'] === 'RefuelingAddingForm') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Refueling())->addingFormPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // add a new refueling based on the informations filled 
        } elseif ($_GET['action'] === 'addRefueling') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Refueling())->addRefueling($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // load the update form 
        } elseif ($_GET['action'] === 'updateRefuelingForm') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $refueling_id = $_GET['refueling_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Refueling())->updateRefuelingForm($refueling_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // update refueling based on informations filled     
        } elseif ($_GET['action'] === 'updateRefueling') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $refueling_id = $_GET['refueling_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Refueling())->updateRefueling($input, $refueling_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // send the popup 
        } elseif ($_GET['action'] === 'deleteRefuelingPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $refueling_id = $_GET['refueling_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Refueling())->sendDeletePopup($refueling_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // delete Refueling 
        } elseif ($_GET['action'] === 'deleteRefueling') {
            $refueling_id = $_GET['refueling_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Refueling())->setRefuelingInactive($refueling_id);
                }
            } else {
                (new SignIn())->signInPage();
            }
        }
        //  END REFUELING ROUTER

        // DEFUELING ROUTER
        // load the refueling List 
        if ($_GET['action'] === 'defuelingsList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Defueling())->defuelingList();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // load the adding form 
        } elseif ($_GET['action'] === 'DefuelingAddingForm') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Defueling())->addingFormPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // add a new refueling based on the informations filled 
        } elseif ($_GET['action'] === 'addDefueling') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Defueling())->addDefueling($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // load the update form 
        } elseif ($_GET['action'] === 'updateDefuelingForm') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $defueling_id = $_GET['defueling_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Defueling())->updateDefuelingForm($defueling_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // update refueling based on informations filled     
        } elseif ($_GET['action'] === 'updateDefueling') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $defueling_id = $_GET['defueling_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Defueling())->updateDefueling($input, $defueling_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // send the popup 
        } elseif ($_GET['action'] === 'deleteDefuelingPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $defueling_id = $_GET['defueling_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Defueling())->sendDeletePopup($defueling_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // delete Refueling 
        } elseif ($_GET['action'] === 'deleteDefueling') {
            $defueling_id = $_GET['defueling_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Defueling())->setDefuelingInactive($defueling_id);
                }
            } else {
                (new SignIn())->signInPage();
            }
        }






        // END OF FUEL MANAGEMENT ROUTER



        // TECHNICAL MANAGEMENT ROUTER


        // AERONEF ROUTER

        // get the non deleted aeronef List
        if ($_GET['action'] === 'aeronefsList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Aeronef())->getActiveAeronefs();
                }
            } else {
                (new SignIn())->signInPage();
            }
            //load the Aeronef Adding Form
        } elseif ($_GET['action'] === 'addingAeronefPage') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Aeronef())->addingFormPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // Add the aeronef in the db based on the filled Form
        } elseif ($_GET['action'] === 'addNewAeronef') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Aeronef())->addNewAeronef($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }

            // delete aeronef Popup
        } elseif ($_GET['action'] === 'deleteAeronefPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $aeroned_id = $_GET['aeronef_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Aeronef())->sendDeletePopup($aeroned_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            //  delete aeronef    
        } elseif ($_GET['action'] === 'deleteAeronef') {
            $aeroned_id = $_GET['aeronef_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Aeronef())->setAeronefInactive($aeroned_id);
                }
            } else {
                (new SignIn())->signInPage();
            }

            //  LOAD UPDATE AERONEF PAGE   
        } elseif ($_GET['action'] === 'updateAeronefPage') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $aeroned_id = $_GET['aeronef_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Aeronef())->updateAeronefPage($aeroned_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }

            // UPDATE THE AERONEF INFORMATIONS
        } elseif ($_GET['action'] === 'updateAeronefInfo') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $aeroned_id = $_GET['aeronef_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Aeronef())->updateAeronef($aeroned_id, $input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
        }
        // END OF AERONEF ROUTER

        // BREAKDOWN ROUTER 
        if ($_GET['action'] === 'breakdownList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Breakdown())->breakdownList();
                }
            } else {
                (new SignIn())->signInPage();
            }
            //load the Aeronef Adding Form
        } elseif ($_GET['action'] === 'breakdownAddingForm') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Breakdown())->addingFormPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // add the breakdown based on the informations filled
        } elseif ($_GET['action'] === 'addBreakdown') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Breakdown())->addBreakdown($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // load the  Breakdown update FORM
        } elseif ($_GET['action'] === 'updateBreakdownForm') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $breakdown_id = $_GET['breakdown_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Breakdown())->updateBreakdownPage($breakdown_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // update the breakdown based on the informations filled in the FORM
        } elseif ($_GET['action'] === 'updateBreakdown') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $breakdown_id = $_GET['breakdown_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Breakdown())->updateBreakdown($breakdown_id, $input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // send the delete popup when the delete button is pressed 
        } elseif ($_GET['action'] === 'deleteBreakdownPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $breakdown_id = $_GET['breakdown_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Breakdown())->sendDeletePopup($breakdown_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            //  delete apparently the breakdown when the confirmation button okay  is pressed 
        } elseif ($_GET['action'] === 'deleteBreakdown') {

            $breakdown_id = $_GET['breakdown_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Breakdown())->setBreakdownInactive($breakdown_id);
                }
            } else {
                (new SignIn())->signInPage();
            }

            //  delete apparently the breakdown when the confirmation button okay  is pressed 
        }

        // END OF TECHNICAL MANAGEMENT ROUTEUR 



        // ORDER MANAGEMENT ROUTER
        // get the orders list registered in db
        if ($_GET['action'] === 'ordersList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Order())->orderList();
                }
            } else {
                (new SignIn())->signInPage();
            }
            //  load the adding form 
        }
        if ($_GET['action'] === 'orderAddingForm') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Order())->addingFormPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // add the order based on the informations filled in the form  
        } elseif ($_GET['action'] === 'addOrder') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Order())->addOrder($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // load the update Form    
        } elseif ($_GET['action'] === 'updateOrderForm') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $order_id = $_GET['order_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Order())->updateFormPage($order_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // update the order based on informations filled
        } elseif ($_GET['action'] === 'updateOrder') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $order_id = $_GET['order_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Order())->updateOrder($input, $order_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // send the  confirmation Popup 
        } elseif ($_GET['action'] === 'deleteOrderPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $order_id = $_GET['order_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Order())->sendDeletePopup($order_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            //  delete apparently the Order when the confirmation button okay  is pressed 
        } elseif ($_GET['action'] === 'deleteOrder') {

            $order_id = $_GET['order_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Order())->setOrderInactive($order_id);
                }
            } else {
                (new SignIn())->signInPage();
            }
        }





        // END ORDER MANAGEMENT ROUTER






        // PERSONAL 
        // get the Personel list registered in db
        if ($_GET['action'] === 'personnelList') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Personal())->getPersonelList();
                }
            } else {
                (new SignIn())->signInPage();
            }
            // load the update Form of a selected Personal    
        } elseif ($_GET['action'] === 'updatePersonalPage') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $personal_id = $_GET['personal_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Personal())->updatePersonalForm($personal_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // update the Personal infos based on the filled informations
        } elseif ($_GET['action'] === 'updatePersonalInfos') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $personal_id = $_GET['personal_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Personal())->updatePersonal($personal_id, $input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            //  load the connected profile update page   
        } elseif ($_GET['action'] === 'updateProfilePage') {

            $login_id = $_GET['login_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Personal())->updateCurrentProfilPage($login_id);
                }
            } else {
                (new SignIn())->signInPage();
            }
            // update the connected profile based on informations filled 
        } elseif ($_GET['action'] === 'updateProfileInfos') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $login_id = $_GET['login_id'];
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Personal())->updateProfile($login_id, $input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // load the personal addingForm   
        } elseif ($_GET['action'] === 'addingPersonalPage') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Personal())->addingPersonalPage();
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // add Personnel based on the filled informations
        } elseif ($_GET['action'] === 'addPersonal') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Personal())->addPersonal($input);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // send the popup when trying to delete someOne
        } elseif ($_GET['action'] === 'deletePersonalPopup') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $personal_id = $_GET['personal_id'];
                if (isset($_SESSION['ISAUTH'])) {
                    $isAuth = $_SESSION['ISAUTH'];
                    if ($isAuth == 1) {
                        (new Personal())->sendDeletePopup($personal_id);
                    }
                } else {
                    (new SignIn())->signInPage();
                }
            }
            // when the confirm button is pressed 
        } elseif ($_GET['action'] === 'deletePersonal') {
            $personal_id = $_GET['personal_id'];
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Personal())->setPersonalInactive($personal_id);
                }
            } else {
                (new SignIn())->signInPage();
            }
        }

        // REPORT
        // load the report filters page

        if ($_GET['action'] === 'filtersPage') {
            if (isset($_SESSION['ISAUTH'])) {
                $isAuth = $_SESSION['ISAUTH'];
                if ($isAuth == 1) {
                    (new Filter())->filterPage();
                }
            } else {
                (new SignIn())->signInPage();
            }
        }
    } else {
        (new SignUp())->signUpPage();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
