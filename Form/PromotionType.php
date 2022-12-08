<?php

namespace App\Form;

use App\Entity\Promotion;
use App\Entity\Service;
use App\Entity\Typepromo;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixHeurePres')
            ->add('tauxPromo')
            ->add('prixHeureFinal')
            ->add('dateDebuPromo')
            ->add('dateFinPromo')
            ->add('idType',EntityType::class,['class'=>Typepromo::class,
                'choice_label'=>'description',
                'multiple'=>false,
                'expanded'=>false])
            ->add('idService',EntityType::class,['class'=>service::class,
                'choice_label'=>'nom',
                'multiple'=>false,
                'expanded'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
