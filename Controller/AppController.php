<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\Demande;
use App\Entity\Reclamation;
use App\Entity\TypeReclamation;
use App\Service\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\ReclamationRepository;

class AppController extends AbstractController
{
    #[Route('/reclamation', name: 'add_Reclamation')]
    public function createReclamation(Request $request, ManagerRegistry $doctrine): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createFormBuilder($reclamation)
                        ->add('typeReclamation',EntityType::class,['class'=>TypeReclamation::class,'choice_label'=>'descriptionType'])
                        ->add('descriptionReclamation')
                        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine ->getManager();
            $em->persist($reclamation);
            $em ->flush();
        }

        return $this->render('app/createRec.html.twig', [
            'formReclamation' => $form->createView(),
        ]);
    }


    #[Route('/type', name: 'add_Type')]
    public function createType(Request $request, ManagerRegistry $doctrine): Response
    {
            $typereclamation = new TypeReclamation();

        $form = $this->createFormBuilder($typereclamation)
            ->add('descriptionType')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine ->getManager();
            $em->persist($typereclamation);
            $em ->flush();
        }


        return $this->render('app/createType.html.twig', [
        'formTypeReclamation' => $form->createView(),
        ]);


    }


    #[Route('/typelist', name: 'app_list_type')]
    public function GetAll(ManagerRegistry $doc) : Response
    {

        $repo = $doc ->getRepository(TypeReclamation::class);
        $list = $repo->findAll();
        return $this->render('app/listType.html.twig',["listOfType" => $list]);
    }

    #[Route('/delete/{id}', name: 'app_delete_type')]
    public function deleteClassroom(ManagerRegistry $doc,$id): Response
    {

        $repo = $doc ->getRepository(TypeReclamation::class);
        $cl = $repo->find($id);

        $em = $doc ->getManager();
        $em ->remove($cl);
        $em->flush();

        return $this->redirectToRoute("app_list_type");
    }

    #[Route('/toptypereclame', name: 'top_type_reclamé')]
    public function TypePlusReclame(PdfService $p,ManagerRegistry $doc): Response
    {



        $repo = $doc ->getRepository(Reclamation::class);


        $listreclamations = $repo->TypePlusReclame();


        return $this->render('app/topTypeReclame.html.twig', [
            'items' => $listreclamations,
        ]);
    }
/*
    #[Route('/toptypereclame/imprimer', name: 'top_type_reclamé_pdf')]
    public function TypePlusReclamé(ManagerRegistry $doc): Response
    {

        //$repo = $this->getDoctrine()->getRepository(Reclamation::class);




        $listreclamations = $repo->TypePlusReclame();


        return $this->render('app/topTypeReclame.html.twig', [
            'items' => $listreclamations,
        ]);
        $pdfService->showPdfFile($html);
    }*/

    #[Route('/toptypereclame/pdf', name: 'pdf')]
    public function generatePdfDemandes(PdfService $pdf, ManagerRegistry $doc){
       // $repo=$this->getDoctrine()->getRepository(Reclamation::class);
        $repo = $doc ->getRepository(Reclamation::class);


        $listreclamations = $repo->TypePlusReclame();
        $html = $this->render('app/topTypeReclame.html.twig', [
            'items' => $listreclamations
        ]);
        $pdf->showPdfFile($html);
    }
}
