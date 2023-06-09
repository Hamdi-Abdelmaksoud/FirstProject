<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EmployeController extends AbstractController
{
  
  
  
  
    #[Route('/employe/{id}/delete', name: 'delete_employe')]
public function delete (ManagerRegistry $doctrine,  Employe $employe):Response
{
$entityManager=$doctrine->getManager();
$entityManager->remove($employe);
$entityManager->flush();//execute la requete
return $this->redirectToRoute('app_employe');//retourner à la liste d'employer
}
  
    #[Route('/employe/add', name: 'add_employe')]
    #[Route('/employe/edit', name: 'edit_employe')]
    public function add(ManagerRegistry $doctrine, Employe $employe = null, Request $request): Response
    {
        if(!$employe){
            $employe=new Employe();
        }
        /*entrepriseType from form  entreprise, $entreprise en paramétres*/
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employe = $form->getData();
            //getManager() pour accéeder au persiste et flush.
            $entityManager = $doctrine->getManager();
            //prepare
            $entityManager->persist($employe);
            //insert into (excute)
            $entityManager->flush();
            return $this->redirectToRoute('app_employe');
        }
        return $this->render('employe/add.html.twig', [
            'formAddEmploye' => $form->createView(),
            'edit'=>$employe->getId()//si employe existe edit sinon ajout pour afficher editer ou ajouter à la vue

        ]);
         }
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
