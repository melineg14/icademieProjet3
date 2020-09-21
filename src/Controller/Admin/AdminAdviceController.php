<?php 
namespace App\Controller\Admin;

use App\Repository\AdviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdviceController extends AbstractController
{
    /**
     * @Route("/admin/conseils", name="admin_advice")
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
    public function add(): Response
    {
        return $this->render('admin/advice/add.html.twig');
    }
    
    /**
     * @Route("/admin/conseils/modifier/{id}", name="admin_advice.edit")
     * @return Response
     */
    public function edit(): Response
    {
        return $this->render('admin/advice/edit.html.twig');
    }
}