<?php

namespace DataBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefuelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('carDistance')
            ->add('unitPrice')
            ->add('amountPurchased')
            ->add('type', 'entity', [
                'class' => 'DataBundle\Entity\FuelType',
                'property' => 'id'
            ])
            ->add('petrolStation', EntityType::class, [
                'class' => 'DataBundle\Entity\PetrolStation',
                'property' => 'id'
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DataBundle\Entity\Refuel'
        ));
    }
}
