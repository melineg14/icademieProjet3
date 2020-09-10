<?php 
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/admin", name="connexion")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/login.html.twig');
    }
}