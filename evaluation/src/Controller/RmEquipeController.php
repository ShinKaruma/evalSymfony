<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Equipe;

class RmEquipeController extends AbstractController
{
    /**
     * @Route("/rm/equipe{id}", name="rm_equipe")
     */
    public function index(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Equipe::class);
        $equipe = $repository->find($id);
        $em->remove($equipe);
        $em->flush();

        return $this->redirectToRoute("liste_equipe");
    }
}
