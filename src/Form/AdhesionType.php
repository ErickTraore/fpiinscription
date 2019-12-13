<?php

namespace App\Form;

use App\Entity\Adhesion;
use App\Entity\User;
use App\Form\AdhesionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdhesionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender',ChoiceType::class, [
                'choices'  => [
                    'Homme' => true,
                    'Femme' => false,]])
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('lieuNaissance', TextType::class)
            ->add('birthday' , BirthdayType :: class)
            ->add('nationnalite', TextType::class)
            ->add('natureIdentite', ChoiceType::class, [
                'choices' => [
                    'Aucun' => 'aucun',
                    'Carte Identite' => 'cartident',
                    'Permis'   => 'permis',
                    'Passport' => 'passport',
                ],
                'preferred_choices' => ['muppets', 'cartident']
            ])
            ->add('numberIdentity', TextType::class)
            ->add('ville', TextType::class)
            ->add('codepostale', TextType::class)
            ->add('pays', TextType::class)
            ->add('email', EmailType::class)
            ->add('profession', TextType::class)
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Aucune' => 'Aucune',
                    'Base' => 'Base',
                    'Section' => 'Section',
                    'Fedération'   => 'Fedération',
                    'Représentation'   => 'Représentation',
                    'Comité Central'   => 'Comité Central',
                    'Comité de Controle'   => 'Comité de Controle',
                    'Secretariat Genéral' => 'Secretariat Genéral',
                    'Maire' => 'Maire',
                    'Deputé' => 'Deputé',
                    'Conseil Régionnal' => 'Conseil Régionnal',
                    'Préfet' => 'Préfet',
                    'Gouverneur' => 'Gouverneur',
                    'Autre' => 'Autre',
                ],
                'preferred_choices' => ['muppets', 'Aucune']
            ])
            
            ->add('save', SubmitType :: class , [
                'label' => 'Enregistrer',
            ])
            ->add('Annuler', SubmitType :: class , [
                'label' => 'Annuler',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adhesion::class,
        ]);
    }
}
