<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IncomeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cashEntry', EntityType::class, array(
                'class'=>'AppBundle:ChildAccount',
                'choice_label'=>'name'))
                ->add('entryReason', EntityType::class, array(
                'class'=>'AppBundle:ChildAccount',
                'choice_label'=>'name'))
                ->add('amount')
                ->add('briefDescription')
                ->add('account')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Income'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_income';
    }


}
