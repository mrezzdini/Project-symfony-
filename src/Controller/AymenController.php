<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AymenController extends AbstractController
{
    /**
     * @Route("/", name="aymen")
     */
    public function index(): Response
    {
        return $this->render('aymen/index.html.twig');
    }
}
