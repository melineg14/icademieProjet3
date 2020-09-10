<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuotationController extends AbstractController
{
    /**
     * @Route("/devis", name="quotations")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/quotations.html.twig');
    }
}