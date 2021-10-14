<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Equipe;


class ListeEquipeController extends AbstractController
{
    /**
     * @Route("/liste/equipe", name="liste_equipe")
     */
    public function index(): Response
    {   $repository=$this->getDoctrine()->getRepository(Equipe::class);
        $lesEquipes=$repository->findAll();
        return $this->render('liste_equipe/index.html.twig', [
            'lesEquipes' => $lesEquipes,
        ]);
    }
}
