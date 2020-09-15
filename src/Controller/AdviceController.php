<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdviceController extends AbstractController
{
    /**
     * @Route("/conseils", name="advices")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/advice.html.twig');
    }
}