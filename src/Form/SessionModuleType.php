<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\SessionModule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 

class SessionModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'nom',
            ])
            ->add('module', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'nom',

            ])
            // Add the delete button
            ->add('delete', SubmitType::class, [
                'label' => 'Supprimer', // Label for the button
                'attr' => ['class' => 'btn-danger'], // Class for styling
                'attr' => ['id' => 'custom_id'],
                        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SessionModule::class,
        ]);
    }
}
