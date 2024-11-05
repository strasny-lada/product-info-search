<?php declare(strict_types = 1);

namespace App\StatisticsDriver;

use App\Tools\FilesystemTools;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class StatisticsDriverProviderTest extends KernelTestCase
{

    public function testFilesystemStatisticsCanBeProcessed(): void
    {
        $filesystemStatisticsFilepath = $this->getTestFilesystemStatisticsFilepath();

        $statisticsDriver = $this->getFilesystemStatisticsDriver();
        self::assertInstanceOf(FilesystemStatisticsDriver::class, $statisticsDriver);

        // increase in the product visit on the first time
        $this->assertFileDoesNotExist($filesystemStatisticsFilepath);
        $statisticsDriver->increaseProductVisitsCount('e5713290-fb8d-41af-8eed-ae1f9b61247d');
        $this->assertFileExists($filesystemStatisticsFilepath);

        $fileData = FilesystemTools::loadJsonData($filesystemStatisticsFilepath);
        $this->assertEquals(['e5713290-fb8d-41af-8eed-ae1f9b61247d' => 1], $fileData);

        // increase in the product visit on the second time
        $statisticsDriver->increaseProductVisitsCount('e5713290-fb8d-41af-8eed-ae1f9b61247d');
        $fileData = FilesystemTools::loadJsonData($filesystemStatisticsFilepath);
        $this->assertEquals(['e5713290-fb8d-41af-8eed-ae1f9b61247d' => 2], $fileData);
    }

    private function getFilesystemStatisticsDriver(): IStatisticsDriver
    {
        $filesystemStatisticsFilepath = $this->getTestFilesystemStatisticsFilepath();

        $statisticsDriverProvider = new StatisticsDriverProvider(
            StatisticsDriverType::Filesystem,
            new FilesystemStatisticsDriver($filesystemStatisticsFilepath),
        );

        return $statisticsDriverProvider->getDriver();
    }

    private function getTestFilesystemStatisticsFilepath(): string
    {
        return self::getContainer()->getParameter('statistics.filesystem.filepath');
    }

    public function setUp(): void
    {
        $filepath = $this->getTestFilesystemStatisticsFilepath();

        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

}
