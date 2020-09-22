<?php
namespace App\Controller;

use App\Entity\Quotation;
use App\Form\QuotationType;
use App\Notification\QuotationNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuotationController extends AbstractController
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
     * @Route("/devis", name="quotation")
     * @return Response
     */
    public function index(Request $request, QuotationNotification $notification): Response
    {
        $quote = new Quotation();
        $form = $this->createForm(QuotationType::class, $quote);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $quote->setCreatedAt(new \DateTime());
            $this->manager->persist($quote);
            $this->manager->flush();
            $notification->notify($quote);
            $notification->abstract($quote);
            $this->addFlash('success', 'Votre demande de devis a bien été envoyée, vous recevrez une réponse sous 24h.');
        }

        return $this->render('pages/quotation.html.twig', [
            'form' => $form->createView()
        ]);
    } 
}