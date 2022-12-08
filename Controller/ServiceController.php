<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Classroom;
use App\Entity\Demande;
use App\Entity\Reclamation;
use App\Entity\Service;
use App\Repository\ServiceRepository;

use App\Service\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{

    public int $serviceId;
/*
    ///SERVICE
    ///
    ///ADD/UPDATE SERVICE PAR PRESTATAIRE*/
    #[Route('/service/new', name: 'add_Service')]
    #[Route('/service/edit/{id}', name: 'service_edit')]
    public function createReclamation(Service $service = null, Request $request, ManagerRegistry $doctrine): Response
    {
        if(!$service){
            $service = new Service();
        }

        $form = $this->createFormBuilder($service)
            ->add('nomService')
            ->add('image')
            ->add('categorie',EntityType::class,['class'=>Categorie::class,'choice_label'=>'nomCategorie'])
            ->add('DescriptionService')
            ->add('PrixHeure')

            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$service->getId())
            {
                $service->setCreatedAt(new \DateTime());

            }
            $em = $doctrine ->getManager();
            $em->persist($service);
            $em ->flush();


            return $this->redirectToRoute('service_show',['id' => $service->getId()]);
        }

        return $this->render('service/createService.html.twig', [
            'formService' => $form->createView(),
            'editMode' => $service->getId() !== null,
        ]);
    }

//AFFICHAGE DES SERVICE PAR CLIENT
    #[Route('/service', name: 'Aff_service')]
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Service::class);

        $services = $repo->findAll();
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' =>$services
        ]);
    }
    public int $idService;
//AFFICHAGE D'UN SERVICE PAR CLIENT
    #[Route('/service/{id}', name: 'service_show')]
    public function showService($id,$idService=null): Response
    {
        $repo=$this->getDoctrine()->getRepository(Service::class);

        $service = $repo->find($id);
        $idService= $id;
        return $this->render('service/show.html.twig', [
            'service' => $service
        ]);
    }






    //DEMANDE


    // ADD/UPDATE DEMANDE PAR CLIENT
    #[Route('/service/demande/{id}', name: 'add_demande')]
    public function createDemande(int $id=null,Demande $demande = null, Request $request, ManagerRegistry $doctrine): Response
    {

            $demande = new Demande();


          $repo=$this->getDoctrine()->getRepository(Service::class);

        $service = $repo->find($id);

        $form = $this->createFormBuilder($demande)

            ->add('dateDemande')
            ->add('descriptionDemande')


            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //$demande->setCreatedAt(new \DateTime());
            if(!$demande->getId())
            {
                 $demande->setIdService($service);

            }

            $em = $doctrine ->getManager();
            $em->persist($demande);
            $em ->flush();

            return $this->redirectToRoute('demande_show');
        }

        return $this->render('service/createDemande.html.twig', [
            'formDemande' => $form->createView(),

        ]);
    }

    #[Route('/service/demande/edit/{id}', name: 'demande_edit')]
    public function udpateDemande(int $id = null,Demande $demande = null, Request $request, ManagerRegistry $doctrine): Response
    {
        if(!$demande){
            $demande = new Demande();
        }

      //  $repo=$this->getDoctrine()->getRepository(Service::class);

        //$service = $repo->find($idService);

        $form = $this->createFormBuilder($demande)

            ->add('dateDemande')
            ->add('descriptionDemande')


            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //$demande->setCreatedAt(new \DateTime());
            if(!$demande->getId())
            {
               // $demande->setIdService($service);

            }

            $em = $doctrine ->getManager();
            $em->persist($demande);
            $em ->flush();

           return $this->redirectToRoute('demande_show');
        }

        return $this->render('service/updateDemande.html.twig', [
            'formDemande' => $form->createView(),

        ]);
    }

    ///AFFICHAGE DES DEMANDES PAR ADMIN
    #[Route('/demandes', name: 'demande_show')]
    public function showDemandeA(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Demande::class);
        $repoS=$this->getDoctrine()->getRepository(Service::class);

        $listdemandes = $repo->findAll();

        return $this->render('service/showDemande.html.twig', [
            'items' => $listdemandes,
        ]);
    }


    /*
    ///AFFICHAGE DES DEMANDES PAR CLIENT
    #[Route('/demandes', name: 'demande_show')]
    public function showDemandeC(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Demande::class);
        $repoS=$this->getDoctrine()->getRepository(Service::class);

        $listdemandes = $repo->findBy($idClient);

        return $this->render('service/showDemande.html.twig', [
            'items' => $listdemandes,
        ]);
    }*/




/*
    ///AFFICHAGE DES DEMANDES PAR PRESTATAIRE
    #[Route('/demandes', name: 'demande_show')]
    public function showDemandeP(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Demande::class);
        $repoS=$this->getDoctrine()->getRepository(Service::class);

        $listdemandes = $repo->findBy($idPrestatire);

        return $this->render('service/showDemande.html.twig', [
            'items' => $listdemandes,
        ]);
    }*/
    /*
    public function findServiceNameById($idService,Service $service = null){
        $repoS=$this->getDoctrine()->getRepository(Service::class);
        $service = $repoS->find($idService);


        return $service;
    }*/




////DELETE DEMANDE PAR CLIENT
    #[Route('/demande/delete/{id}', name: 'delete_demande')]
    public function deleteDemande(ManagerRegistry $doc,$id): Response
    {

        $repo = $doc ->getRepository(Demande::class);
        $cl = $repo->find($id);

        $em = $doc ->getManager();
        $em ->remove($cl);
        $em->flush();

        return $this->redirectToRoute("demande_show");
    }

    #[Route('/demandes/pdf', name: 'pdf')]
    public function generatePdfDemandes(PdfService $pdf){
        $repo=$this->getDoctrine()->getRepository(Demande::class);


        $listdemandes = $repo->findAll();
        $html = $this->render('service/showDemande.html.twig', [
            'items' => $listdemandes
        ]);
        $pdf->showPdfFile($html);
    }

    //SERVICE LE PLUS DEMANDE
    #[Route('/topservice', name: 'top_service')]
    public function TopService(): Response
    {


        $repo = $this->getDoctrine()->getRepository(Demande::class);

        $listdemandes = $repo->TopService1();


        return $this->render('service/topService.html.twig', [
            'items' => $listdemandes,
        ]);
    }
}
