<?php

namespace App\Controller;
use App\Entity\Prestataire;
use App\Form\PrestataireType;
use App\Repository\PrestataireRepository;
use App\Repository\RateRepository;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/prestataire')]
class PrestataireController extends AbstractController
{

    #[Route('/', name: 'app_prestataire_index', methods: ['GET'])]
    public function index(PrestataireRepository $prestataireRepository,PaginatorInterface $paginator,Request $request): Response
    {

        $donnees = $prestataireRepository->findAll();
        $articles = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('prestataire/index.html.twig', [
            'prestataires' => $articles ,
            'nb' => $prestataireRepository->numberOfPrestataire(),
        ]);
    }

    #[Route('/all', name: 'app_prestataire_prix', methods: ['GET'])]
    public function PresByPrix(PrestataireRepository $prestataireRepository,PaginatorInterface $paginator,Request $request): Response{

        $donnees = $prestataireRepository->findAll();
        $articles = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('prestataire/ClientsDashboard.html.twig', [
            'prestataires' => $articles ,
            'nb' => $prestataireRepository->numberOfPrestataire(),
        ]);
    }

    #[Route('/new', name: 'app_prestataire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PrestataireRepository $prestataireRepository, MailerInterface $mailer): Response
    {
        $prestataire = new Prestataire();
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prestataireRepository->save($prestataire, true);
            $mail = new PHPMailer(true);

            $mail->isSMTP();// Set mailer to use SMTP
            $mail->CharSet = "utf-8";// set charset to utf8
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->SMTPSecure = 'tls';// Enable TLS encryption, ssl also accepted

            $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
            $mail->Port = 587;// TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isHTML(true);// Set email format to HTML

            $mail->Username = 'oussama.lachiheb@esprit.tn';// SMTP username
            $mail->Password ='213JMT3053';
            $mail->setFrom('oussama.lachiheb@esprit.tn', 'Admin Evènements');//Your application NAME and EMAIL
            $mail->Subject = 'Inscription';//Message subject
            $mail->Body = '<h1>vous aves inscrire a dipanini et  votre mot de passe :'.$prestataire->getMotDePasse().'</h1>';// Message body
            $mail->addAddress($prestataire->getEmail());// Target email


            $mail->send();
            return $this->redirectToRoute('app_prestataire_index', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('prestataire/new.html.twig', [
            'prestataire' => $prestataire,
            'form' => $form,
        ]);
    }

    #[Route('/{idPrestataire}', name: 'app_prestataire_show', methods: ['GET'])]
    public function show(Prestataire $prestataire): Response
    {
        return $this->render('prestataire/show.html.twig', [
            'prestataire' => $prestataire,
        ]);
    }

    #[Route('/ad/{idPrestataire}', name: 'app_prestataire_showad', methods: ['GET'])]
    public function showad(Prestataire $prestataire): Response
    {
        return $this->render('prestataire/showadm.html.twig', [
            'prestataire' => $prestataire,
        ]);
    }


    #[Route('/{idPrestataire}/edit', name: 'app_prestataire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prestataire $prestataire, PrestataireRepository $prestataireRepository): Response
    {
        $form = $this->createForm(PrestataireType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prestataireRepository->save($prestataire, true);

            return $this->redirectToRoute('app_prestataire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestataire/edit.html.twig', [
            'prestataire' => $prestataire,
            'form' => $form,
        ]);
    }

    #[Route('/{idPrestataire}', name: 'app_prestataire_delete', methods: ['POST'])]
    public function delete(Request $request, Prestataire $prestataire, PrestataireRepository $prestataireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestataire->getIdPrestataire(), $request->request->get('_token'))) {
            $prestataireRepository->remove($prestataire, true);
        }

        return $this->redirectToRoute('app_prestataire_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{idPrestataire}/rate', name: 'app-ratedd', methods: ['GET'])]
    public function RatePres(RateRepository $rateRepository,$idPrestataire): Response{
        return $this->render('prestataire/DashboardAdminPrestataire.html.twig', [
            'ratess' => $rateRepository->getRatePrestataire($idPrestataire),
            'moy' => $rateRepository->MoyRate($idPrestataire),
        ]);
    }
    #[Route('/rated/prestataire', name: 'app_prestataire_toprate', methods: ['GET'])]
    public function TopRated(RateRepository $rateRepository): Response{
        return $this->render('prestataire/DashboardAdmin.html.twig', [
            'moyy' => $rateRepository->PrestataireTopRated1(),
        ]);
    }

    #[Route('/rated/prestataireClient', name: 'app_prestataire_toprated', methods: ['GET'])]
    public function TopRatedClient(RateRepository $rateRepository): Response{
        return $this->render('prestataire/DashboardClient.html.twig', [
            'moyy' => $rateRepository->PrestataireTopRated1(),
        ]);
    }



}
