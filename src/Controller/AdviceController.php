<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdviceController extends AbstractController
{
    /**
     * @Route("/conseils", name="advices.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/advice.html.twig');
    }

     /**
     * @Route("/conseils/{id}", name="advices.article")
     * @return Response
     */
    public function article(): Response
    {
        return $this->render('pages/article.html.twig');
    }
}