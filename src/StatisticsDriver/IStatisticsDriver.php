<?php declare(strict_types = 1);

namespace App\StatisticsDriver;

interface IStatisticsDriver
{

    public function increaseProductVisitsCount(string $productId): void;

}