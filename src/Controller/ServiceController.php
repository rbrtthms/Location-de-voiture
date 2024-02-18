<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("/Service", name="service")
     */
    public function index()
    {
        return $this->redirectToRoute('controller_show_vehicule');
    }

    /**
     * @Route("/Service/planDuSite", name="plandDuSite")
     */
    public function planSite($id = null)
    {
        return $this->render('Services/planDuSite.html.twig');
    }

    /**
     * @Route("/Vendeur/Services", name="vendeur_services")
     */
    public function services() {
        return $this->render('Services/vendeurAllService.html.twig');
    }
}