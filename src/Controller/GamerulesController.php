<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GamerulesController extends AbstractController
{
    /**
     * @Route("/gamerules", name="gamerules")
     */
    public function index()
    {
        return $this->render('gamerules/index.html.twig', [
            'controller_name' => 'GamerulesController',
        ]);
    }
}
