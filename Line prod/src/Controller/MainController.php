<?php

namespace App\Controller;

use App\Entity\DisplayProd;
use App\Repository\DisplayProdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(DisplayProdRepository $displayProdRepository): Response
    {

        return $this->render('main/index.html.twig', [
            'prod' => $displayProdRepository->findAll(),
        ]);
    }
}
