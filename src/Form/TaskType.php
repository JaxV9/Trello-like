<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {



        $builder
            ->add('title', null, [
                'label' => false,
                'attr' => [
                    'class' => 'formUser',
                    'placeholder' => 'Title'
                ]
                ])
            ->add('content', null, [
                'label' => false,
                'attr' => [
                    'class' => 'formUser_c',
                    'placeholder' => 'Content'
                ]
                ])
            ->add('created_at', null, [
                'label' => false,
                'attr' => [
                    'class' => 'hidden',
                ]
                ])
            ->add('updated_at', null, [
                'label' => false,
                'attr' => [
                    'class' => 'hidden',
                ]
                ])
            ->add('completed_at', null, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'completed'
                ],
                'widget' => 'single_text',
            ])
            ->add('users', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'email',
                'multiple' => true,
                'expanded' => false,
                'label' => false,
                'attr' => [
                    'class' => 'formUser_ld',
                    'placeholder' => 'users'
                ]
                
            ])
            ->add('status', EntityType::class, [
                'class' => 'App\Entity\Status',
                'choice_label' => 'label',
                'multiple' => false,
                'expanded' => false,
                'label' => false,
                'attr' => [
                    'class' => 'hidden',
                    'placeholder' => 'status',
                ]
                
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
