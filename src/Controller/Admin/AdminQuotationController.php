<?php 
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminQuotationController extends AbstractController
{
    /**
     * @Route("/admin/devis", name="admin_quotation.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/quotation.html.twig');
    }
}