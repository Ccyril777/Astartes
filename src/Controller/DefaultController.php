<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Heading;
use App\Repository\HeadingRepository;
use App\Entity\Category;
use App\Repository\CategoryRepository;

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

        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        if (!$headings) {
            throw $this->createNotFoundException(
            'No program found in heading\'s table.'
            );
        }

        if (!$categories) {
            throw $this->createNotFoundException(
            'No program found in category\'s table.'
            );
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'heading' => $headings,
            'category' => $categories
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

    /**
    * @Route("category/list", name="category_list")
    */
    public function categoryList()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('home/category.html.twig', [
            'category' => $categories
        ]);
    }
}
