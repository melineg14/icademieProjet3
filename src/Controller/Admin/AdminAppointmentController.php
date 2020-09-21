<?php 
namespace App\Controller\Admin;

use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAppointmentController extends AbstractController
{
    /**
     * @Route("/admin/rendez_vous", name="admin_appointment")
     * @return Response
     */
    public function index(AppointmentRepository $repository): Response
    {
        $appointments = $repository->findAllByDate();
        return $this->render('admin/contact/index.html.twig', [
            'appointments' => $appointments
        ]);
    }

    /**
     * @Route("/admin/rendez_vous/{id}", name="admin_appointment.show")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('admin/contact/show.html.twig');
    }
}