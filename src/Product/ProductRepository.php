<?php declare(strict_types = 1);

namespace App\Product;

use App\StorageDriver\IElasticSearchDriver;
use App\StorageDriver\IMySQLDriver;
use App\StorageDriver\StorageDriverProvider;

final readonly class ProductRepository
{

    public function __construct(
        private StorageDriverProvider $storageDriverProvider
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function fetchProductById(string $id): array
    {
        $storageDriver = $this->storageDriverProvider->getStorageDriver();

        if ($storageDriver instanceof IElasticSearchDriver) {
            return $storageDriver->findById($id);
        }

        if ($storageDriver instanceof IMySQLDriver) {
            return $storageDriver->findProduct($id);
        }

        throw new \Exception(sprintf(
            'Storage driver "%s" not implemented',
            $storageDriver::class,
        ));
    }

}