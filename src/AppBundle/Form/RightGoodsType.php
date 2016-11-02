<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RightGoodsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rightGoodsAccount','choice',['attr'=>['class'=>'select2 form-control'],'choices'=>[
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
            'data_class' => 'AppBundle\Entity\RightGoods'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rightgoods';
    }


}
