<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'name.label',
            ])
            ->add('surname', TextType::class, [
                'required' => true,
                'label' => 'surname.label',
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => array(
                    'm'=>'Man',
                    "f"=>'Woman',
                ),
                'label'=>'gender.label'
            ])
            ->add('adherent', ChoiceType::class, [
                'choices' => array(
                    'yes'=>'adherent',
                    "no"=>'not adherent',
                ),
                'label'=>'adherent.label'
            ]);

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'translation_domain' => 'validators',
        ]);
    }
}