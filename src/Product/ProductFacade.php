<?php declare(strict_types = 1);

namespace App\Product;

use App\Cache\CacheAdapterProvider;

final readonly class ProductFacade
{

    public function __construct(
        private CacheAdapterProvider $cacheAdapterProvider,
        private ProductRepository $productRepository,
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function fetchProductById(string $productId): array
    {
        $cacheAdapter = $this->cacheAdapterProvider->getAdapter();

        $productCacheHandler = sprintf(
            'Product-%s',
            $productId,
        );

        return $cacheAdapter->get($productCacheHandler, function () use ($productId) {
            return $this->productRepository->fetchProductById($productId);
        });
    }

}