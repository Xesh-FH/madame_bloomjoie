<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LandingPageController extends AbstractController
{
    /**
     * @Route("/landing-page", name="landing_page", methods={"GET"})
     *
     * @return Response
     */
    public function showLandingPage(): Response
    {
        return $this->render('landing_pages/landing_page.html.twig');
    }
}
