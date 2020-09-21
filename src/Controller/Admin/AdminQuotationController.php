<?php 
namespace App\Controller\Admin;

use App\Entity\Quotation;
use App\Repository\QuotationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminQuotationController extends AbstractController
{
    /**
     * @Route("/admin/devis", name="admin_quotation")
     * @return Response
     */
    public function index(Request $request, QuotationRepository $repository): Response
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

        if($form->isSubmitted()) {
            $status = $form->get('status')->getData();
            $quotes = $repository->findByStatus($status);
        }
        else {
            $quotes = $repository->findAllByDate();
        }

        return $this->render('admin/quotation/index.html.twig', [
            'form' => $form->createView(),
            'quotations' => $quotes,
        ]);
    }

    /**
     * @Route("/admin/devis/{id}", name="admin_quotation.index")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('admin/quotation/show.html.twig');
    }

    public function getChoices()
    {
        $choices = Quotation::STATUS;
        $output = [];
        foreach($choices as $key => $value) {
            $output[$value] = $key;
        }
        return $output;
    }
}