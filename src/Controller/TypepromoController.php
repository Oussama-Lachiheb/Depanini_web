<?php

namespace App\Controller;

use App\Entity\Typepromo;
use App\Form\TypepromoType;
use App\Repository\TypePromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/typepromo')]
class TypepromoController extends AbstractController
{
    #[Route('/', name: 'app_typepromo_index', methods: ['GET'])]
    public function index(TypePromoRepository $typePromoRepository): Response
    {
        return $this->render('typepromo/index.html.twig', [
            'typepromos' => $typePromoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_typepromo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypePromoRepository $typePromoRepository): Response
    {
        $typepromo = new Typepromo();
        $form = $this->createForm(TypepromoType::class, $typepromo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typePromoRepository->save($typepromo, true);

            return $this->redirectToRoute('app_typepromo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('typepromo/new.html.twig', [
            'typepromo' => $typepromo,
            'form' => $form,
        ]);
    }

    #[Route('/{idType}', name: 'app_typepromo_show', methods: ['GET'])]
    public function show(Typepromo $typepromo): Response
    {
        return $this->render('typepromo/show.html.twig', [
            'typepromo' => $typepromo,
        ]);
    }

    #[Route('/{idType}/edit', name: 'app_typepromo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Typepromo $typepromo, TypePromoRepository $typePromoRepository): Response
    {
        $form = $this->createForm(TypepromoType::class, $typepromo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typePromoRepository->save($typepromo, true);

            return $this->redirectToRoute('app_typepromo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('typepromo/edit.html.twig', [
            'typepromo' => $typepromo,
            'form' => $form,
        ]);
    }

    #[Route('/{idType}', name: 'app_typepromo_delete', methods: ['POST'])]
    public function delete(Request $request, Typepromo $typepromo, TypePromoRepository $typePromoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typepromo->getIdType(), $request->request->get('_token'))) {
            $typePromoRepository->remove($typepromo, true);
        }

        return $this->redirectToRoute('app_typepromo_index', [], Response::HTTP_SEE_OTHER);
    }
}
