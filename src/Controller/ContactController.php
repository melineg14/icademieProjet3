<?php
namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
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
     * @Route("/contact", name="contact")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $app = new Appointment();
        $form = $this->createForm(AppointmentType::class, $app);
        // var_dump($request);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $app->setCreatedAt(new \DateTime());
            $this->manager->persist($app);
            $this->manager->flush();
            $this->addFlash('success', 'Votre demande de prise de rendez-vous a bien été envoyée.');
        }
        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}