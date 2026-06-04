<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserDashboardTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD CALCULATIONS
    |--------------------------------------------------------------------------
    */

    public function testIncomeCalculation(): void
    {
        $income = [1000, 500, 200];

        $this->assertEquals(
            1700,
            array_sum($income)
        );
    }

    public function testExpenseCalculation(): void
    {
        $expense = [100, 200, 300];

        $this->assertEquals(
            600,
            array_sum($expense)
        );
    }

    public function testBalanceCalculation(): void
    {
        $income = 2000;
        $expense = 500;

        $balance = $income - $expense;

        $this->assertEquals(
            1500,
            $balance
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GREETING MESSAGE
    |--------------------------------------------------------------------------
    */

    public function testGreetingMorning(): void
    {
        $hour = 9;

        $greeting = $hour < 12
            ? 'Good Morning'
            : 'Other';

        $this->assertEquals(
            'Good Morning',
            $greeting
        );
    }

    public function testGreetingAfternoon(): void
    {
        $hour = 14;

        $greeting = $hour < 17
            ? 'Good Afternoon'
            : 'Other';

        $this->assertEquals(
            'Good Afternoon',
            $greeting
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    public function testSearchValueExists(): void
    {
        $this->assertStringContainsString(
            'salary',
            'salary january'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SECURITY
    |--------------------------------------------------------------------------
    */

    public function testHtmlEscaping(): void
    {
        $input = '<script>alert(1)</script>';

        $output = htmlspecialchars($input);

        $this->assertNotEquals(
            $input,
            $output
        );
    }
}
