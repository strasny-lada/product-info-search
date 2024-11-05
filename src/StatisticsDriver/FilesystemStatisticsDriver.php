<?php declare(strict_types = 1);

namespace App\StatisticsDriver;

final readonly class FilesystemStatisticsDriver implements IStatisticsDriver
{

    public function increaseProductVisitsCount(string $productId): void
    {
    }

}