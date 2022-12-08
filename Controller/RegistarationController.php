<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistartionType;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistarationController extends  AbstractController{
    /**
     * @var  UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder=$passwordEncoder;

    }

    /**
     * @Route("/inscription",name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request):Response
    {
        $user=new User();
        $form=$this->createForm(RegistartionType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user,$form->get("password")->getData())
            );
          //  $user->setToken($this->generateToken());
           $em=$this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();


           $this->addFlash("success","Account created successfully");

        }
        return $this->render('register.html.twig',[
            'form'=>$form->createView()]);
    }
    public function  generateToken(){
        return rtrim(strtr(base64_encode(random_bytes(32)),'+/','-_'),'=');
    }
}

