<?php
// src/Controller/EquipementController.php
namespace App\Controller;

use App\Entity\Equipement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class EquipementController extends AbstractController
{
    /**
     * @Route("/equipement/All", name="equipement_show_all")
     */
    public function showAll()
    {
        $equipements = $this->getDoctrine()
            ->getRepository(Equipement::class)
            ->findAll();

        if (!$equipements) {
            throw $this->createNotFoundException(
                'Aucun equipement en BDD'
            );
        }

        return $this->render('equipement/all.html.twig', [
            "equipements" => $equipements
        ]);

    }

    /**
     * @Route("/equipement/{nom}", name="equipement_info")
     */
    public function info(string $nom): Response
    {
        $equipement = $this->getDoctrine()
            ->getRepository(Equipement::class)
            ->findOneBy(["nom"=>$nom]);

        if (!$equipement) {
            throw $this->createNotFoundException(
                'No equipement found for : ' . $nom
            );
        }

        return $this->render('equipement/infoEquipement.html.twig',[
            'nom' => $equipement->getNom(),
             'marque' => $equipement->getMarque(),
              'prix' => $equipement->getPrix(), 
              'description' => $equipement->getDescription(),
               'quantite' => $equipement->getQuantite()
        ]);

    }


}