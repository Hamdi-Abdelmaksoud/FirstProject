<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]
    public function index(): Response
    {
        $arr=["val1","val2"];
        return $this->render('entreprise/index.html.twig', [
          'name'=>'Hamdi',
          'tableau'=>$arr
        ]);
    }
}
