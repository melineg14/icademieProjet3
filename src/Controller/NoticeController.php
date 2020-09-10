<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoticeController extends AbstractController
{
    /**
     * @Route("/mentionslegales", name="notice")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/notice.html.twig');
    }
}