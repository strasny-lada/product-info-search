<?php declare(strict_types = 1);

namespace App\StatisticsDriver;

final readonly class StatisticsDriverProvider
{

    public function __construct(
        private StatisticsDriverType $statisticsDriverType,
        private FilesystemStatisticsDriver $filesystemStatisticsDriver,
    )
    {
    }

    public function getDriver(): iStatisticsDriver
    {
        return match ($this->statisticsDriverType) {
            StatisticsDriverType::Filesystem => $this->filesystemStatisticsDriver,
            default => throw new \Exception(sprintf(
                'Statistics driver "%s" not implemented',
                $this->statisticsDriverType->name,
            )),
        };
    }

}