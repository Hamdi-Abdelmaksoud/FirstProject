<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entreprises = $doctrine->getRepository(Entreprise::class)->findAll();
        $arr = ["val1", "val2"];
        return $this->render('entreprise/index.html.twig', [
            "entreprises" => $entreprises
        ]);
    }
  
    #[Route('/entreprise/add', name: 'add_entreprise')]  
    /* ManagerRegistry pour intéragir avec la base de données entreprise type elemnt*/
    public function add(ManagerRegistry $doctrine,Entreprise $entreprise=null,Request $request):Response
    {
        /*entrepriseType from form  entreprise, $entreprise en paramétres*/
        $form=$this->createForm(EntrepriseType::class,$entreprise);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $entreprie=$form->getData();
            //getManager() pour accéeder au persiste et flush.
            $entityManager=$doctrine->getManager();
            //prepare
            $entityManager->persist($entreprise);
            //insert into (excute)
            $entityManager->flush();
        return $this->redirectToRoute('app_entreprise');

        }
        return $this->render('entreprise/add.html.twig',[
          'formAddEntreprise'=>$form->createView()  
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