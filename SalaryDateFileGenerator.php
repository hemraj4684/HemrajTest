<?php
require_once __DIR__ . '\SalaryDateCalulator.php';

echo "Please enter year (e.g. 2019) for which you want Salary and bonus dates: ";
$handle = fopen("php://stdin", "r");
$year = trim(fgets($handle));
$year = (Int)$year;
if ($year === 0) {
    echo "Please Enter Proper Year";
    exit;
}
$resultDate = [];
$sD = new SalaryDateCalulator();
$resultDate = $sD->salaryMonthAsPerYear($year);
$sD->createCSV($year, $resultDate);
fclose($handle);
