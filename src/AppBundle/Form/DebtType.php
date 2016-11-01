<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DebtType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debtAmortizationAccount','choice',['attr'=>['class'=>'select2 form-control'],'choices'=>[
                'a'=>'a',
                'b'=>'b',
                'c'=>'c',
                'd'=>'d',
            ]])
            ->add('openingBalance','text',['attr'=>['class'=>'form-control']])
            ->add('account',null,['attr'=>['class'=>'select2 form-control'],'required'=>true]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Debt'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_debt';
    }


}
