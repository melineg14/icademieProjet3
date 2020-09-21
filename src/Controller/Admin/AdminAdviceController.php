<?php 
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdviceController extends AbstractController
{
    /**
     * @Route("/admin/conseils", name="admin_advice.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/advice.html.twig');
    }
}