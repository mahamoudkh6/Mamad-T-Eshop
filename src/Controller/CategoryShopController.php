<?php

namespace App\Controller;


use App\Repository\CategoryShopRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryShopController extends AbstractController
{
    private $categoryShopRepository;

    public function __construct(CategoryShopRepository $categoryShopRepository)
    {
        $this->categoryShopRepository = $categoryShopRepository;
    }

    #[Route('/category/{categoryId}', name: 'products_by_category')]
    public function productsByCategory($categoryId): Response
    {
        // Récupérez la catégorie spécifiée par son ID
        $category = $this->categoryShopRepository->find($categoryId);

        if (!$category) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Récupérez toutes les catégories pour la navigation
        $categories = $this->categoryShopRepository->findAll();

        // Récupérez la liste des produits de cette catégorie
        $products = $category->getProducts();

        return $this->render('category_shop/productByCategory.html.twig', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products,
        ]);
    }
}