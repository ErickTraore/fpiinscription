<?php

namespace App\Form;

use App\Entity\Count;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref')
            ->add('description')
            ->add('pUnHt')
            ->add('qte')
            ->add('remise')
            ->add('pUnHtRem')
            ->add('prixTotHt')
            ->add('tva')
            ->add('dateBill')
            ->add('totalTtc')
            ->add('totCumul')
            ->add('dateCumul')
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Count::class,
        ]);
    }
}
