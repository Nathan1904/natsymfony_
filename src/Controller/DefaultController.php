<?php

namespace App\Controller;

use App\Form\EquipementType;
use App\Entity\Equipement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/equipement/ajout", name="equipement_ajout")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $equipement = new Equipement();

        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($equipement);
            $entityManager->flush();
        }

        return $this->render('equipement/ajoutEquipement.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
