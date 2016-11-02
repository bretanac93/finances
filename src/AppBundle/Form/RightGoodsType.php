<?php

namespace AppBundle\Form;

use AppBundle\Repository\RightGoodsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RightGoodsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('openingBalance','text',['attr'=>['class'=>'form-control'],'required'=>true])
            ->add('account','entity',['required'=>true,
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
                        ->where("a.name='Bienes y Derechos'");
                       // ->andWhere('c.matrix_account IS NOT NULL');

                }
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function getDefaultOptions(array $options)
    {
        $collectionConstraint = new ArrayCollection(array());

        $options['validation_constraint'] = $collectionConstraint;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rightgoods';
    }


}
