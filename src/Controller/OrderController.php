<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{

    #[Route('/order/create', name: 'order_index')]
    #[IsGranted('ROLE_USER')]
    public function index(CartService $cartService): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'recapCart' => $cartService->getTotal()
        ]);
    }

    #[Route('/order/confirmation', name: 'confirmation')]
    public function confirmation(): Response
    {

        return $this->render('order/confirmation.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }


}

