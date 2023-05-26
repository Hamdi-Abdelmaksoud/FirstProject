<?php

namespace App\Controller;

use App\Entity\Employe;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EmployeController extends AbstractController
{
    #[Route('/employe/{id}', name: 'show_employe')]
    public function show(Employe $employe): Response
    {
        // $employe = $doctrine->getRepository(Employe::class)->findOneBy(["id"=>$id]);

        return $this->render('employe/show.html.twig', [
            'employe' => $employe
        ]);
        
    }
    #[Route('/employe', name: 'app_employe')]
    /*public function index(ManagerRegistry $doctrine): Response
    {
        $employes=$doctrine->getRepository(Employe::class)->findAll();
        return $this->render('employe/index.html.twig', [
            'employes' => $employes
        ]);
    }*/
    public function index(ManagerRegistry $doctrine): Response
    {
        $employes = $doctrine->getRepository(Employe::class)->findBy(["ville" => "Strasbourg"], ['nom' => "ASC"]);
        return $this->render('employe/index.html.twig', [
            'employes' => $employes
        ]);
    } 
}
