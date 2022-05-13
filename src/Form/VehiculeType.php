<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Proprietaire;
use App\Entity\Vehicule;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modele')
            ->add('annee_de_sortie', TypeDateType::class, [
                'widget' => 'single_text'
            ])
            ->add('energie',  ChoiceType::class, [
                'choices' => [
                    'Essence' => 1,
                    'Diesel' => 2,
                    'GPL' => 3,
                    'Electrique' => 4,
                    'Hybride' => 5
                ]])
            ->add('boite_de_vitesse',  ChoiceType::class, [
                'choices' => [
                    'Manuelle' => 1,
                    'Automatique' => 2,
                ]])
            ->add('nombre_de_portes')
             ->add('imageFile', FileType::class, [
                'required' => false
             ],  array('label' => 'Photo'))
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaire::class,
                'choice_label' => 'nom'
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
