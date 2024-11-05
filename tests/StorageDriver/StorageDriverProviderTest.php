<?php declare(strict_types = 1);

namespace App\StorageDriver;

use PHPUnit\Framework\TestCase;

final class StorageDriverProviderTest extends TestCase
{

    public function testElasticSearchStorageDriver(): void
    {
        $storageDriverProvider = new StorageDriverProvider(true);

        /** @var IElasticSearchDriver $storageDriver */
        $storageDriver = $storageDriverProvider->getStorageDriver();
        self::assertInstanceOf(IElasticSearchDriver::class, $storageDriver);

        $product = $storageDriver->findById('e5713290-fb8d-41af-8eed-ae1f9b61247d');
        self::assertSame('e5713290-fb8d-41af-8eed-ae1f9b61247d', $product['id']);
        self::assertSame('Product', $product['name']);
    }

    public function testMysqlStorageDriver(): void
    {
        $storageDriverProvider = new StorageDriverProvider(false);

        /** @var IMySQLDriver $storageDriver */
        $storageDriver = $storageDriverProvider->getStorageDriver();
        self::assertInstanceOf(IMySQLDriver::class, $storageDriver);

        $product = $storageDriver->findProduct('e5713290-fb8d-41af-8eed-ae1f9b61247d');
        self::assertSame('e5713290-fb8d-41af-8eed-ae1f9b61247d', $product['id']);
        self::assertSame('Product', $product['name']);
    }

}
