<?php

namespace App\Form;

use App\Entity\Quotation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class QuotationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('company', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('mail', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('quote_message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 6,
                    'placeholder' => 'Merci de renseigner si possible le secteur industriel où l’entreprise opère, le type de machine ainsi que le type de carte ou système défectueux.'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'attr' => [
                    'class' => 'form-control-file'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quotation::class,
            'translation_domain' => 'forms'
        ]);
    }
}
