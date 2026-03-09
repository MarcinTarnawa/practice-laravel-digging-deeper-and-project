<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExpensesTest extends TestCase
{
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_it_calculates_percentage_difference_correctly()
    {
        $total = 150;
        $average = 100;

        $diff = ($average != 0) 
            ? round((($total - $average) / abs($average)) * 100, 2) 
            : 0;

        $this->assertEquals(50, $diff);
    }

    public function test_it_assigns_green_color_when_above_average()
    {
        $total = 2000;
        $yearlyAverage = 1500;
        $color = $total > $yearlyAverage ? 'green' : 'red';

        $this->assertEquals('green', $color);
    }

}
