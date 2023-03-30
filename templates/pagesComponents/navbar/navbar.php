 <?php
    use Application\Lib\Database\DatabaseConnection;
    use Application\Model\Personal\PersonalRepository;
    if (isset($_SESSION['LOGIN_ID'])) {
        $personalRepository = new PersonalRepository();
        $personalRepository->connection = new DatabaseConnection();
        $login_id = $_SESSION['LOGIN_ID'];
        $profile = $personalRepository->getProfile($login_id);
    }
    ?>
 <!--Page loader-->
 <div class="loader-wrapper">
     <div class="loader-circle">
         <div class="loader-wave"></div>
     </div>
 </div>
 <!--Page loader-->
 <!--Page Wrapper-->
 <div class="container-fluid">
     <!--Header-->
     <div class="row header shadow-sm">
         <!--Logo-->
         <div class="col-sm-3 pl-0 text-center header-logo">
             <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                 <h3 class="logo"><a href="#" class="text-secondary logo"><i class="fa fa-cogs"></i> MT<span class="small">APP</span></a></h3>
             </div>
         </div>
         <!--Logo-->
         <!--Header Menu-->
         <div class="col-sm-9 header-menu pt-2 pb-0">
             <div class="row">
                 <!--Menu Icons-->
                 <div class="col-sm-4 col-8 pl-0">
                     <!--Toggle sidebar-->
                     <span class="menu-icon" onclick="toggle_sidebar()">
                         <span id="sidebar-toggle-btn"></span>
                     </span>
                     <!--Toggle sidebar-->
                 </div>
                 <!--Search box and avatar-->
                 <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                     <div class="mr-4">
                         <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <img src="templates\pagesComponents\navbar\assets\img\avatar.jpg" alt="Adam" class="rounded-circle" width="40px" height="40px">
                         </a>
                         <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                             <a class="dropdown-item" href="index.php?action=updateProfilePage&login_id=<?= $login_id ?>"><i class="fa fa-user pr-2"></i> Profile</a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="index.php?action=signOut"><i class="fa fa-power-off pr-2"></i> Logout</a>
                         </div>
                     </div>
                 </div>
                 <!--Search box and avatar-->
             </div>
         </div>
         <!--Header Menu-->
     </div>
     <!--Header-->
     <!--Main Content-->
     <div class="row main-content">
         <!--Sidebar left-->
         <div class="col-sm-3 col-xs-6 sidebar pl-0">
             <div class="inner-sidebar mr-3">
                 <!--Image Avatar-->
                 <div class="avatar text-center">
                     <img src="templates\pagesComponents\navbar\assets\img\welcome2.png" alt="" class="rounded" />
                     <p><strong><?= $profile->surname ?> <?= $profile->first_name ?></strong></p>
                     <span class="text-primary small"><strong><?= $profile->function ?></strong></span>
                 </div>
                 <!--Image Avatar-->
                 <!--Sidebar Navigation Menu-->
                 <div class="sidebar-menu-container">
                     <ul class="sidebar-menu mt-4 mb-4">
                         <li class="parent">
                             <a href="index.php?action=DashboardPage" class=""><i class="fa fa-dashboard mr-3"></i>
                                 <span class="none">DASHBOARD </span>
                             </a>
                         </li>
                         <li class="parent">
                             <a href="index.php?action=missionList" class=""><i class="fa fa-plane mr-3"> </i>
                                 <span class="none">MISSIONS MANAGEMENT </span>
                             </a>
                         </li>
                         <li class="parent">
                             <a href="#" onclick="toggle_menu('fuel'); return false" class=""><i class="fa fa-tint mr-3"></i>
                                 <span class="none">FUEL MANAGEMENT <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                             </a>
                             <ul class="children" id="fuel">
                                 <li class="child"><a href="index.php?action=refuelingsList" class="ml-4"><i class="fa fa-angle-right mr-2"></i> REFUELING</a></li>
                                 <li class="child"><a href="index.php?action=defuelingsList" class="ml-4"><i class="fa fa-angle-right mr-2"></i> DEFUELING</a></li>
                             </ul>
                             </a>
                         </li>
                         <li class="parent">
                             <a href="#" onclick="toggle_menu('technical'); return false" class=""><i class="fa fa-cog mr-3"></i>
                                 <span class="none">TECHNICAL MANAGEMENT <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                             </a>
                             <ul class="children" id="technical">
                                 <li class="child"><a href="index.php?action=aeronefsList" class="ml-4"><i class="fa fa-angle-right mr-2"></i> AERONEFS</a></li>
                                 <li class="child"><a href="index.php?action=breakdownList" class="ml-4"><i class="fa fa-angle-right mr-2"></i> BREAKDOWNS</a></li>
                             </ul>
                         </li>
                         <li class="parent">
                             <a href="index.php?action=ordersList" class=""><i class="fa fa-shopping-basket mr-3"></i>
                                 <span class="none">ORDER MANAGEMENT</span>
                             </a>
                         </li>
                         <li class="parent">
                             <a href="index.php?action=personnelList" class=""><i class="fa fa-group mr-3"></i>
                                 <span class="none">PERSONNEL </span>
                             </a>
                         </li>
                         <li class="parent">
                             <a href="index.php?action=filtersPage" class=""><i class="fa fa-file-pdf mr-3"></i>
                                 <span class="none">REPORT GENERATOR </span>
                             </a>
                         </li>
                     </ul>
                 </div>
                 <!--Sidebar Naigation Menu-->
             </div>
         </div>
         <!--Sidebar left-->
         <!--Dashboard widget-->
         <!--/Dashboard widget-->