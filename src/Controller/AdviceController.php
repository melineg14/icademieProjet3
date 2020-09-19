<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdviceController extends AbstractController
{
    /**
     * @Route("/conseils", name="advices.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/advice.html.twig');
    }

     /**
     * @Route("/conseils/{id}", name="advices.article")
     * @return Response
     */
    public function article(): Response
    {
        return $this->render('pages/article.html.twig');
    }

    /**
     * @Route("/admin/conseils", name="advices.list")
     * @return Response
     */
    public function list(): Response
    {
        return $this->render('admin/advices.html.twig');
    }
    
    /**
     * @Route("/admin/conseils/ajouter", name="advices.add")
     * @return Response
     */
    public function add(): Response
    {
        return $this->render('admin/advices.add.html.twig');
    }
    
    /**
     * @Route("/admin/conseils/modifier", name="advices.edit")
     * @return Response
     */
    public function edit(): Response
    {
        return $this->render('admin/advices.edit.html.twig');
    }     
}