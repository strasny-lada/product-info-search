<?php declare(strict_types = 1);

namespace App\Cache;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

final class CacheAdapterProviderTest extends TestCase
{

    public function testGetAdapter()
    {
        $cacheAdapterProvider = new CacheAdapterProvider(
            CacheAdapterType::Filesystem,
        );

        $cacheAdapter = $cacheAdapterProvider->getAdapter();

        $this->assertInstanceOf(FilesystemAdapter::class, $cacheAdapter);
    }

}
