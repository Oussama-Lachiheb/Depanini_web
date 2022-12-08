<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class RegistartionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'attr'=>[
                    "placeholder"=>"Enter your First name",
                    'class'=>'h-full-width'

                ]
            ],[
                'label'=>"First Name"
            ])
            ->add('prenom',TextType::class,[
                'attr'=>[
                    "placeholder"=>"Enter your Last name",
                    'class'=>'h-full-width'


                ]
            ],[
                'label'=>"Last Name"
            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    "placeholder"=>"Enter your Password ",
                    'class'=>'h-full-width'


                ]
            ],[
                'label'=>"Email"
            ])
            ->add('password',PasswordType::class,[
                'attr'=>[
                    "placeholder"=>"Enter your Password ",
                    'class'=>'h-full-width'


                ]
            ])
            ->add('adresse',TextareaType::class,[
                'attr'=>[
                    "placeholder"=>"Enter your Location ",
                    'class'=>'h-full-width'


                ]
            ])
            ->add('telephone',TextType::class,[
                'attr'=>[
                    "placeholder"=>"Enter your Phone number ",
                    'class'=>'h-full-width'


                ]
            ],[
                'label'=>"Phone"
            ])
            ->add("captcha",ReCaptchaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
