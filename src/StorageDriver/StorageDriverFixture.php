<?php declare(strict_types = 1);

namespace App\StorageDriver;

final class StorageDriverFixture
{

    /**
     * @return array<string, mixed>
     */
    public static function getProduct(string $id): array
    {
        return [
            'id' => $id,
            'name' => 'Product',
        ];
    }

}