<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SavingPlanType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('openingBalance','text',['attr'=>['class'=>'form-control']])
            ->add('account','entity',[
                'class'=>'AppBundle:ChildAccount',
                'group_by'=>'matrixAccountName',
                'property'=>'name',
                'attr'=>[
                    'class'=>'selectpicker show-tick form-control',
                    'data-live-search'=>'true'
                ],
                'query_builder' => function(\Doctrine\ORM\EntityRepository $repo) {
                    return $repo->createQueryBuilder('c')
                        ->join('c.matrix_account','m')
                        ->join('m.account_type','a')
                        ->where("a.name='Capital'");
                    //->andWhere('m.matrix_account IS NOT NULL');

                }
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SavingPlan'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_savingplan';
    }


}
