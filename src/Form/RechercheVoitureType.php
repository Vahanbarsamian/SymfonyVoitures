<?php

namespace App\Form;

use App\Entity\RechercheVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'minAnnee',
                IntegerType::class,
                [
                    'label' => 'Année de départ :',
                    'required' => false,
                ]
            )
            ->add(
                'maxAnnee',
                IntegerType::class,
                [
                    'label' => 'Année de fin :',
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => RechercheVoiture::class,
            ]
        );
    }
}
