<?php

namespace App\Controller;

use App\Entity\Advice;
use App\Repository\AdviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdviceController extends AbstractController
{
    /**
     * @var AdviceRepository
     */
    private $repository;

    public function __construct(AdviceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/conseils", name="advice.index")
     * @return Response
     */
    public function index(): Response
    {
        $advices = $this->repository->findAll();
        return $this->render('pages/advice.html.twig', [
            'advices' => $advices
        ]);
    }

    /**
     * @Route("/conseils/{slug}-{id}", name="advice.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Advice $advice, $slug): Response
    {
        if ($advice->getSlug() !== $slug) {
            return $this->redirectToRoute('advice.show', [
                'id' => $advice->getId(),
                'slug' => $advice->getSlug()
            ], 301);
        }
        return $this->render('pages/article.html.twig', [
            'advice' => $advice
        ]);
    }
}
