<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entrepries = $doctrine->getRepository(Entreprise::class)->findAll();
        $arr = ["val1", "val2"];
        return $this->render('entreprise/index.html.twig', [
            "entreprises" => $entrepries
        ]);
    }
    #[Route('/entreprise/{id}', name: 'show_entreprise')]
    public function showEntreprise(ManagerRegistry $doctrine): Response
    {
        $entreprise = "";
        return $this->render('entreprise/show.html.twig', [
            "entreprise" => $entreprise
        ]);
    }
    #[Route('/entreprise/{id}', name: 'show_entreprise')]
    public function show(Entreprise $entreprise): Response
    {
       
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise
        ]);
        
    }
}
