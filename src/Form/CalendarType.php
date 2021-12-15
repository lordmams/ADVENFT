<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('hasDonation', CheckboxType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
            'csrf_protection' => false,
        ]);
    }
}
