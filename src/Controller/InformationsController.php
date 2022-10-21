<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Controller displaying legal informations, "About" page, cookies policy, etc...
 */
class InformationsController extends AbstractController
{
    /**
     * @Route("/sales-conditions", name="sales_conditions", methods={"GET"})
     *
     * @return Response
     */
    public function showSalesConditions(): Response
    {
        return $this->render("divers/sales_conditions.html.twig");
    }

    /**
     * @Route("/about", name="about", methods={"GET"})
     *
     * @return Response
     */
    public function showAboutPage(): Response
    {
        return $this->render("divers/about.html.twig");
    }
}
