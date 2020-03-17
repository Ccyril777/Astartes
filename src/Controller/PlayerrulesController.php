<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlayerrulesController extends AbstractController
{
    /**
     * @Route("/playerrules", name="playerrules")
     */
    public function index()
    {
        return $this->render('playerrules/index.html.twig', [
            'controller_name' => 'PlayerrulesController',
        ]);
    }
}
