<?php

namespace App\Form;

use App\Entity\Fruit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FruitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('seizoen', ChoiceType::class, [
                'choices' => [
                    'Seizoenen' => [
                        'Lente' => 'Lente',
                        'Zomer' => 'Zomer',
                        'Herfst' => 'Herfst',
                        'Winter' => 'Winter',
                    ]
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fruit::class,
        ]);
    }
}
