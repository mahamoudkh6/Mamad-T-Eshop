<?php

namespace App\Controller;

use App\Repository\CategoryShopRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        CategoryShopRepository $categoryShopRepository,
        ProductRepository $productRepository
    ):Response
     {
        // Récupérez la liste des catégories depuis la base de données
        $categories = $categoryShopRepository->findAll();

        // Récupérez les 5 anciens produits depuis la base de données
      //  $oldProducts = $productRepository->findOldProducts(5);

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
           // 'oldProducts' => $oldProducts,
        ]);
    }


    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


}
