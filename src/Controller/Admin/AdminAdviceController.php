<?php

namespace App\Controller\Admin;

use App\Entity\Advice;
use App\Form\AdviceType;
use App\Repository\AdviceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdviceController extends AbstractController
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
     * @Route("/admin/conseils", name="admin_advice.index")
     * @return Response
     */
    public function index(AdviceRepository $repository): Response
    {
        $advices = $repository->findAllByDate();
        return $this->render('admin/advice/index.html.twig', [
            'advices' => $advices
        ]);
    }

    /**
     * @Route("/admin/conseils/ajouter", name="admin_advice.add")
     * @return Response
     */
    public function add(Request $request): Response
    {
        $advice = new Advice();
        $form = $this->createForm(AdviceType::class, $advice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advice->setCreatedAt(new \DateTime());
            $this->manager->persist($advice);
            $this->manager->flush();
            $this->addFlash('success', 'Conseil ajouté avec succès.');
            return $this->redirectToRoute('admin_advice.index');
        }
        return $this->render('admin/advice/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/conseils/{id}", name="admin_advice.show")
     * @return Response
     */
    public function show(Advice $advice): Response
    {
        return $this->render('pages/article.html.twig', [
            'advice' => $advice
        ]);
    }

    /**
     * @Route("/admin/conseils/modifier/{id}", name="admin_advice.edit")
     * @return Response
     */
    public function edit(Advice $advice, Request $request): Response
    {
        $form = $this->createForm(AdviceType::class, $advice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advice->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->addFlash('success', 'Conseil modifié avec succès.');
            return $this->redirectToRoute('admin_advice.index');
        }

        return $this->render('admin/advice/edit.html.twig', [
            'advice' => $advice,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/conseils/suppression/{id}", name="admin_advice.delete", methods="DELETE")
     */
    public function delete(Advice $advice, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $advice->getId(), $request->get('_token'))) {
            $this->manager->remove($advice);
            $this->manager->flush();
            $this->addFlash('success', 'Conseil supprimé avec succès.');
        }
        return $this->redirectToRoute('admin_advice.index');
    }
}
