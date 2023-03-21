<?php

namespace App\Form;

use App\Entity\Status;
use App\Entity\Task;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('status', EntityType::class, [
            'class' => Status::class,
            'choice_label' => 'label',
            'label' => false,
            'attr' => [
                'class' => 'list_status',
            ]
        ])
        ->add('updated_at', null, [
            'label' => false,
            'data' => new \DateTimeImmutable(),
            'attr' => [
                'class' => 'hidden',
            ]
            ])
        ->add('save', SubmitType::class, [
            'label' => 'Update status',
            'attr' => [
                'class' => 'submit_status',
            ],
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
