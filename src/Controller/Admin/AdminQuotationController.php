<?php

namespace App\Controller\Admin;

use App\Entity\Quotation;
use App\Repository\QuotationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminQuotationController extends AbstractController
{
    /**
     * @var QuotationRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(QuotationRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin/devis", name="admin_quotation.index")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $quote = new Quotation();
        $form = $this->createFormBuilder($quote)
            ->add('status', ChoiceType::class, [
                'choices' => $this->getChoices(),
                'attr' => [
                    'class' => 'custom-select',
                ]
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $status = $form->get('status')->getData();
            $quotes = $this->repository->findByStatus($status);
        } else {
            $quotes = $this->repository->findAllByDate();
        }

        if (isset($_POST['reset'])) {
            $quotes = $this->repository->findAllByDate();
        }

        return $this->render('admin/quotation/index.html.twig', [
            'form' => $form->createView(),
            'quotations' => $quotes,
        ]);
    }

    /**
     * @Route("/admin/devis/{id}", name="admin_quotation.show")
     * @return Response
     */
    public function show(Quotation $quote, Request $request): Response
    {
        $quotation = new Quotation();
        $form = $this->createFormBuilder($quotation)
            ->add('status', ChoiceType::class, [
                'choices' => $this->getChoices(),
                'label' => 'Statut',
                'attr' => [
                    'class' => 'custom-select'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $quotation->setUpdatedAt(new \DateTime());
            $newStatus = $form->get('status')->getData();
            $this->repository->updateStatus($newStatus, $quote);
        }

        return $this->render('admin/quotation/show.html.twig', [
            'quotation' => $quote,
            'form' => $form->createView()
        ]);
    }

    public function getChoices()
    {
        $choices = Quotation::STATUS;
        $output = [];
        foreach ($choices as $key => $value) {
            $output[$value] = $key;
        }
        return $output;
    }

    /**
     * @Route("/admin/devis/suppression/{id}", name="admin_quotation.delete", methods="DELETE")
     */
    public function delete(Quotation $quote, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $quote->getId(), $request->get('_token'))) {
            $this->manager->remove($quote);
            $this->manager->flush();
            $this->addFlash('success', 'Demande de devis supprimée avec succès.');
        }
        return $this->redirectToRoute('admin_quotation.index');
    }
}
