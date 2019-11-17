<?php
require_once __DIR__ . '\SalaryDateCalulator.php';

use PHPUnit\Framework\TestCase;

class SalaryTest extends TestCase
{
    protected $hs;

    protected function setUp(): void
    {
        $this->hs = new SalaryDateCalulator();
    }


    public function testCalculateBaseSalaryDate()
    {
        $actualMonthDate = new DateTime('2019-01-01');
        $expectedMonthDate = '31-01-2019';
        $this->assertEquals($expectedMonthDate, $this->hs->calculateBaseSalaryDate($actualMonthDate));
    }

    public function testCalculateBonusDate()
    {
        $actualMonthDate = new DateTime('2019-12-01');
        $expectedMonthDate = '18-12-2019';
        $this->assertEquals($expectedMonthDate, $this->hs->calculateBonusDate($actualMonthDate));
    }

}
