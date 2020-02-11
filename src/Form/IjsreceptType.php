<?php

namespace App\Form;

use App\Entity\Fruit;
use App\Entity\Ijsrecept;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IjsreceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('ingredientenlijst')
            ->add('recept')
            ->add('kosten', MoneyType::class)
            ->add('fruit', EntityType::class, [
                'class' => Fruit::class,
                'choice_label' => 'naam',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ijsrecept::class,
        ]);
    }
}
