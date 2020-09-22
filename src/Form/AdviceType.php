<?php

namespace App\Form;

use App\Entity\Advice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AdviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Maximum 60 caractères.',
                    'onkeyup' => 'titleCountUpdate(this.value)'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Maximum 150 caractères.',
                    'onkeyup' => 'descCountUpdate(this.value)',
                    'rows' => 2
                ]
            ])
            ->add('content', HiddenType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 6,
                    'id' => 'content',
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'attr' => [
                    'class' => 'form-control-file'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advice::class,
            'translation_domain' => 'forms'
        ]);
    }    
}
