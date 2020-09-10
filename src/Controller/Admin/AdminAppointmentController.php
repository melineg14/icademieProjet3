<?php 
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAppointmentController extends AbstractController
{
    /**
     * @Route("/admin/rendezvous", name="admin_appointments")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/appointment.html.twig');
    }
}