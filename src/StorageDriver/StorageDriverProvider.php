<?php declare(strict_types = 1);

namespace App\StorageDriver;

final readonly class StorageDriverProvider
{

    public function __construct(
        private bool $elasticSearchStorageEnabled,
    )
    {
    }

    public function getStorageDriver(): IElasticSearchDriver | IMySQLDriver
    {
        if ($this->elasticSearchStorageEnabled === false) {
            return new class implements IMySQLDriver {
                /**
                 * @return array<string, mixed>
                 */
                public function findProduct(string $id): array {
                    return StorageDriverFixture::getProduct($id);
                }
            };
        }

        return new class implements IElasticSearchDriver {
            /**
             * @return array<string, mixed>
             */
            public function findById(string $id): array {
                return StorageDriverFixture::getProduct($id);
            }
        };
    }

}
