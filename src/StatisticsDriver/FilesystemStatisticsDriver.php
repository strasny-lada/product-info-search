<?php declare(strict_types = 1);

namespace App\StatisticsDriver;

use App\Tools\FilesystemTools;

final readonly class FilesystemStatisticsDriver implements IStatisticsDriver
{

    public function __construct(
        private string $filesystemStatisticsFilepath,
    )
    {
    }

    public function increaseProductVisitsCount(string $productId): void
    {
        $statisticsData = FilesystemTools::loadJsonData($this->filesystemStatisticsFilepath);

        $productStatistics = $statisticsData[$productId] ?? null;
        if ($productStatistics === null) {
            $statisticsData[$productId] = 0;
        }

        $statisticsData[$productId]++;

        FilesystemTools::storeDataIntoJson(
            $this->filesystemStatisticsFilepath,
            $statisticsData,
        );
    }

}