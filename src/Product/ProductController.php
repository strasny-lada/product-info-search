<?php declare(strict_types = 1);

namespace App\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('product', name: 'product_')]
final class ProductController extends AbstractController
{

    #[Route('/{id}', name: 'detail', methods: ['GET'])]
    public function detail(
        string $id,
        ProductStatisticsService $productStatisticsService,
        ProductFacade $productFacade,
    ): JsonResponse
    {
        $product = $productFacade->fetchProductById($id);

        $productStatisticsService->increaseProductVisitsCount($product['id']);

        return new JsonResponse($product);
    }

}