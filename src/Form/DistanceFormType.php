<?php

namespace App\Form;

use App\Entity\Distance;
use App\Entity\Entrepot;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistanceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kilometres')
            ->add('leEntrepot', EntityType::class, [
                'class' => Entrepot::class,
                'choice_label' => 'id',
            ])
            ->add('laVille', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Distance::class,
        ]);
    }
}
