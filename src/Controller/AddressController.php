<?php

namespace App\Controller;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class AddressController extends AbstractController
{
    #[Route('address/add', name: 'add_address')]
    #[Security("is_granted('ROLE_USER')")]
    public function addAddress(Request $request, ManagerRegistry $doctrine): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setUser($this->getUser());
            $em = $doctrine->getManager();
            $em->persist($address);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('address/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
