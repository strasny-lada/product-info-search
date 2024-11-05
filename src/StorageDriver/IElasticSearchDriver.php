<?php declare(strict_types = 1);

namespace App\StorageDriver;

interface IElasticSearchDriver
{

    /**
     * @return array<string, mixed>
     */
    public function findById(string $id): array;

}