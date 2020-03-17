<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Heading;
use App\Entity\HeadingRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $headings = $this->getDoctrine()
        ->getRepository(Heading::class)
        ->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'heading' => $headings
        ]);
    }
    /**
    * @Route("heading/list", name="heading_list")
    */
    public function headingList()
    {
        $headings = $this->getDoctrine()
            ->getRepository(Heading::class)
            ->findAll();
        return $this->render('home/heading.html.twig', [
            'headings' => $headings
        ]);
    }
}
