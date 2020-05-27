<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('immatriculation', TextType::class, ['label'=> 'Immatriculation'])
            ->add('nbPorte', IntegerType::class, ['label'=>'Nombre de porte'])
            ->add('annee', IntegerType::class, ['label' => 'Année'])
            ->add(
                'modele', EntityType::class,
                [
                    'class' => Modele::class,
                    'choice_label' => 'libelle',
                    'label' => 'Modèle'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
