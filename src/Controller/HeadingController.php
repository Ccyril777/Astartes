<?php

namespace App\Controller;

use App\Entity\Heading;
use App\Form\HeadingType;
use App\Repository\HeadingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/heading")
 */
class HeadingController extends AbstractController
{
    /**
     * @Route("/", name="heading_index", methods={"GET"})
     */
    public function index(HeadingRepository $headingRepository): Response
    {
        return $this->render('heading/index.html.twig', [
            'headings' => $headingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="heading_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $heading = new Heading();
        $form = $this->createForm(HeadingType::class, $heading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heading);
            $entityManager->flush();

            return $this->redirectToRoute('heading_index');
        }

        return $this->render('heading/new.html.twig', [
            'heading' => $heading,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="heading_show", methods={"GET"})
     */
    public function show(Heading $heading): Response
    {
        return $this->render('heading/show.html.twig', [
            'heading' => $heading,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="heading_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Heading $heading): Response
    {
        $form = $this->createForm(HeadingType::class, $heading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('heading_index');
        }

        return $this->render('heading/edit.html.twig', [
            'heading' => $heading,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="heading_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Heading $heading): Response
    {
        if ($this->isCsrfTokenValid('delete'.$heading->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($heading);
            $entityManager->flush();
        }

        return $this->redirectToRoute('heading_index');
    }
}
