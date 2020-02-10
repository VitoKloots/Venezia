<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/fruit", name="fruit_overzicht")
     */
    public function fruitShow(FruitRepository $fruitRepository)
    {
        return $this->render('bezoeker/fruit_overzicht.html.twig', [
           'fruit' => $fruitRepository->findAll(),
        ]);
    }
}
