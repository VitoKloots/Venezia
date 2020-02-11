<?php

namespace App\Form;

use App\Entity\Bestelregel;
use App\Entity\Fruit;
use App\Entity\Ijsrecept;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestelregelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aantal')
            ->add('afleverdatum')
            ->add('betaald', ChoiceType::class, [
                'choices' => [
                    'Is er betaald' => '',
                    'Ja' => 'Ja',
                    'Nee' => 'Nee'
                ]
            ])
            ->add('ijsrecept', EntityType::class, [
                'class' => Ijsrecept::class,
                'choice_label' => 'naam',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bestelregel::class,
        ]);
    }
}
