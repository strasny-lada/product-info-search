<?php declare(strict_types = 1);

namespace App\Cache;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\CacheInterface;

final readonly class CacheAdapterProvider
{

    public function __construct(
        private CacheAdapterType $cacheAdapterType,
    )
    {
    }

    public function getAdapter(): CacheInterface
    {
        return match ($this->cacheAdapterType) {
            CacheAdapterType::Filesystem => new FilesystemAdapter(),
            default => throw new \Exception(sprintf(
                'Cache adapter "%s" not implemented',
                $this->cacheAdapterType->name,
            )),
        };
    }

}