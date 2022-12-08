<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Prestataire;
use App\Entity\Rate;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rate')
            ->add('idClient',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'nom',
                'multiple'=>false,
                'expanded'=>false
            ])
            ->add('idPrestataire',EntityType::class,[
                'class'=>Prestataire::class,
                'choice_label'=>'nom',
                'multiple'=>false,
                'expanded'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rate::class,
        ]);
    }
}
