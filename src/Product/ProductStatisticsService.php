<?php declare(strict_types = 1);

namespace App\Product;

use App\StatisticsDriver\StatisticsDriverProvider;

final readonly class ProductStatisticsService
{

    public function __construct(
        private StatisticsDriverProvider $statisticsDriverProvider,
    )
    {
    }

    public function increaseProductVisitsCount(string $productId): void
    {
        $statisticsDriver = $this->statisticsDriverProvider->getDriver();

        $statisticsDriver->increaseProductVisitsCount($productId);
    }

}