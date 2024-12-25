<?php

namespace App\Form;

use App\Entity\Institution;
use App\Entity\InstitutionSession;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 

class InstitutionSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('institution', EntityType::class, [
            'class' => Institution::class,
            'choice_label' => 'nom', // Assurez-vous de choisir le bon champ pour afficher
            'placeholder' => 'Sélectionner une institution',
        ])
        ->add('session', EntityType::class, [
            'class' => Session::class,
            'choice_label' => 'nom', // Idem pour Session
            'placeholder' => 'Sélectionner une session',
        ])
        ->add('delete', SubmitType::class, [
            'label' => 'Supprimer', // Label for the button
            'attr' => ['class' => 'btn-danger'], // Class for styling
            'attr' => ['id' => 'custom_id'],
                    ]);
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InstitutionSession::class,
        ]);
    }
}
