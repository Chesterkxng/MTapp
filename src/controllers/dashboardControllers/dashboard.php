<?php
namespace Application\Controllers\DashboardControllers\Dashboard;
require_once('src/lib/dashboard.php');
require_once('src/lib/database.php');
use Application\lib\Dashboard\DashboardRepository;
use Application\Lib\Database\DatabaseConnection;
class Dashboard
{
    public function DashboardPage()
    {
        $dasboardRepository = new DashboardRepository;
        $dasboardRepository->connection = new DatabaseConnection;
        $pendingMissionsNumber = $dasboardRepository->PendingMissionsNumber();
        $AvalaibleAeronefsNumber = $dasboardRepository->AvalaibleAeronefsNumber();
        $UnavalaibleAeronefsNumber = $dasboardRepository->UnavalaibleAeronefsNumber();
        $pendingBreakdownsNumber = $dasboardRepository->PendingBreakdownsNumber();
        $pendingOrdersNumber = $dasboardRepository->PendingOrdersNumber();
        // refueling 
        $refuelingsNumber = $dasboardRepository->RefuelingsNumber();
        $refuelingsTotalQuantity = $dasboardRepository->RefuelingsQuantity();
        $MonthlyrefuelingsNumber = $dasboardRepository->MonthlyRefuelingsNumber();
        $MonthlyRefuelingsQuantity = $dasboardRepository->MonthlyRefuelingsQuantity();
        $MonthlyRefueledAeronef = $dasboardRepository->MonthlyRefueledAeronef();
        // defueling
        $defuelingsNumber = $dasboardRepository->DefuelingsNumber();
        $defuelingsTotalQuantity = $dasboardRepository->DefuelingsQuantity();
        $MonthlyDefuelingsNumber = $dasboardRepository->MonthlyDefuelingsNumber();
        $MonthlyDefuelingsQuantity = $dasboardRepository->MonthlyDefuelingsQuantity();
        $MonthlyDefueledAeronef = $dasboardRepository->MonthlyDefueledAeronef();
        require('templates/dashboard/dashboard.php');
    }
}
