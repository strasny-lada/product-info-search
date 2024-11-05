<?php declare(strict_types = 1);

namespace App\Tools;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FilesystemToolsTest extends KernelTestCase
{

    public function testJsonDataCanBeStoredAndLoaded(): void
    {
        $jsonFilepath = $this->getTestJsonFilepath();

        $data = [
            'id' => 7,
            'name' => 'test',
        ];

        $this->assertFileDoesNotExist($jsonFilepath);
        FilesystemTools::storeDataIntoJson($jsonFilepath, $data);
        $this->assertFileExists($jsonFilepath);

        $fileData = FilesystemTools::loadJsonData($jsonFilepath);
        $this->assertEquals($data, $fileData);
    }

    public function testLoadCanReturnEmptyArrayIfFileDoesNotExist(): void
    {
        $jsonFilepath = $this->getTestJsonFilepath();
        $this->assertFileDoesNotExist($jsonFilepath);

        $fileData = FilesystemTools::loadJsonData($jsonFilepath);
        $this->assertEquals([], $fileData);
    }

    public function setUp(): void
    {
        $filepath = $this->getTestJsonFilepath();

        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

    private function getTestJsonFilepath(): string
    {
        return self::getContainer()->getParameter('kernel.cache_dir') . '/test.json';
    }

}
