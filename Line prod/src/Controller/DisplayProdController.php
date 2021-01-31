<?php

namespace App\Controller;

use App\Entity\DisplayProd;
use App\Form\DisplayProdType;
use App\Repository\DisplayProdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/display/prod")
 */
class DisplayProdController extends AbstractController
{
    /**
     * @Route("/", name="display_prod_index", methods={"GET"})
     */
    public function index(DisplayProdRepository $displayProdRepository): Response
    {
        return $this->render('display_prod/index.html.twig', [
            'display_prods' => $displayProdRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="display_prod_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $displayProd = new DisplayProd();
        $form = $this->createForm(DisplayProdType::class, $displayProd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($displayProd);
            $entityManager->flush();

            return $this->redirectToRoute('display_prod_index');
        }

        return $this->render('display_prod/new.html.twig', [
            'display_prod' => $displayProd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="display_prod_show", methods={"GET"})
     */
    public function show(DisplayProd $displayProd): Response
    {
        return $this->render('display_prod/show.html.twig', [
            'display_prod' => $displayProd,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="display_prod_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DisplayProd $displayProd): Response
    {
        $form = $this->createForm(DisplayProdType::class, $displayProd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('display_prod_index');
        }

        return $this->render('display_prod/edit.html.twig', [
            'display_prod' => $displayProd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="display_prod_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DisplayProd $displayProd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$displayProd->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($displayProd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('display_prod_index');
    }
}
