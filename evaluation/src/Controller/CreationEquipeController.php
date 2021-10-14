<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Equipe;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CreationEquipeController extends AbstractController
{
    /**
     * @Route("/creation/equipe", name="creation_equipe")
     */
    public function index(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
        $equipe = new Equipe;
        $form = $this->createFormBuilder($equipe)
                     ->add('nom', TextType::class, array('label' =>"Nom de l'équipe : "))
                     ->add('mascotte', TextType::class, array('label' =>"Mascotte de l'équipe : "))
                     ->add('nbJoueurs', IntegerType::class, array('label' =>"Nombre de joueurs dans l'équipe : "))
                     ->add('lieu', TextType::class, array('label' =>"Lieu de rassemblement de l'équipe : "))
                     ->add('save', SubmitType::class, array('label' => "Enregistrer l'équipe"))
                     ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipe = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();
            return $this->redirectToRoute('liste_equipe');
        }

        return $this->render('creation_equipe/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
