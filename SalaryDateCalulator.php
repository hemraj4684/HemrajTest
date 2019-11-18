<?php
/**
 * Hemraj Solanki Test
 */

Class SalaryDateCalulator
{
    /**
     * @param int $year
     * @return array
     * @throws Exception
     */
    public function salaryMonthAsPerYear(int $year)
    {
        $resultDate = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthDate = new DateTime("$year-$month-1");
            $resultDate[$month]['month'] = $monthDate->format('F');
            $resultDate[$month]['baseSalaryDate'] = $this->calculateBaseSalaryDate($monthDate);
            $resultDate[$month]['bonusDate'] = $this->calculateBonusDate($monthDate);
        }

        return $resultDate;
    }

    /**
     * @param DateTime $monthDate
     * @return string
     */
    public function calculateBaseSalaryDate(DateTime $monthDate)
    {
        $monthDate->modify('last day of this month');
        if (in_array($monthDate->format('D'), ['Sat', 'Sun'])) {
            $monthDate->modify('last friday');
        }
        return $monthDate->format('d-m-Y');
    }

    /**
     * @param DateTime $monthDate
     * @return string
     */
    public function calculateBonusDate(DateTime $monthDate)
    {
        $monthDate->modify('first day of this month');
        $monthDate->modify('+14 days');
        if (in_array($monthDate->format('D'), ['Sat', 'Sun'])) {
            $monthDate->modify('next wednesday');
        }
        return $monthDate->format('d-m-Y');
    }

    /**
     * @param int $year
     * @param array $resultDate
     */
    public function createCSV(int $year, array $resultDate)
    {
        try {
            $filePath = "$year.csv";
            if (!file_exists($filePath)) {
                $file = fopen($filePath, 'w');
                $header = array("Month", "Base Salary Date", "Bonus Date");
                fputcsv($file, $header);
                foreach ($resultDate as $eachRow) {
                    fputcsv($file, $eachRow);
                }
                fclose($file);
                echo "$year.csv File created successfully!";
            } else {
                echo "$year.csv File already Exists!";
            }
        } catch (Exception $e) {
            echo "Error Message:" . $e->getMessage();
        }
    }
}