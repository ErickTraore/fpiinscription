<?php

namespace App\Form;

use App\Entity\Fpilyon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class FpilyonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('phone')
            ->add('adresse')
            ->add('remarque')
            ->add('selection')
            ->add('selectionTest')
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'],)
           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fpilyon::class,
        ]);
    }
}
