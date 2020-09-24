<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAppointmentController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/admin/rendez_vous", name="admin_appointment.index")
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
    public function show(Appointment $appointment): Response
    {
        return $this->render('admin/contact/show.html.twig', [
            'appointment' => $appointment
        ]);
    }

    /**
     * @Route("/admin/rendez_vous/suppression/{id}", name="admin_appointment.delete", methods="DELETE")
     */
    public function delete(Appointment $app, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $app->getId(), $request->get('_token'))) {
            $this->manager->remove($app);
            $this->manager->flush();
            $this->addFlash('success', 'Prise de rendez-vous supprimée avec succès.');
        }
        return $this->redirectToRoute('admin_appointment.index');
    }
}
