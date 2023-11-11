<?php

namespace App\Tests\Unit;

use App\Entity\Product;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServiceTest extends TestCase
{
    public function testAjouterAuPanier()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $session = $this->createMock(SessionInterface::class);

        $requestStack->method('getSession')->willReturn($session);

        $cartService = new CartService($requestStack, $entityManager);

        $idProduit = 1;
   // Ajout d'un produit au panier
   $cartService->addToCart($idProduit);

   // Récupération du contenu du panier
   $contenuPanier = $cartService->getTotal();

   // Vérification que le panier contient le produit ajouté avec une quantité de 1
   $this->assertCount(1, $contenuPanier);
   $this->assertEquals($idProduit, $contenuPanier[0]['product']->getId());
   $this->assertEquals(1, $contenuPanier[0]['quantity']);
}

    public function testRetirerDuPanier()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $session = $this->createMock(SessionInterface::class);

        $requestStack->method('getSession')->willReturn($session);

        $cartService = new CartService($requestStack, $entityManager);

        $idProduit = 1;

        // Ajout d'un produit au panier
        $cartService->addToCart($idProduit);

        // Retrait du produit du panier
        $cartService->removeToCart($idProduit);

        // Récupération du contenu du panier
        $contenuPanier = $cartService->getTotal();

        // Vérification que le panier est vide après le retrait du produit
        $this->assertEquals(0, count($contenuPanier));
    }

    public function testDiminuerQuantite()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $session = $this->createMock(SessionInterface::class);

        $requestStack->method('getSession')->willReturn($session);

        $cartService = new CartService($requestStack, $entityManager);

        $idProduit = 1;

        // Ajout d'un produit au panier
        $cartService->addToCart($idProduit);

        // Diminution de la quantité du produit dans le panier
        $cartService->decrease($idProduit);

        // Récupération du contenu du panier
        $contenuPanier = $cartService->getTotal();

        // Vérification que le panier est vide après la diminution de la quantité du produit
        $this->assertEquals(0, count($contenuPanier));
    }

    public function testViderPanier()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $session = $this->createMock(SessionInterface::class);

        $requestStack->method('getSession')->willReturn($session);

        $cartService = new CartService($requestStack, $entityManager);

        $idProduit = 1;

        // Ajout d'un produit au panier
        $cartService->addToCart($idProduit);

        // Suppression de tous les produits du panier
        $cartService->removeCartAll();

        // Récupération du contenu du panier
        $contenuPanier = $cartService->getTotal();

        // Vérification que le panier est vide après la suppression de tous les produits
        $this->assertEquals(0, count($contenuPanier));
    }

    public function testGetTotal()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $session = $this->createMock(SessionInterface::class);

        $requestStack->method('getSession')->willReturn($session);

        $cartService = new CartService($requestStack, $entityManager);

        $produit1 = $this->createMock(Product::class);
        $produit1->method('getId')->willReturn(1);

        $produit2 = $this->createMock(Product::class);
        $produit2->method('getId')->willReturn(2);

        // Ajout de produits au panier
        $cartService->addToCart(1);
        $cartService->addToCart(2);

        // Récupération du contenu du panier
        $contenuPanier = $cartService->getTotal();

        // Vérification que le panier contient les produits ajoutés
        $this->assertEquals(2, count($contenuPanier));
        $this->assertEquals(1, $contenuPanier[0]['product']->getId());
        $this->assertEquals(2, $contenuPanier[1]['product']->getId());
    }
}
